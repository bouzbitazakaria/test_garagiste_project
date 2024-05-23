@extends('app')

@section('app_content')

        @if (\Request::is('/'))  
            @include('clientHome.sidbare')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('clientHome.navbar')
                <div class="container-fluid py-2">
                    @yield('content')
                </div>
            </main>

        @elseif (\Request::is('vehicles'))  
        @include('clientHome.sidbare')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('clientHome.navbar')
                <div class="container-fluid py-4">
                    @yield('content')
                </div>
            </main>

        @elseif (\Request::is('vehicles/create')) 
        @include('clientHome.sidbare')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('clientHome.navbar')
                <div class="container-fluid py-4">
                    @yield('content')
                </div>
            </main>

            @elseif (\Request::is('profil')) 
            @include('clientHome.sidbare')
            <main class="main-content position-relative max-height-vh-100 h-90 mt-1 border-radius-lg overflow-hidden">
                @include('clientHome.navbar')
                <div class="container-fluid py-0 overflow-auto"> 
                    @yield('content')
                </div>
            </main>
            
    
        @endif

    

@endsection