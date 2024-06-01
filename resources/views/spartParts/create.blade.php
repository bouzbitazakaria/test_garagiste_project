@extends('adminHome.index')

@section('content')
<a href="{{ route('spareParts.index') }}">
    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2 m-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
        </svg>
    </div>
</a>
<form action="{{ route('spareParts.store') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow">
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
        <h5>Spare Part Details:</h5>
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="partName" class="form-control-label">Part Name</label>
                <input class="form-control" type="text" id="partName" name="partName" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="partReference" class="form-control-label">Part Reference</label>
                <input class="form-control" type="text" id="partReference" name="partReference" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="supplier" class="form-control-label">Supplier</label>
                <input class="form-control" type="text" id="supplier" name="supplier" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="price" class="form-control-label">Price</label>
                <input class="form-control" type="text" id="price" name="price" placeholder="00.00 DH" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="stock" class="form-control-label">Stock</label>
                <input class="form-control" type="number" id="stock" name="stock" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">Add Spare Part</button>
        </div>
    </div>
</form>
@endsection
    
