@extends('clientHome.index')

@section('content')
<div class="max-w-md mx-auto m-0  p-6 rounded shadow">
    <div class="d-flex align-items-center mb-2"> 
        <a href="{{route('vehicles.index')}}" class="me-2">
            <div class="icon icon-shape icon-md shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center p-2 m-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
                </svg>
            </div>
        </a>
        <h1 class="text-2xl font-bold mb-0">Profile</h1> 
    </div>
    
    <form action="{{ route('profil.update', $client->id) }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="firstName"  class="form-control-label">First Name</label>
            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" value="{{ $client->firstName }}" required>
        </div>

        <div class="mb-4">
            <label for="lastName" class="form-control-label">Last Name</label>
            <input type="text" name="lastName" id="lastName" placeholder="Last Name" value="{{ $client->lastName }}" required
            class="form-control">
        </div>

        <div class="mb-4">
            <label for="address" class="form-control-label">Address</label>
            <input type="text" name="address" id="address" placeholder="Address" value="{{ $client->address }}" required
            class="form-control">
        </div>

        <div class="mb-4">
            <label for="phoneNumber" class="form-control-label">Phone Number</label>
            <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Phone Number" value="{{ $client->phoneNumber }}" required
            class="form-control">
        </div>

        <div class="row">
          <div class="col-md-6">
              <button type="submit" class="btn btn-primary">Edit Profil</button>
          </div>
          @if(session('success'))
            <div class="text-success-500">{{ session('success') }}</div>
            @endif
      </div>
    </form>
</div>
@endsection
