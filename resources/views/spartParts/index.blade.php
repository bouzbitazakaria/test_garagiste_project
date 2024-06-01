@extends('adminHome.index')

@section('content')
    @if(session('success'))
        <div class="text-success-500">{{ session('success') }}</div>
    @endif
    <div class="col-12 mt-5">
        <div class="card mb-4">
            <div class="card-body px-0 pt-0 pb-2">
                @if (!$spareParts->isEmpty())
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Part Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Part Reference</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Supplier</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stock</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spareParts as $sparePart)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $sparePart->partName }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-start text-sm">
                                        <p class="text-xs text-secondary mb-0">{{ $sparePart->partReference }}</p>
                                    </td>
                                    <td class="align-middle text-start text-sm">
                                        <p class="text-xs text-secondary mb-0">{{ $sparePart->supplier }}</p>
                                    </td>
                                    <td class="align-middle text-start text-sm">
                                        <p class="text-xs text-secondary mb-0">{{ $sparePart->price }} DH</p>
                                    </td>
                                    <td class="align-middle text-start text-sm">
                                        <p class="text-xs text-secondary mb-0">{{ $sparePart->stock }}</p>
                                    </td>
                                    <td class="align-middle text-end">
                                        <button type="button" class="btn btn-outline-info btn-sm m-0" data-bs-toggle="modal" data-bs-target="#editModal-{{ $sparePart->id }}">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm m-0" data-bs-toggle="modal" data-bs-target="#removeModal-{{ $sparePart->id }}">Remove</button>
                                    </td>

                                    {{-- Edit modal --}}
                                    <div class="modal fade" id="editModal-{{ $sparePart->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-notification">Edit Spare Part</h6>
                                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('spareParts.update', $sparePart->id) }}" method="POST" class="max-w-md mx-auto bg-white rounded shadow">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="partName" class="form-control-label">Part Name</label>
                                                                    <input class="form-control" type="text" id="partName" name="partName" value="{{ $sparePart->partName }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="partReference" class="form-control-label">Part Reference</label>
                                                                    <input class="form-control" type="text" id="partReference" name="partReference" value="{{ $sparePart->partReference }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="supplier" class="form-control-label">Supplier</label>
                                                                    <input class="form-control" type="text" id="supplier" name="supplier" value="{{ $sparePart->supplier }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="price" class="form-control-label">Price</label>
                                                                    <input class="form-control" type="number" id="price" name="price" value="{{ $sparePart->price }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="stock" class="form-control-label">Stock</label>
                                                                    <input class="form-control" type="number" id="stock" name="stock" value="{{ $sparePart->stock }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-primary">Edit Spare Part</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer gap-3">
                                                    <button type="button" class="btn btn-outline-success btn-sm m-0" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Remove modal --}}
                                    <div class="modal fade" id="removeModal-{{ $sparePart->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-notification">Remove Spare Part</h6>
                                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="py-3 text-center">
                                                        <div class="icon icon-shape icon-lg shadow border-radius-md bg-white text-center me-auto d-flex align-items-center justify-content-center p-2 m-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <path fill="#dc3545" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/>
                                                            </svg>
                                                        </div>
                                                        <h4 class="text-gradient text-danger mt-4">{{ $sparePart->partName }} will be removed!</h4>
                                                    </div>
                                                </div>
                                                <div class="modal-footer gap-3">
                                                    <form action="{{ route('spareParts.destroy', $sparePart->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm m-0">Yes, remove it</button>
                                                    </form>

                                                    <button type="button" class="btn btn-outline-success btn-sm m-0" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <h3 class="py-3 text-center">No spare parts</h3>
                @endif
            </div>
        </div>
        <a href="{{ route('spareParts.create') }}" class="btn btn-primary float-end">Add New Spare Part</a>
    </div>
@endsection
