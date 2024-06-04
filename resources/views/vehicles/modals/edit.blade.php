<div class="modal fade" id="editModal-{{ $vehicle->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-notification">Edit Vehicle</h6>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" class="max-w-md mx-auto  rounded shadow">
                  @csrf
                  @method('PUT')
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="marke" class="form-control-label">Make</label>
                              <input class="form-control" type="text" id="marke" name="marke" value="{{ $vehicle->marke }}" required>
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
                              <label for="fuelType" class="form-control-label">Fuel Type</label>
                              <input class="form-control" type="text" id="fuelType" name="fuelType" value="{{ $vehicle->fuelType }}" required>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="registration" class="form-control-label">Registration</label>
                              <input class="form-control" type="text" id="registration" name="registration" value="{{ $vehicle->registration }}" required>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <button type="submit" class="btn btn-primary">Edit Vehicle</button>
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