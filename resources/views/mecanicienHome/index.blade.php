@extends('app')

@section('app_content')
            @include('mecanicienHome.sidbare')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('mecanicienHome.navbar')
                <div class="container-fluid py-4 min-h-screen overflow-y-auto">
                    @yield('content')
                </div>
            </main>
@endsection