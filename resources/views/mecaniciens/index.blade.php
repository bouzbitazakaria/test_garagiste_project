@extends('adminHome.index')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="input-group mb-3">
                <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                <input type="text" id="searchInput" class="form-control p-2" placeholder="Search mechanics...">
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Name</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Address</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Salary</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recruited At</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="searchResults">
                        @forelse ($mecaniciens as $mecanicien)
                            <tr>
                                <td class="text-sm font-weight-normal">{{ $mecanicien->firstName }}</td>
                                <td class="text-sm font-weight-normal">{{ $mecanicien->lastName }}</td>
                                <td class="text-center text-sm font-weight-normal">{{ $mecanicien->address }}</td>
                                <td class="text-center text-sm font-weight-normal">{{ $mecanicien->phoneNumber }}</td>
                                <td class="text-center text-sm font-weight-normal">{{ $mecanicien->salary }} DH</td>
                                <td class="text-center text-sm font-weight-normal">{{ $mecanicien->recruited_at }}</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-outline-info btn-sm  p-1" data-bs-toggle="modal" data-bs-target="#editModal-{{ $mecanicien->id }}">Edit</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm  p-1" data-bs-toggle="modal" data-bs-target="#removeModal-{{ $mecanicien->id }}">Remove</button>
                                </td>
                            </tr>

                            @include('mecaniciens.modals.remove', ['mecanicien' => $mecanicien])
                            @include('mecaniciens.modals.edit', ['mecanicien' => $mecanicien])
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">No mechanic found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if ($mecaniciens->isEmpty())
                    <h6 class="text-center text-muted">No mechanic available</h6>
                    <a href="{{ route('mecaniciens.create') }}" class="btn btn-success">+ Add New Mechanic</a>
                @else
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('mecaniciens.create') }}" class="btn btn-success">+ Add New Mechanic</a>
                        @if (!$mecaniciens->isEmpty())
                        <a class="btn btn-warning" href="{{ route('mecaniciens.export') }}">Export mechanic Data</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
    @include('mecaniciens.search')
    <style>
        .card-header {
            background: linear-gradient(90deg, #0062E6, #33AEFF);
        }
        .btn-outline-info {
            border-color: #33AEFF;
            color: #33AEFF;
        }
       .btn-outline-info:hover {
            background-color: #33AEFF;
            color: white;
        }
       .btn-outline-danger {
            border-color: #FF6347;
            color: #FF6347;
        }
       .btn-outline-danger:hover {
            background-color: #FF6347;
            color: white;
        }
       .btn-outline-dark {
            border-color: #343a40;
            color: #343a40;
        }
       .btn-outline-dark:hover {
            background-color: #343a40;
            color: white;
        }
       .btn-warning {
            background-color: #FFC107;
            border: none;
        }
    </style>
@endsection