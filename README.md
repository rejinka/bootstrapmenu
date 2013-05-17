# BootstrapMenu

This library provides a bridge between Knp\Menu library and Twitter Bootstrap Navigation. Therefore, it'll
provide a new factories and a new renderer.

To provide a nice API, there are also some new Item besides \Knp\Menu\MenuItem:

  - Divider
  - Header

Both elements disallow adding childs. Furthermore there are some special root nodes:

  - NavbarRoot represents a "nav"
    - supports dropdown-menus
    - supports divider
  - ListRoot represents a "nav nav-list"
    - supports header
    - supports dropdown-menus
    - supports divider
  - PillsRoot represents a "nav nav-pills"
    - provides a stacked-mode ("nav-stacked")
    - supports dropdown-menus
    - supports divider
  - TabsRoot represents a "nav nav-tabs"
    - provides a stacked-mode ("nav-stacked")
    - supports dropdown-menus
    - supports divider