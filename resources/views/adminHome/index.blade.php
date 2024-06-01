@extends('app')

@section('app_content')
            @include('adminHome.sidbare')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('adminHome.navbar')
                <div class="container-fluid py-4">
                    @yield('content')
                </div>
            </main>
@endsection