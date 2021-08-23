<div id="burl" style="display:none">{{url('/')}}</div>
<div id="wrapper">
    @yield('base-sidebar', View::make('layouts.base.base_sidebar'))

    <div id="page-wrapper" class="gray-bg dashbard-1">
        @yield('base-topbar', View::make('layouts.base.base_topbar'))

        @yield('base-content')

        @yield('base-footer', View::make('layouts.base.base_footer'))

        <div class="modal fade" id="dd_ibuum_foundation" aria-hidden="true"></div>
    </div>

    <!-- @include('components.affiliates.widgets.chat_box') -->

    @include('components.affiliates.sidebar.settings')
</div>

{{--@yield('toast', View::make('components.affiliates.widgets.toast'))--}}
