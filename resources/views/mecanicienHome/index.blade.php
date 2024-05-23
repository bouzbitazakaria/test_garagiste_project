@extends('app')

@section('app_content')

        @if (\Request::is('/'))  
            @include('mecanicienHome.sidbare')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('mecanicienHome.navbar')
                <div class="container-fluid py-4">
                    @yield('content')
                </div>
            </main>

        @elseif (\Request::is('clients'))  
        @include('mecanicienHome.sidbare')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
            @include('mecanicienHome.navbar')
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>

        @elseif (\Request::is('clients/create')) 
        @include('mecanicienHome.sidbare')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
            @include('mecanicienHome.navbar')
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>

        @elseif (\Request::is('mecaniciens'))  
        @include('mecanicienHome.sidbare')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
            @include('mecanicienHome.navbar')
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>

        @elseif (\Request::is('mecaniciens/create')) 
        @include('mecanicienHome.sidbare')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
            @include('mecanicienHome.navbar')
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>

        @else
        @include('mecanicienHome.sidbare')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
            @include('mecanicienHome.navbar')
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>
        @endif

    

@endsection