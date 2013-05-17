<?php

namespace NajiDev\BootstrapMenu;

use Knp\Menu\MenuFactory as BaseMenuFactory;


class MenuFactory extends BaseMenuFactory
{
    public function createItem($name, array $options = array())
    {
        $options = array_merge(array(
            // standard options
            'uri'                => null,
            'label'              => null,
            'attributes'         => array(),
            'linkAttributes'     => array(),
            'childrenAttributes' => array(),
            'labelAttributes'    => array(),
            'extras'             => array(),
            'display'            => true,
            'displayChildren'    => true,

            // root options
            'list'    => false,
            'pills'   => false,
            'tabs'    => false,

            // addition standard options
            'divider' => false,
            'header'  => false,

            // this an option, which can be added to pills and tabs
            'stacked' => false,
        ), $options);

        // first: based on the options, determine the element, which is meant
        if ($options['list'])
            $type = ItemInterface::TYPE_LIST;
        else if ($options['pills'])
            $type = $options['stacked'] ? ItemInterface::TYPE_PILLS_STACKED : ItemInterface::TYPE_PILLS;
        else if ($options['tabs'])
            $type = $options['stacked'] ? ItemInterface::TYPE_TABS_STACKED : ItemInterface::TYPE_TABS;
        else if ($options['divider'])
            $type = ItemInterface::TYPE_DIVIDER;
        else if ($options['header'])
            $type = ItemInterface::TYPE_HEADER;
        else
            $type = ItemInterface::TYPE_ITEM;

        $item = new MenuItem($name, $this);

        return $item
            ->setType($type)
            ->setUri($options['uri'])
            ->setLabel($options['label'])
            ->setAttributes($options['attributes'])
            ->setLinkAttributes($options['linkAttributes'])
            ->setChildrenAttributes($options['childrenAttributes'])
            ->setLabelAttributes($options['labelAttributes'])
            ->setExtras($options['extras'])
            ->setDisplay($options['display'])
            ->setDisplayChildren($options['displayChildren'])
        ;
    }
}