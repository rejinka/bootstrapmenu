<?php

namespace NajiDev\BootstrapMenu\MenuItem;

use Knp\Menu\ItemInterface;
use Knp\Menu\MenuItem as BaseMenuItem;

/**
 * @author Tony Lemke <naji@mail.upb.de>
 */
class MenuItem extends BaseMenuItem implements ItemInterface
{
    public function addDivider($name)
    {
        return $this->addChild(new DividerItem($name, $this->factory));
    }
}