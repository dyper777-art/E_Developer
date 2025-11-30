@extends('frontend.layout.master')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2>Checkout</h2>
    </div>

    @if($cartItems->isEmpty())
        <div class="alert alert-warning text-center">
            Your cart is empty! <a href="{{ route('service') }}">Go shopping</a>
        </div>
    @else
        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Service Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->service->title }}</td>
                            <td>${{ number_format($item->service->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->quantity * $item->service->price, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="table-success">
                        <td colspan="3" class="text-right"><strong>Grand Total</strong></td>
                        <td><strong>${{ number_format($cartItems->sum(fn($i) => $i->quantity * $i->service->price), 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <button id="payWithQrBtn" class="btn btn-success btn-lg">Pay Now</button>
        </div>
    @endif
</div>

<!-- QR Modal -->
<div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content p-4 text-center border-0 shadow-sm rounded-4">
      <h4 class="mb-4 fw-bold text-success">💳 Scan QR to Pay</h4>
      <div class="mb-3">
        <img id="qrImage" src="" class="img-fluid rounded-3 border p-2" style="max-width: 220px;">
      </div>
      <p id="qrAmount" class="h5 fw-semibold mb-1">Amount: $0.00</p>
      <p id="paymentStatus" class="fw-bold text-primary mb-3">Waiting for payment...</p>
      <div class="d-flex justify-content-center gap-3 mt-3">
        <button id="cancelPaymentBtn" class="btn btn-outline-secondary rounded-pill px-4">Cancel</button>
        <button id="confirmPaymentBtn" class="btn btn-success rounded-pill px-4">Confirm</button>
      </div>
      <small class="text-muted d-block mt-3">
        Please scan the QR code using your banking app to complete the payment.
      </small>
    </div>
  </div>
</div>
@endsection

@section('scripts')

<script>
$(function(){
    const qrModal = $('#qrModal');

    $('#payWithQrBtn').click(function(){
        $.ajax({
            url: "{{ route('checkout.generateQr') }}",
            type: 'GET',
            dataType: 'json',
            success: function(data){
                if(data.qrUrl){
                    $('#qrImage').attr('src', data.qrUrl);
                    $('#qrAmount').text('Amount: $' + data.amount);
                    $('#paymentStatus').text('Waiting for payment...');
                    qrModal.modal('show'); // Bootstrap modal shows here
                } else {
                    alert('Error generating QR code');
                }
            },
            error: function(err){
                console.error(err);
                alert('Something went wrong!');
            }
        });
    });

    $('#cancelPaymentBtn').click(function(){
        qrModal.modal('hide');
    });

    $('#confirmPaymentBtn').click(function(){
    $.ajax({
        url: "{{ route('checkout.manualPayment') }}",
        type: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        dataType: 'json',
        success: function(data){
            if(data.paid){
                $('#paymentStatus').text('Payment Successful ✅');
                alert('Payment completed! Total: $' + data.total);

                // Redirect to home page after successful payment
                window.location.href = "{{ route('home') }}";
            } else {
                $('#paymentStatus').text('Payment Failed ❌');
                alert(data.error || 'Payment failed!');
            }
        },
        error: function(err){
            console.error(err);
            alert('Something went wrong during payment!');
        }
    });
});

});
</script>
@endsection
