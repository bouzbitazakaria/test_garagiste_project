@extends('adminHome.index')

@section('content')
    @if(session('success'))
        <div class="text-success-500">{{ session('success') }}</div>
    @endif
        <div class="col-12 mt-5">
          <div class="card mb-4">
            <div class="card-body px-0 pt-0 pb-2">
                @if (!$clients->isEmpty())
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">first name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">last name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">address</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">phone number</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($clients as $client)
                        <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$client->firstName}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs text-secondary mb-0">{{$client->lastName}}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs text-secondary mb-0">{{$client->address}}</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{$client->phoneNumber}}</span>
                      </td>
                        <td class="align-end text-end text-sm px-1 ">
                          <button type="button" class="btn btn-outline-info btn-sm m-0" data-bs-toggle="modal" data-bs-target="#editModal-{{ $client->id }}">Edit</button>
                          <button type="button" class="btn btn-outline-danger btn-sm m-0" data-bs-toggle="modal" data-bs-target="#removeModal-{{ $client->id }}">Remove</button>
                          <button type="button" class="btn btn-outline-dark btn-sm m-0" data-bs-toggle="modal" data-bs-target="#vehiclesModal-{{ $client->id }}">Vehicles</button>
                        </td>
                        {{-- remove modal --}}
                        <div class="modal fade" id="removeModal-{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-notification">Remove Client</h6>
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
                                  <h4 class="text-gradient text-danger mt-4">{{$client->lastName}} will be removed !</h4>
                                </div>
                              </div>
                              <div class="modal-footer gap-3">
                                <form action="{{ route('clients.destroy', $client->id) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-outline-danger btn-sm m-0">Yes remove it</button>
                                </form>
                                <button type="button" class="btn btn-outline-success btn-sm m-0" data-bs-dismiss="modal">cancel</button>
                              </div>
                            </div>
                          </div>
                        </div>
                         {{-- vehicles modal --}}
                        <div class="modal fade" id="vehiclesModal-{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h6 class="modal-title" id="modal-title-notification">Edit Vehicle</h6>
                                      <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      @foreach($client->vehicles as $vehicle)
                                      <form action="{{ route('vehicles.update',$vehicle->id) }}" method="POST" class="max-w-md mx-auto bg-white rounded shadow">
                                          @csrf
                                          @method('PUT')
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label for="make" class="form-control-label">Make</label>
                                                      <input class="form-control" type="text" id="marke" name="marke" value="{{ $vehicle->marke }}">
                                                      @error('marke')
                                                          <p>{{$message}}</p>
                                                      @enderror
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
                                                      <label for="registration" class="form-control-label">Registration</label>
                                                      <input class="form-control" type="text" id="registration" name="registration" value="{{ $vehicle->registration }}" required>
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label for="fuelType" class="form-control-label">Fuel Type</label>
                                                      <input class="form-control" type="text" id="fuelType" name="fuelType" value="{{ $vehicle->fuelType }}" required>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <button type="submit" class="btn btn-primary">Edit Vehicle</button>
                                              </div>
                                          </div>
                                      </form>
                                      <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm m-0">remove vehicle</button> <small>once cliqued it will be removed !</small>
                                      </form>
                                      <hr class="horizontal dark mt-2">
                                      @endforeach
                                  </div>
                                  <div class="modal-footer gap-3">
                                      <button type="button" class="btn btn-outline-success btn-sm m-0" data-bs-dismiss="modal">Cancel</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                         {{-- edit modal --}}
                        <div class="modal fade" id="editModal-{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                          <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-notification">edit Client</h6>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <div class="modal-body">                        
                                  <form action="{{ route('clients.update',$client->id) }}" method="POST" class="max-w-md mx-auto bg-white  rounded shadow">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="firstName" class="form-control-label">First Name</label>
                                                <input class="form-control" type="text" id="firstName" name="firstName" value="{{$client->firstName}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="lastName" class="form-control-label">Last Name</label>
                                                <input class="form-control" type="text" id="lastName" name="lastName" value="{{$client->lastName}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address" class="form-control-label">Address</label>
                                                <input class="form-control" type="text" id="address" name="address" value="{{$client->address}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber" class="form-control-label">Phone Number</label>
                                                <input class="form-control" type="text" id="phoneNumber" name="phoneNumber" value="{{$client->phoneNumber}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                          <button type="submit" class="btn btn-primary">edit client</button>
                                      </div>
                                  </div>
                                  </form>
                              </div>
                              <div class="modal-footer gap-3">
                                <button type="button" class="btn btn-outline-success btn-sm m-0" data-bs-dismiss="modal">cancel</button>
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
                    <h3 class="py-3 text-center">No clients</h3>
                @endif
            </div>
          </div>
          <a href="{{ route('clients.create') }}" class="block mt-4 text-blue-600 hover:underline">+ add new client</a>
          <a class="btn btn-warning float-end" href="{{ route('clients.export') }}">Export Clients Data</a>
        </div>
@endsection