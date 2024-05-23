@extends('clientHome.index')

@section('content')
    @if(session('success'))
        <div class="text-success-500">{{ session('success') }}</div>
    @endif
    <a href="{{ route('vehicles.create') }}" class="block mt-4 text-blue-600 hover:underline">+ Add new vehicle</a>
    <div class="col-12 mt-5">
        <div class="row">
            @if (!$vehicles->isEmpty())
                @foreach ($vehicles as $vehicle)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                  <img class="img-fluid border-radius-lg" src="{{"storage/avatars/".$vehicle->picture}}" alt="">
                            </div>
                            <div class="card-body pt-2">
                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">{{ $vehicle->marke }}</span>
                                <a href="javascript:;" class="card-title h5 d-block text-darker">
                                    {{ $vehicle->model }}
                                </a>
                                <p class="card-description mb-4">
                                    Fuel Type: {{ $vehicle->fuelType }} <br>
                                    Registration: {{ $vehicle->registration }}
                                </p>
                                <div class="d-flex justify-content-between">
                                  <button type="button" class="btn btn-outline-info btn-sm m-0" data-bs-toggle="modal" data-bs-target="#editModal-{{ $vehicle->id }}">Edit</button>
                                  <button type="button" class="btn btn-outline-danger btn-sm m-0" data-bs-toggle="modal" data-bs-target="#removeModal-{{ $vehicle->id }}">Remove</button>
                                  <button type="button" class="btn btn-outline-dark btn-sm m-0">Details</button>
                              </div>
                            </div>
                        </div>
                    </div>

                    {{-- Remove modal --}}
                    <div class="modal fade" id="removeModal-{{ $vehicle->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="modal-title-notification">Remove Vehicle</h6>
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
                                        <h4 class="text-gradient text-danger mt-4">{{ $vehicle->model }} will be removed!</h4>
                                    </div>
                                </div>
                                <div class="modal-footer gap-3">
                                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm m-0">Yes, remove it</button>
                                    </form>
                                    <button type="button" class="btn btn-outline-success btn-sm m-0" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Edit modal --}}
                    <div class="modal fade" id="editModal-{{ $vehicle->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="modal-title-notification">Edit Vehicle</h6>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" class="max-w-md mx-auto  rounded shadow">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="marke" class="form-control-label">Make</label>
                                                    <input class="form-control" type="text" id="marke" name="marke" value="{{ $vehicle->marke }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="model" class="form-control-label">Model</label>
                                                    <input class="form-control" type="text" id="model" name="model" value="{{ $vehicle->model }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fuelType" class="form-control-label">Fuel Type</label>
                                                    <input class="form-control" type="text" id="fuelType" name="fuelType" value="{{ $vehicle->fuelType }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="registration" class="form-control-label">Registration</label>
                                                    <input class="form-control" type="text" id="registration" name="registration" value="{{ $vehicle->registration }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">Edit Vehicle</button>
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
                @endforeach
            @else
                <h3 class="py-3 text-center">No vehicles</h3>
            @endif
        </div>
        
    </div>
@endsection
