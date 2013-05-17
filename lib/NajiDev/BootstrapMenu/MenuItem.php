<?php

namespace NajiDev\BootstrapMenu;

use Knp\Menu\MenuItem as BaseMenuItem;
use NajiDev\BootstrapMenu\Exception\InvalidArgumentException;


class MenuItem extends BaseMenuItem implements ItemInterface
{
    /** @var int */
    protected $type = null;

    public function getDisplayChildren()
    {
        if ($this->isTypeDivider() || $this->isTypeHeader())
            return false;

        return parent::getDisplayChildren();
    }

    /**
     * Provides a fluent interface
     *
     * @param $type int one of the interfaces TYPE_ prefixed constants
     * @throws \NajiDev\BootstrapMenu\Exception\InvalidArgumentException
     * @return \NajiDev\BootstrapMenu\ItemInterface
     */
    function setType($type)
    {
        if (!(0 <= $type && $type <= 7))
            throw new InvalidArgumentException();

        $this->type = $type;

        return $this;
    }

    /**
     * @return int|null one of the interfaces TYPE_ prefixed constants
     */
    function getType()
    {
        return $this->type;
    }

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_LIST
     *
     * @return boolean
     */
    function isTypeList()
    {
        return self::TYPE_LIST === $this->getType();
    }

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_PILLS
     *
     * @return boolean
     */
    function isTypePills()
    {
        return self::TYPE_PILLS === $this->getType();
    }

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_PILLS_STACKED
     *
     * @return boolean
     */
    function isTypePillsStacked()
    {
        return self::TYPE_PILLS_STACKED === $this->getType();
    }

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_TABS
     *
     * @return boolean
     */
    function isTypeTabs()
    {
        return self::TYPE_TABS === $this->getType();
    }

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_TABS_STACKED
     *
     * @return boolean
     */
    function isTypeTabsStacked()
    {
        return self::TYPE_TABS_STACKED === $this->getType();
    }

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_DIVIDER
     *
     * @return boolean
     */
    function isTypeDivider()
    {
        return self::TYPE_DIVIDER === $this->getType();
    }

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_HEADER
     *
     * @return boolean
     */
    function isTypeHeader()
    {
        return self::TYPE_HEADER === $this->getType();
    }

    /**
     * Checks whether the item is a type \NajiDev\BootstrapMenu\ItemInterface::TYPE_ITEM
     *
     * @return boolean
     */
    function isTypeItem()
    {
        return self::TYPE_ITEM === $this->getType();
    }
}