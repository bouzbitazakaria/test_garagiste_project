@extends('adminHome.index')

@section('content')
    @if(session('success'))
        <div class="text-success-500">{{ session('success') }}</div>
    @endif
    <div class="col-12 mt-5">
        <div class="card mb-4">
            <div class="card-body px-0 pt-0 pb-2">
                @if (!$mecaniciens->isEmpty())
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Address</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Salary</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recruited At</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mecaniciens as $mecanicien)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $mecanicien->firstName }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0">{{ $mecanicien->lastName }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs text-secondary mb-0">{{ $mecanicien->address }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $mecanicien->phoneNumber }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $mecanicien->salary }} DH</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $mecanicien->recruited_at }}</span>
                                    </td>
                                    <td class="align-middle text-end">
                                        <button type="button" class="btn btn-outline-info btn-sm m-0" data-bs-toggle="modal" data-bs-target="#editModal-{{ $mecanicien->id }}">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm m-0" data-bs-toggle="modal" data-bs-target="#removeModal-{{ $mecanicien->id }}">Remove</button>
                                    </td>

                                    {{-- Edit modal --}}
                                    <div class="modal fade" id="editModal-{{ $mecanicien->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-notification">Edit Mecanicien</h6>
                                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('mecaniciens.update', $mecanicien->id) }}" method="POST" class="max-w-md mx-auto bg-white rounded shadow">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="firstName" class="form-control-label">First Name</label>
                                                                    <input class="form-control" type="text" id="firstName" name="firstName" value="{{ $mecanicien->firstName }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="lastName" class="form-control-label">Last Name</label>
                                                                    <input class="form-control" type="text" id="lastName" name="lastName" value="{{ $mecanicien->lastName }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="address" class="form-control-label">Address</label>
                                                                    <input class="form-control" type="text" id="address" name="address" value="{{ $mecanicien->address }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phoneNumber" class="form-control-label">Phone Number</label>
                                                                    <input class="form-control" type="text" id="phoneNumber" name="phoneNumber" value="{{ $mecanicien->phoneNumber }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="salary" class="form-control-label">Salary</label>
                                                                    <input class="form-control" type="text" id="salary" name="salary" value="{{ $mecanicien->salary }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-primary">Edit Mecanicien</button>
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
                                    <div class="modal fade" id="removeModal-{{ $mecanicien->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-notification">Remove Mecanicien</h6>
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
                                                        <h4 class="text-gradient text-danger mt-4">{{ $mecanicien->lastName }} will be removed!</h4>
                                                    </div>
                                                </div>
                                                <div class="modal-footer gap-3">
                                                    <form action="{{ route('mecaniciens.destroy', $mecanicien->id) }}" method="post">
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
                    <h3 class="py-3 text-center">No mecaniciens</h3>
                @endif
            </div>
        </div>
        <a href="{{ route('mecaniciens.create') }}" class="block mt-4 text-blue-600 hover:underline">+ Add new mecanicien</a>
        <a class="btn btn-warning float-end" href="{{ route('mecaniciens.export') }}">Export Mecaniciens Data</a>
    </div>
@endsection
