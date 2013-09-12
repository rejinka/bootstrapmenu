<?php

namespace NajiDev\BootstrapMenu;

use Knp\Menu\ItemInterface;
use Knp\Menu\Renderer\ListRenderer;
use NajiDev\BootstrapMenu\MenuItem\DividerItem;


class Renderer extends ListRenderer
{
    public function render(ItemInterface $item, array $options = array())
    {
        // merge options array with defaults
        $options = array_merge(array(
            'currentClass'  => 'active',
            'ancestorClass' => 'active',
            'depth'         => 2,
            'type'          => 'list',
            'stacked'       => false,
            'justified'     => false,
        ), $options);

        // following one isn't really an option - just for the implementation
        $options['renderingRoot'] = true;

        return parent::render($item, $options);
    }

    protected function renderList(ItemInterface $item, array $attributes, array $options)
    {
        $renderingRoot = $options['renderingRoot'];
        $options['renderingRoot'] = false;

        $classes = array();
        if ($renderingRoot)
        {
            $classes[] = 'nav';

            if ('tabs' === $options['type'])
                $classes[] = 'nav-tabs';
            else if ('pills' === $options['type'])
                $classes[] = 'nav-pills';

            if ($options['stacked'])
                $classes[] = 'nav-stacked';

            if ($options['justified'])
                $classes[] = 'nav-justified';
        }
        else if ($item->hasChildren() && $item->getDisplayChildren())
        {
            $classes[] = 'dropdown-menu';
        }

        if (!empty($classes))
        {
            $class = implode(' ', $classes);
            if (array_key_exists('class', $attributes))
                $attributes['class'] .= ' ' . $class;
            else
                $attributes['class'] = $class;
        }

        return parent::renderList($item, $attributes, $options);
    }

    protected function renderItem(ItemInterface $item, array $options)
    {
        if ($item instanceof DividerItem)
        {
            return $this->format('<li class="divider"></li>', 'li', $item->getLevel(), $options);
        }

        return parent::renderItem($item, $options);
    }

    protected function renderLink(ItemInterface $item, array $options = array())
    {
        if (0 !== $options['depth'] && $item->hasChildren() && $item->getDisplayChildren())
        {
            $text = '<a class="dropdown-toggle" data-toggle="dropdown" href="#">' . $item->getName() . '<span class="caret"></span></a>';
            return $this->format($text, 'link', $item->getLevel(), $options);
        }

        return parent::renderLink($item, $options);
    }

    protected function renderSpanElement(ItemInterface $item, array $options)
    {
        return sprintf('<a%s>%s</a>', $this->renderHtmlAttributes($item->getLabelAttributes()), $this->renderLabel($item, $options));
    }
}