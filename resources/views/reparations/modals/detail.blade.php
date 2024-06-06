<div class="modal fade" id="detailModal-{{ $reparation->id }}" tabindex="-1" aria-labelledby="detailModalLabel-{{ $reparation->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModal-{{ $reparation->id }}"> Spare Part for this repair</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9">
                        <h6>Total Price: ${{ $reparation->spareParts->sum(function($sparePart) { return $sparePart->price * $sparePart->pivot->quantity; }) }}</h6>
                        <div class="row">
                            @foreach ($reparation->spareParts as $sparePart)
                            <div class="col-md-4">
                                <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $sparePart->partName }}</h5>
                                    <p class="card-text">Quantity: {{ $sparePart->pivot->quantity }}</p>
                                    <p class="card-text">Price: ${{ $sparePart->price }}</p>
                                    <p class="card-text">Total: ${{ $sparePart->price * $sparePart->pivot->quantity }}</p>
                                </div>
                                </div>
                            </div>
                            @endforeach
                            
                           </div>
                    </div>
                    <div class="col-md-3">
                       @if ($reparation->status != 'finished')
                           <form action="{{ route('repairSparePart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="repair_id" value="{{ $reparation->id }}">
                            <div class="mb-3">
                                <label for="spare_part_id" class="form-label">Spare Part</label>
                                <select name="spare_part_id" class="form-control">
                                    @foreach($spareParts as $sparePart)
                                        <option value="{{ $sparePart->id }}">{{ $sparePart->partName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Spare Part</button>
                        </form>
                       @else
                       <form action="{{ route('invoices.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="repair_id" value="{{ $reparation->id }}">
                        <div class="mb-3">
                            <label for="spare_part_id" class="form-label">additional Charges</label>
                            <input type="number" name="additionalCharges" class="form-control" required>
                            <input type="hidden" name="sparePartsAmount" value="{{ $reparation->spareParts->sum(function($sparePart) { return $sparePart->price * $sparePart->pivot->quantity; }) }}">
                        </div>
                        <button type="submit" class="btn btn-primary">generate invoice</button>
                    </form>
                       
                       @endif
                        
                    </div>
                </div>
                    
                
            </div>
        </div>
    </div>
  </div>
<style>
    .card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-title {
    font-size: 1.25rem;
    font-weight: bold;
}

.card-text {
    font-size: 1rem;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    border-radius: 25px;
}

.btn-primary:hover {
    background-color: #0056b3;
}
    
</style>  