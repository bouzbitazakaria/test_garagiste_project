@extends('clientHome.index')

@section('content')
<a href="{{ route('vehicles.index') }}">
    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2 m-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
        </svg>
    </div>
</a>
<form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-6 rounded shadow">
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
        <h5>Vehicle Information:</h5>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="marke" class="form-control-label">Marke</label>
                <input class="form-control" type="text" id="marke" name="marke" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="model" class="form-control-label">Model</label>
                <input class="form-control" type="text" id="model" name="model" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="fuelType" class="form-control-label">Fuel Type</label>
                <input class="form-control" type="text" id="fuelType" name="fuelType" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="registration" class="form-control-label">Registration</label>
                <input class="form-control" type="text" id="registration" name="registration" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="picture" class="form-control-label">Picture</label>
                <input class="form-control" type="file" id="picture" name="picture" accept="image/*" required>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Add Vehicle</button>
            </div>
        </div>
    </div>
</form>
@endsection
