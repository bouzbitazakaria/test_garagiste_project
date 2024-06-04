@extends('adminHome.index')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    @if (!$spareParts->isEmpty())
                        @foreach ($spareParts as $sparePart)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $sparePart->partName }}</h5>
                                        <p class="card-text"><strong>Reference:</strong> {{ $sparePart->partReference }}</p>
                                        <p class="card-text"><strong>Supplier:</strong> {{ $sparePart->supplier }}</p>
                                        <p class="card-text"><strong>Price:</strong> {{ $sparePart->price }} DH</p>
                                        <p class="card-text"><strong>Stock:</strong> {{ $sparePart->stock }}</p>
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $sparePart->id }}">
                                                 Edit
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeModal-{{ $sparePart->id }}">
                                                 Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('spartParts.modals.edit',['sparePart'=>$sparePart])
                            @include('spartParts.modals.remove',['sparePart'=>$sparePart])
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <h3 class="py-3 text-center">No spare parts available</h3>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-2 mb-2 ">
                <div class="d-flex flex-column align-items-start mt-4 border-start border-info p-2 rounded-xl ">
                    <div class="mb-3">
                        <a href="{{ route('spareParts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Add New Spare Part
                        </a>
                    </div>
                    <div class="mb-3">
                        <a class=" btn btn-warning " href="{{ route('spareParts.export') }}">
                            <i class="fas fa-file-export"></i> Export to Excel
                        </a>
                    </div>
                    <div class="mb-3">
                        <form action="{{ route('spareParts.import') }}" method="POST" enctype="multipart/form-data" class="d-inline-block w-90" id="importForm">
                            @csrf
                            <div class="input-group mb-3">
                                <label class=" btn btn-success " for="fileUpload" style="cursor: pointer;">
                                    <i class="fas fa-file-upload p-1"></i>import from Excel
                                </label>
                                <input type="file" name="file" id="fileUpload" class="form-control d-none" required onchange="submitForm()">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            document.getElementById('importForm').submit();
        }
    </script>
    <style>
    #fileUpload {
        display: none;
    }
    </style>
@endsection
