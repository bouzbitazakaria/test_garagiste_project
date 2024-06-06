@extends('app')

@section('app_content')
            @include('adminHome.sidbare')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg min-h-screen overflow-y-auto">
                <div class="CustomNav">
                    @include('adminHome.navbar')  
                </div>
                <div class="container-fluid py-4 mt-8">
                    @yield('content')
                </div>
            </main>
            <style>
                .CustomNav {
                    position: fixed;
                    width: 80%; /* Optional: adjust the width as needed */
                    z-index: 1000; /* Optional: adjust the z-index if needed */
                    top: 0;
                    bottom: 10 /* Optional: adjust the distance from the top if needed */
}

            </style>
@endsection