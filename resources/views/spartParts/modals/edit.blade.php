{{-- Edit modal --}}
<div class="modal fade" id="editModal-{{ $sparePart->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $sparePart->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editModalLabel-{{ $sparePart->id }}">Edit Spare Part</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="{{ route('spareParts.update', $sparePart->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                      <label for="partName">Part Name</label>
                      <input type="text" class="form-control" id="partName" name="partName" value="{{ $sparePart->partName }}" required>
                  </div>
                  <div class="form-group">
                      <label for="partReference">Part Reference</label>
                      <input type="text" class="form-control" id="partReference" name="partReference" value="{{ $sparePart->partReference }}" required>
                  </div>
                  <div class="form-group">
                      <label for="supplier">Supplier</label>
                      <input type="text" class="form-control" id="supplier" name="supplier" value="{{ $sparePart->supplier }}" required>
                  </div>
                  <div class="form-group">
                      <label for="price">Price</label>
                      <input type="number" class="form-control" id="price" name="price" value="{{ $sparePart->price }}" required>
                  </div>
                  <div class="form-group">
                      <label for="stock">Stock</label>
                      <input type="number" class="form-control" id="stock" name="stock" value="{{ $sparePart->stock }}" required>
                  </div>
                  <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
      </div>
  </div>
</div>