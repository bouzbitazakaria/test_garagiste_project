@extends('mecanicienHome.index')

@section('content')
<a href="{{ route('reparations.index') }}">
    <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center p-2 m-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
        </svg>
    </div>
</a>
<div class="col-12 mt-5">
    <div class="row">
        @if (!$vehicles->isEmpty())
            @foreach ($vehicles as $vehicle)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                            <img class="img-fluid border-radius-lg" src="{{ asset('storage/avatars/' . $vehicle->picture) }}" alt="" />
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
                              <button type="button" class="btn btn-outline-info btn-sm m-0" data-bs-toggle="modal" data-bs-target="#editModal-{{ $vehicle->id }}">Repair this car</button>
                          </div>
                        </div>
                    </div>
                </div>

                {{-- repair modal --}}
                <div class="modal fade" id="editModal-{{ $vehicle->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-title-notification" aria-hidden="true">
                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-notification">Repair Vehicle</h6>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('reparations.store') }}" method="POST" class="max-w-md mx-auto  rounded shadow">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description" class="form-control-label">Description</label>
                                                <input class="form-control" type="text" id="description" name="description" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status" class="form-control-label">Status</label>
                                                <input class="form-control" type="text" id="status" name="status" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="startDate" class="form-control-label">Start Date</label>
                                                <input class="form-control" type="date" id="startDate" name="startDate" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="endDate" class="form-control-label">End Date</label>
                                                <input class="form-control" type="date" id="endDate" name="endDate" required>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mechanicNotes" class="form-control-label">Mechanic Notes</label>
                                                    <input class="form-control" type="text" id="mechanicNotes" name="mechanicNotes" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="clientNotes" class="form-control-label">Client Notes</label>
                                                    <input class="form-control" type="text" id="clientNotes" name="clientNotes" disabled>
                                                </div>
                                            </div>
                                            <input type="hidden" name="vehicleID" value="{{ $vehicle->id }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">Repair Vehicle</button>
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
                <h3 class="py-3 text-center">No vehicles te repair</h3>
            @endif
        </div>
    @endsection
    
