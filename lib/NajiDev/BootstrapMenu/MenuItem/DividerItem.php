<?php

namespace NajiDev\BootstrapMenu\MenuItem;

use Knp\Menu\ItemInterface;


/**
 * @author Tony Lemke <naji@mail.upb.de>
 */
class DividerItem extends MenuItem implements ItemInterface
{
    public function addChild($child, array $options = array())
    {
        throw new \LogicException('A divider can not have children');
    }
}