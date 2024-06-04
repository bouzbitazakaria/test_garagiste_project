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
                                  <button type="button" class="btn btn-outline-info btn-sm m-0  p-1" data-bs-toggle="modal" data-bs-target="#editModal-{{ $vehicle->id }}">Edit</button>
                                  <button type="button" class="btn btn-outline-danger btn-sm m-0  p-1" data-bs-toggle="modal" data-bs-target="#removeModal-{{ $vehicle->id }}">Remove</button>
                                  <button type="button" class="btn btn-outline-dark btn-sm m-0  p-1">Details</button>
                              </div>
                            </div>
                        </div>
                    </div>
                    @include('vehicles.modals.edit',['vehicle'=>$vehicle])
                    @include('vehicles.modals.remoce',['vehicle'=>$vehicle])
                @endforeach
            @else
                <h3 class="py-3 text-center">No vehicles</h3>
            @endif
        </div>
        
    </div>
@endsection
