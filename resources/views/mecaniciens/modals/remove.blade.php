<div class="modal fade" id="removeModal-{{ $mecanicien->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title" id="modal-title-notification">Remove Mecanicien</h6>
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
                  <h4 class="text-gradient text-danger mt-4">{{ $mecanicien->lastName }} will be removed!</h4>
              </div>
          </div>
          <div class="modal-footer gap-3">
              <form action="{{ route('mecaniciens.destroy', $mecanicien->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger btn-sm m-0">Yes, remove it</button>
              </form>
              <button type="button" class="btn btn-outline-success btn-sm m-0" data-bs-dismiss="modal">Cancel</button>
          </div>
      </div>
  </div>
</div>