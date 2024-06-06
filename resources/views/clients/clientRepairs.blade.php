@extends('clientHome.index')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mt-1">{{ session('success') }}</div>
    @endif
    <div class="card mt-4">
      <div class="card-body p-0 mt-4 ">
          <div class="table-responsive">
                @if (!$vehiclesInRepair->isEmpty())
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Make</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Model</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Start Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">End Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiclesInRepair as $repair)
                                <tr>
                                    <td class="text-center text-sm font-weight-normal">{{ $repair['marke'] }}</td>
                                    <td class="text-center text-sm font-weight-normal">{{ $repair['model'] }}</td>
                                    <td class=" text-center text-sm  m-0">
                                      @php
                                          $statusClass = 'info'; 
                                          switch ($repair['status']) {
                                              case 'panding':
                                                  $statusClass = 'danger';
                                                  break;
                                              case 'in progress':
                                                  $statusClass = 'info';
                                                  break;
                                              case 'finished':
                                                  $statusClass = 'uccess';
                                                  break;
                                          }
                                      @endphp
                                      <div class="badge badge-sm bg-{{ $statusClass }}"  data-toggle="tooltip" title="{{$repair['status']}}">{{ $repair['status'] }}</div>
                                  </td>
                                    <td class="text-center text-sm font-weight-normal">{{ $repair['startDate'] }}</td>
                                    <td class="text-center text-sm font-weight-normal">{{ $repair['endDate'] }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-outline-dark btn-sm p-2" data-bs-toggle="modal" data-bs-target="#editModal-{{ $repair['id'] }}">view notes</button>
                                    </td>
                                </tr>

                                <!-- Edit Comment Modal -->
                                <div class="modal fade" id="editModal-{{ $repair['id'] }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCommentModalLabel">notes</h5>
                                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mechanic-notes my-3 p-3 rounded shadow-sm">
                                                    <h6 class="border-bottom pb-2 mb-0">Mechanic Notes</h6>
                                                    <div class="media text-muted pt-3">
                                                        <span class="d-block">{{ $repair['mechanicNotes'] }}</span>
                                                    </div>
                                                </div>
                                                <form method="POST" action="{{ route('clients.updateClientComment') }}">
                                                    @csrf
                                                    <input type="hidden" name="repair_id" value="{{ $repair['id'] }}">
                                                    <div class="form-group">
                                                        <label for="clientNotes">Client Notes</label>
                                                        <textarea class="form-control" id="clientNotes" name="clientNotes" rows="3">{{ $repair['clientNotes'] }}</textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-success btn-sm m-0 m-1">Save changes</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger btn-sm m-1" data-bs-dismiss="modal">Close</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="col-md-12">
                        <h3 class="py-3 text-center">No repairs available</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
