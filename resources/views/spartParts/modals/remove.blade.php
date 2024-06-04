{{-- Remove modal --}}
<div class="modal fade" id="removeModal-{{ $sparePart->id }}" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel-{{ $sparePart->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="removeModalLabel-{{ $sparePart->id }}">Remove Spare Part</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <p>Are you sure you want to remove <strong>{{ $sparePart->partName }}</strong>?</p>
          </div>
          <div class="modal-footer">
              <form action="{{ route('spareParts.destroy', $sparePart->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Yes, remove it</button>
              </form>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
      </div>
  </div>
</div>