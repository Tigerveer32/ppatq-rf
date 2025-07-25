@extends('layouts.app')

@section('auth')
    @if(\Request::is('static-sign-up')) 
        @include('layouts.navbars.guest.nav')
        @yield('content')
        @include('layouts.footers.guest.footer')

    @elseif (\Request::is('static-sign-in')) 
        @include('layouts.navbars.guest.nav')
        @yield('content')

    @else
        @if (\Request::is('rtl'))  
            @include('layouts.navbars.auth.sidebar-rtl')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden d-flex flex-column">
                @include('layouts.navbars.auth.nav-rtl')
                <div class="container-fluid py-4 flex-grow-1">
                    @yield('content')
                </div>
            </main>

        @elseif (\Request::is('profile'))  
            @include('layouts.navbars.auth.sidebar')
            <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100 d-flex flex-column">
                @include('layouts.navbars.auth.nav')
                <div class="flex-grow-1">
                    @yield('content')
                </div>
            </div>

        @elseif (\Request::is('virtual-reality')) 
            @include('layouts.navbars.auth.nav')
            <div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('../assets/img/vr-bg.jpg') ; background-size: cover;">
                @include('layouts.navbars.auth.sidebar')
                <main class="main-content mt-1 border-radius-lg d-flex flex-column">
                    <div class="flex-grow-1">
                        @yield('content')
                    </div>
                </main>
            </div>

        @else
            @include('layouts.navbars.auth.sidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg d-flex flex-column {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('layouts.navbars.auth.nav')
                <div class="container-fluid py-4 flex-grow-1">
                    @yield('content')
                </div>
            </main>
        @endif

        @include('components.fixed-plugin')
    @endif
@endsection
