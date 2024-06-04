<div class="modal fade" id="editModal-{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-notification">Edit Client</h6>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="{{ route('clients.update', $client->id) }}" method="POST" class="max-w-md mx-auto bg-white rounded shadow">
                  @csrf
                  @method('PUT')
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="firstName" class="form-control-label">First Name</label>
                              <input class="form-control" type="text" id="firstName" name="firstName" value="{{ $client->firstName }}" required>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="lastName" class="form-control-label">Last Name</label>
                              <input class="form-control" type="text" id="lastName" name="lastName" value="{{ $client->lastName }}" required>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="address" class="form-control-label">Address</label>
                              <input class="form-control" type="text" id="address" name="address" value="{{ $client->address }}" required>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="phoneNumber" class="form-control-label">Phone Number</label>
                              <input class="form-control" type="text" id="phoneNumber" name="phoneNumber" value="{{ $client->phoneNumber }}" required>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <button type="submit" class="btn btn-primary">Edit Client</button>
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
