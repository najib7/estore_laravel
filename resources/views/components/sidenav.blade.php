<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav custom-nav">
                <a class="nav-link" href="/">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    {{ __('app.sidebar.stats') }}
                </a>

                @can('show', App\Models\Product::class)
                <div class="sb-sidenav-menu-heading">{{ __('app.common.products') }}</div>

                <a class="nav-link" href="{{ route('products') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list fa-fw"></i></div>
                    {{ __('app.sidebar.list_products') }}
                </a>

                <a class="nav-link" href="{{ route('products_categories') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-layer-group fa-fw"></i></div>
                    {{ __('app.sidebar.products_categories') }}
                </a>
                @endcan

                <div class="sb-sidenav-menu-heading">{{ __('app.common.users_and_privileges') }}</div>

                @can('show', App\Models\User::class)
                <a class="nav-link" href="{{ route('users') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-tie fa-fw"></i></div>
                    {{ __('app.common.users') }}
                </a>
                @endcan

                @can('show', App\Models\Group::class)
                <a class="nav-link" href="{{ route('groups') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-friends fa-fw"></i></div>
                    {{ __('app.common.groups_and_privileges') }}
                </a>
                @endcan

                @can('show', App\Models\Client::class)
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-clients"
                    aria-expanded="false" aria-controls="collapse-clients">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    {{ __('app.common.clients_and_suppliers') }}
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapse-clients" aria-labelledby="headingOne"
                    data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('clients') }}">{{ __('app.common.clients') }}</a>
                        <a class="nav-link" href="{{ route('suppliers') }}">{{ __('app.common.suppliers') }}</a>
                    </nav>
                </div>
                @endcan

                @can('show', App\Models\Sales\SaleInvoice::class)
                <div class="sb-sidenav-menu-heading">{{ __('app.common.store') }}</div>

                <a class="nav-link" href="{{ route('purchases') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart fa-fw"></i></div>
                    {{ __('app.common.purchases') }}
                </a>

                <a class="nav-link" href="{{ route('sales') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-store fa-fw"></i></div>
                    {{ __('app.common.sales') }}
                </a>
                @endcan

            </div>
        </div>
        <div class="sb-sidenav-footer"></div>
    </nav>
</div>
