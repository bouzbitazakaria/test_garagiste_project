@extends('adminHome.index')

@section('content')
<a href="{{ route('mecaniciens.index') }}">
    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2 m-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
        </svg>
    </div>
</a>
<form action="{{ route('mecaniciens.store') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="row">
        <hr class="horizontal dark mt-0">
        <h5>General Infos:</h5>
        
        <div class="col-md-4">
            <div class="form-group">
                <label for="firstName" class="form-control-label">First Name</label>
                <input class="form-control" type="text" id="firstName" name="firstName" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="lastName" class="form-control-label">Last Name</label>
                <input class="form-control" type="text" id="lastName" name="lastName" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="address" class="form-control-label">Address</label>
                <input class="form-control" type="text" id="address" name="address" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="phoneNumber" class="form-control-label">Phone Number</label>
                <input class="form-control" type="text" id="phoneNumber" name="phoneNumber" placeholder="000 000 000" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="salary" class="form-control-label">Salary</label>
                <input class="form-control" type="text" id="salary" name="salary" placeholder="00.00 DH" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="email" class="form-control-label">Email Address</label>
                <input class="form-control" type="email" id="email" name="email" placeholder="ex@gmail.com" required>
            </div>
        </div>
    </div>
    <div class="row">
        <hr class="horizontal dark mt-0">
        <h5>For Login:</h5>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="username" class="form-control-label">Username</label>
                <input class="form-control" type="text" id="username" name="username" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="password" class="form-control-label">Password</label>
                <input class="form-control" type="password" id="password" name="password" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Add Mecanicien</button>
            </div>
        </div>
    </div>
</form>
@endsection
