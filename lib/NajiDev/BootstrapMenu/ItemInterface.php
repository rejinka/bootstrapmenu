<?php

namespace NajiDev\BootstrapMenu;

use Knp\Menu\ItemInterface as BaseItemInterface;


interface ItemInterface extends BaseItemInterface
{
    const TYPE_LIST          = 0;
    const TYPE_PILLS         = 1;
    const TYPE_PILLS_STACKED = 2;
    const TYPE_TABS          = 3;
    const TYPE_TABS_STACKED  = 4;
    const TYPE_DIVIDER       = 5;
    const TYPE_HEADER        = 6;
    const TYPE_ITEM          = 7;

    /**
     * Provides a fluent interface
     *
     * @param $type int one of the interfaces TYPE_ prefixed constants
     * @return \NajiDev\BootstrapMenu\ItemInterface
     */
    function setType($type);

    /**
     * @return int|null one of the interfaces TYPE_ prefixed constants
     */
    function getType();

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_LIST
     *
     * @return boolean
     */
    function isTypeList();

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_PILLS
     *
     * @return boolean
     */
    function isTypePills();

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_PILLS_STACKED
     *
     * @return boolean
     */
    function isTypePillsStacked();

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_TABS
     *
     * @return boolean
     */
    function isTypeTabs();

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_TABS_STACKED
     *
     * @return boolean
     */
    function isTypeTabsStacked();

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_DIVIDER
     *
     * @return boolean
     */
    function isTypeDivider();

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_HEADER
     *
     * @return boolean
     */
    function isTypeHeader();

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_ITEM
     *
     * @return boolean
     */
    function isTypeItem();
}