@extends('app')

@section('app_content')
    @include('clientHome.sidbare')
    <main class="main-content position-relative max-height-vh-100 h-90 mt-1 border-radius-lg min-h-screen overflow-y-auto">
            @include('clientHome.navbar')
            <div class="container-fluid py-0 min-h-screen overflow-y-auto"> 
            @yield('content')
        </div>
    </main>
    
@endsection