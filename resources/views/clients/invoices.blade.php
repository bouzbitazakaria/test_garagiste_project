@extends('clientHome.index')


@section('content')
<div class="container">
  <div class="row mt-4">
              @if (!$invoices->isEmpty())
                  @foreach ($invoices as $invoice)
                      <div class="col-md-4 mb-1">
                          <div class="card">
                              <div class="card-body">
                                  <h5 class="card-title mb-5">Vehicle : {{ $invoice->marke }} {{$invoice->model}}</h5>
                                  <p class="card-text"><strong class="text-danger">mechanic charges:</strong> {{ $invoice->additionalCharges }} DH</p>
                                  <p class="card-text"><strong class="text-danger">total including spare parts:</strong> {{ $invoice->totalAmount }} DH</p>
                                  
                              </div>
                              <div class="card-footer text-center">
                                <a class="text-center" href="{{ route('invoice.pdf', $invoice->id) }}">Download PDF</a>
                              </div>
                          </div>
                      </div>
                  @endforeach
              @else
                  <div class="col-md-12">
                      <h3 class="py-3 text-center text-white">No invoices</h3>
                  </div>
              @endif
  </div>
</div>

@endsection