<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @yield('head')
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('layouts.nav')
            @if(Auth::user()->roles()->pluck('name')->implode(' ') != 'User' )
                @include('layouts.sidebar')
            @else
            @include('layouts.usersidebar')
            @endif
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                    {{--@include('layouts.breadcum')--}}
                <!-- /.container-fluid -->
                <!-- /.content-header -->
                <!-- Main content -->
                    @include('flash-message')
                    <section class="content">
                        <!-- /.row (main row) -->
                        @yield('content')
                    </section>
                <!-- /.container-fluid -->
                <!-- /.content -->
            </div>
            @include('layouts.footer')
        </div>
        @yield('footer')
        @stack('scripts')
    </body>
</html>