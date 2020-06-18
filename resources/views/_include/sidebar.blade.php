<div class="app-sidebar sidebar-shadow">
  <div class="app-header__logo">
    <div class="logo-src"></div>
    <div class="header__pane ml-auto">
      <div>
        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </button>
      </div>
    </div>
  </div>
  <div class="app-header__mobile-menu">
    <div>
      <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </button>
    </div>
  </div>
  <div class="app-header__menu">
    <span>
      <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
        <span class="btn-icon-wrapper">
          <i class="fa fa-ellipsis-v fa-w-6"></i>
        </span>
      </button>
    </span>
  </div>
  <div class="scrollbar-sidebar ps">
    <div class="app-sidebar__inner">
      <ul class="vertical-nav-menu metismenu">
        <li class="app-sidebar__heading">Menu</li>
        <li>
          <a href="/" class="mm-{{Request::is('/')?'active':''}}">
            <i class="metismenu-icon pe-7s-rocket"></i>
            Dashboard
          </a>
        </li>
        <li>
          <a href="/product" class="mm-{{Request::is('product')?'active':''}}">
            <i class="metismenu-icon fa fa-product-hunt"></i>
            Product
          </a>
        </li>
        <li>
          <a href="/kategori" class="mm-{{Request::is('kategori')?'active':''}}">
            <i class="metismenu-icon fa fa-list-alt"></i>
            Kategori
          </a>
        </li>
        <li>
          <a href="/subcategory" class="mm-{{Request::is('subcategory')?'active':''}}">
            <i class="metismenu-icon fa fa-list-alt"></i>
            Sub Category
          </a>
        </li>
      </ul>
    </div>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
      <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; right: 0px;">
      <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
    </div>
  </div>
</div>