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
                            <select class="form-control" id="status" name="status" required>
                                <option value="pending" {{ $reparation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in progress" {{ $reparation->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="finished" {{ $reparation->status == 'finished' ? 'selected' : '' }}>Finished</option>
                            </select>
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