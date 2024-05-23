@extends('app')

@section('app_content')

        @if (\Request::is('/'))  
            @include('adminHome.sidbare')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('adminHome.navbar')
                <div class="container-fluid py-4">
                    @yield('content')
                </div>
            </main>

        @elseif (\Request::is('clients'))  
        @include('adminHome.sidbare')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
            @include('adminHome.navbar')
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>

        @elseif (\Request::is('clients/create')) 
        @include('adminHome.sidbare')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
            @include('adminHome.navbar')
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>

        @elseif (\Request::is('mecaniciens'))  
        @include('adminHome.sidbare')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
            @include('adminHome.navbar')
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>

        @elseif (\Request::is('mecaniciens/create')) 
        @include('adminHome.sidbare')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
            @include('adminHome.navbar')
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>

        @else
        @include('adminHome.sidbare')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
            @include('adminHome.navbar')
            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>
        @endif

    

@endsection