@extends('mecanicienHome.index')

@section('content')
    @if(session('success'))
        <div class="text-success-500">{{ session('success') }}</div>
    @endif
    <div class="col-12 mt-5">
        <div class="card mb-4">
            <div class="card-body px-0 pt-0 pb-2">
                @if (!$reparations->isEmpty())
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Start Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">End Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mechanic Notes</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Client Notes</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reparations as $reparation)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $reparation->description }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-start text-sm ">
                                        @php
                                            $statusClass = 'info'; 
                                            switch ($reparation->status) {
                                                case 'en attend':
                                                    $statusClass = 'danger';
                                                    break;
                                                case 'en cours':
                                                    $statusClass = 'info';
                                                    break;
                                                case 'termine':
                                                    $statusClass = 'success';
                                                    break;
                                            }
                                        @endphp
                                        <div class="badge badge-sm bg-{{ $statusClass }}">{{ $reparation->status }}</div>
                                    </td>
                                    <td class="align-middle text-center text-sm ">
                                        <p class="text-xs text-secondary mb-0">{{ $reparation->startDate }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $reparation->endDate }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $reparation->mechanicNotes }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $reparation->clientNotes }}</span>
                                    </td>
                                    <td class="align-middle text-end">
                                        <button type="button" class="btn btn-outline-info btn-sm m-0" data-bs-toggle="modal" data-bs-target="#editModal-{{ $reparation->id }}">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm m-0" data-bs-toggle="modal" data-bs-target="#removeModal-{{ $reparation->id }}">Remove</button>
                                    </td>

                                    {{-- Edit modal --}}
                                    <div class="modal fade" id="editModal-{{ $reparation->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-notification">Edit Reparation</h6>
                                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('reparations.update', $reparation->id) }}" method="POST" class="max-w-md mx-auto bg-white rounded shadow">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="description" class="form-control-label">Description</label>
                                                                    <input class="form-control" type="text" id="description" name="description" value="{{ $reparation->description }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="status" class="form-control-label">Status</label>
                                                                    <input class="form-control" type="text" id="status" name="status" value="{{ $reparation->status }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="startDate" class="form-control-label">Start Date</label>
                                                                    <input class="form-control" type="date" id="startDate" name="startDate" value="{{ $reparation->startDate }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="endDate" class="form-control-label">End Date</label>
                                                                    <input class="form-control" type="date" id="endDate" name="endDate" value="{{ $reparation->endDate }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="mechanicNotes" class="form-control-label">Mechanic Notes</label>
                                                                    <textarea class="form-control" id="mechanicNotes" name="mechanicNotes" required>{{ $reparation->mechanicNotes }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="clientNotes" class="form-control-label">Client Notes</label>
                                                                    <textarea class="form-control" id="clientNotes" name="clientNotes" disabled>{{ $reparation->clientNotes }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-primary">Edit Reparation</button>
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
                                    <div class="modal fade" id="removeModal-{{ $reparation->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="modal-title-notification">Remove Reparation</h6>
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
                                                        <h4 class="text-gradient text-danger mt-4">{{ $reparation->description }} will be removed!</h4>
                                                    </div>
                                                </div>
                                                <div class="modal-footer gap-3">
                                                    <form action="{{ route('reparations.destroy', $reparation->id) }}" method="post">
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
                    <h3 class="py-3 text-center">No Repairs</h3>
                @endif
            </div>
        </div>
        <a href="{{ route('reparations.create') }}" class="block mt-4 text-blue-600 hover:underline">+ Add new repair</a>
    </div>
@endsection
