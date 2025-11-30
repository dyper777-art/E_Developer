<!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend/assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('frontend/assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/assets/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('frontend/assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>

    <!-- At the bottom before </body> -->


<script>
$(function() {
    // ========================
    // Add to Cart
    // ========================
    $('.add-to-cart').on('click', function(e) {
        e.preventDefault();
        const serviceId = $(this).data('service-id');

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            contentType: 'application/json',
            data: JSON.stringify({ serviceId: serviceId }),
            success: function(data) {
                if(data.success){
                    alert(data.message);
                } else {
                    alert(data.message || 'Something went wrong');
                }
            },
            error: function(err) {
                console.error(err);
                alert('Error adding service to cart');
            }
        });
    });

    // ========================
    // Service Read
    // ========================
    $('.service_read').on('click', function() {
        window.location.href = "{{ route('service') }}";
    });

    // ========================
    // QR Modal
    // ========================
    const qrModal = $('#qrModal');

    $('#payWithQrBtn').click(function() {
        $.ajax({
            url: "{{ route('checkout.generateQr') }}",
            type: 'GET',
            dataType: 'json',
            success: function(data){
                if(data.qrUrl){
                    $('#qrImage').attr('src', data.qrUrl);
                    $('#qrAmount').text('Amount: $' + data.amount);
                    $('#paymentStatus').text('Waiting for payment...');
                    qrModal.modal('show'); // Show Bootstrap modal
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
                    location.reload();
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

<script>
    document.querySelectorAll('.remove-item').forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            if (confirm('Are you sure you want to remove this item?')) {
                fetch(`/cart-items/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload(); // reload page to update cart
                })
                .catch(error => console.error(error));
            }
        });
    });
</script>




 {{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all buttons with the class 'add-to-cart'
    const buttons = document.querySelectorAll('.add-to-cart');

    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // prevent default anchor behavior

            const serviceId = this.dataset.serviceId; // get service ID

            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ serviceId: serviceId })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert(data.message); // show success message
                    // Optionally, update cart count in header
                    // document.getElementById('cart-count').innerText = data.cart_count;
                } else {
                    alert(data.message || 'Something went wrong');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Error adding service to cart');
            });
        });
    });
});
</script> --}}



{{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all buttons with the class 'service_read'
    const buttons = document.querySelectorAll('.service_read');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            // Redirect to your route
            window.location.href = "{{ route('service') }}";
        });
    });
});
</script> --}}
