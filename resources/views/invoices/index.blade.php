@extends('adminHome.index')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-body p-0 mt-4">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="bg-light">
            <tr>
              <th class="text-center text-uppercase text-secondary text-xs text-danger font-weight-bolder opacity-7">Client</th>
              <th class="text-center text-uppercase text-secondary text-xs text-danger font-weight-bolder opacity-7">Additional charges</th>
              <th class="text-center text-uppercase text-secondary text-xs text-danger font-weight-bolder opacity-7">Total</th>
              <th class="text-center text-uppercase text-secondary text-xs text-danger font-weight-bolder opacity-7">Created At</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($invoices as $invoice)
              <tr>
                <td class="text-center text-sm font-weight-normal">{{ $invoice->firstName }} {{ $invoice->lastName }}</td>
                <td class="text-center text-sm font-weight-normal">{{ number_format($invoice->additionalCharges, 2) }}DH</td>
                <td class="text-center text-sm font-weight-normal">{{ number_format($invoice->totalAmount, 2) }}DH</td>
                <td class="text-center text-sm font-weight-normal">{{ $invoice->created_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection