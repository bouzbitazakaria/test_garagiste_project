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
                                        <button type="button" class="btn btn-outline-info btn-sm m-0" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $reparation->id }}">Detail</button>
                                        <button type="button" class="btn btn-outline-info btn-sm m-0" data-bs-toggle="modal" data-bs-target="#editModal-{{ $reparation->id }}">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm m-0" data-bs-toggle="modal" data-bs-target="#removeModal-{{ $reparation->id }}">Remove</button>
                                    </td>
                                    @include('reparations.modals.detail', ['reparation' => $reparation])
                                    @include('reparations.modals.edit',['reparation'=>$reparation])
                                    @include('reparations.modals.remove',['reparation'=>$reparation])
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
