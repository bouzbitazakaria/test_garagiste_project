@extends('clientHome.index')

@section('content')
<div class="col-12  m-1 p-3 " >
    @if(session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif
    <a href="{{ route('vehicles.create') }}" class="btn btn-success">+ Add new vehicle</a>
        <div  class="row overflow-auto" style="max-height: 600px;">
            @if (!$vehicles->isEmpty())
                @foreach ($vehicles as $vehicle)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header p-0 mx-3 mt-2 position-relative z-index-1">
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
                                  
                              </div>
                            </div>
                        </div>
                    </div>
                    @include('vehicles.modals.edit',['vehicle'=>$vehicle])
                    @include('vehicles.modals.remove',['vehicle'=>$vehicle])
                @endforeach
            @else
                <h3 class="py-3 text-center">No vehicles</h3>
            @endif
        </div>
        
    </>
@endsection
