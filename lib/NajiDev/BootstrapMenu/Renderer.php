<?php

namespace NajiDev\BootstrapMenu;

use Knp\Menu\ItemInterface as KnpItemInterface;
use Knp\Menu\Renderer\ListRenderer;
use NajiDev\BootstrapMenu\Exception\InvalidArgumentException;


class Renderer extends ListRenderer
{
    public function render(KnpItemInterface $item, array $options = array())
    {
        if (!$item instanceof \NajiDev\BootstrapMenu\ItemInterface)
            throw new InvalidArgumentException('Please provide an instance of extended interface \NajiDev\BootstrapMenu\ItemInterface');

        // merge options array with defaults
        $options = array_merge(array(
            'currentClass'  => 'active',
            'depth' => 2
        ), $options);

        // following ones aren't really options. they are for the implemenetation
        $options['root'] = $item;
        $options['renderingRoot'] = true;

        return parent::render($item, $options);
    }

    protected function renderList(KnpItemInterface $item, array $attributes, array $options)
    {
        /** @var $item ItemInterface */

        $renderingRoot = $options['renderingRoot'];
        $options['renderingRoot'] = false;
        $options['contextRoot']   = $item;

        if (!$item->hasChildren() || 0 === $options['depth'] || !$item->getDisplayChildren())
            return '';

        if ($renderingRoot)
        {
            if ($item->isTypeList())
                $class = 'nav nav-list';
            else if ($item->isTypePills())
                $class = 'nav nav-pills';
            else if ($item->isTypePillsStacked())
                $class = 'nav nav-pills nav-stacked';
            else if ($item->isTypeTabs())
                $class = 'nav nav-tabs';
            else if ($item->isTypeTabsStacked())
                $class = 'nav nav-tabs nav-stacked';
            else
                $class = 'nav';
        }
        else
            $class = 'dropdown-menu';

        if (array_key_exists('class', $attributes))
            $attributes['class'] .= ' ' . $class;
        else
            $attributes['class'] = $class;

        return parent::renderList($item, $attributes, $options);
    }

    protected function renderItem(KnpItemInterface $item, array $options)
    {
        /** @var $item ItemInterface */

        /** @var $root ItemInterface */
        $root = $options['root'];

        /** @var $parent ItemInterface */
        $parent = $item->getParent();

        $class = (array) $item->getAttribute('class');
        if ($item->isTypeDivider())
        {
            // if the parent is not the root, the divider is beyond an item, which is rendered as a dropdown
            if ($root !== $parent)
                $class[] = 'divider';
            // otherwise the parents type is interesting
            else if (!$parent->isTypePillsStacked() && !$parent->isTypeTabsStacked())
                $class[] = 'divider-vertical';
        }
        else if ($item->isTypeHeader())
        {
            // if the parent is a list type, the item gets class nav-header
            if ($parent->isTypeList() || in_array('dropdown', (array) $parent->getAttribute('class')))
                $class[] = 'nav-header';
            // nav-header are only supported by nav-list, so return nothing, if this isn't given
            else
                return '';
        }
        // dropdown, if it has children and depth is okay with it
        else if (0 !== $options['depth'] && $item->hasChildren())
            $class[] = 'dropdown';
        // on all other items, we assume, that it will be rendered as normal item
        else {}

        /**
         * now, we'll add "disabled", if the item
         * - hasn't class dropdown and
         * - isn't a divider and
         * - isn't a header and
         * - has no uri
         *
         *   or
         *
         * - is current but option currentAsLink is on false or
         */
        if (
            (!in_array('dropdown', $class) && !$item->isTypeDivider() && !$item->isTypeHeader() && !$item->getUri())
            ||
            ($item->isCurrent() && !$options['currentAsLink'])
        )
            $class[] = 'disabled';

        if (!empty($class))
            $item->setAttribute('class', implode(' ', $class));

        return parent::renderItem($item, $options);
    }

    protected function renderLink(KnpItemInterface $item, array $options = array())
    {
        /** @var $item ItemInterface */

        if ($item->isTypeDivider())
            return '';

        if ($item->isTypeHeader())
            return $this->renderLabel($item, $options);

        // if our item has children, we need to prepare a dropdown menu
        if (0 === $options['depth'] || !$item->hasChildren())
            return parent::renderLink($item, $options);

        $text = '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $item->getLabel() . ' <b class="caret"></b></a>';

        return $this->format($text, 'link', $item->getLevel(), $options);
    }

    protected function renderSpanElement(KnpItemInterface $item, array $options)
    {
        return sprintf('<a%s>%s</a>', $this->renderHtmlAttributes($item->getLabelAttributes()), $this->renderLabel($item, $options));
    }
}