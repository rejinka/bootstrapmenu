BootstrapMenu
=============

The BootstrapMenu library is a bridge between KnpMenu and Bootstrap.

```php
<?php
$factory  = new \NajiDev\BootstrapMenu\MenuFactory();
$renderer = new \NajiDev\BootstrapMenu\Renderer();

$root = $factory->createItem('root');
$root->addChild('Home', array('uri' => '/'));
$root->addChild('Comments', array('uri' => '#comments'));
$root->addChild('Symfony2', array('uri' => 'http://symfony-reloaded.org/'));

$submenu = $root->addChild('Submenu');
$submenu->addChild('Child 1');
$submenu->addDivider('divider1');

$child = $submenu->addChild('Child 2');
$child->addChild('x');


echo $renderer->render($root, array('type' => 'tabs'));
```

The Menu above should render to

```html
<ul class="nav nav-tabs">
  <li class="first">
    <a href="/">Home</a>
  </li>
  <li>
    <a href="#comments">Comments</a>
  </li>
  <li>
    <a href="http://symfony-reloaded.org/">Symfony2</a>
  </li>
  <li class="active last">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Submenu<span class="caret"></span></a>
    <ul class="menu_level_1 dropdown-menu">
      <li class="active first">
        <a>Child 1</a>
      </li>
      <li class="divider"></li>
      <li class="last">
        <a>Child 2</a>
      </li>
    </ul>
  </li>
</ul>
```

There are a few things to mention:

  - The menu itself does not know anything of its graphic representation, so you can build big menus and render only
    parts of it.
  - The graphic representation is choosen while using the renderer. You may choose to render the menu (option 'type') as

    - tabs
    - pills
    - list (default)

    Also, you may choose to set the option 'stacked' to true or false (default) to get a stacked menu.
  - The renderer assumes, that you want to render the menu with it's dropdowns. If you have more levels, this will
    be ignored, as bootstrap is not able to display more than 2 levels. Because of that, the child "x" in the example
    above is not rendered.
  - MenuItem::addDivider() is new and allows to add a horizontal divider (interesting for submenus).