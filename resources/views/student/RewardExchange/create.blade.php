@extends('layouts.nav')
@section('content')
<div class="container">
    <h1>Select a Reward to Exchange with</h1>
    <br>
    <div class="row">
        @foreach ($rewards as $reward)
            <div class="col-lg-3 col-md-6">
                <div class="service-item" style="border: 1px solid #ddd; padding: 15px; text-align: center;">
                    <div class="img-frame" style="width: 100%; height: 200px; overflow: hidden;">
                        <img src="{{ Vite::asset('storage/app/public/'. $reward->image_url) }}" alt="Service" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <h3>{{ $reward->description }}</h3>
                    <p>In Stock: {{ $reward->avail_qty }}</p>
                    <h5 style="margin-top: -10px; margin-bottom: 10px;">Required Points: {{ $reward->points_required }} Points</h5>
                    <a class="btn btn-primary book-now" 
                        data-reward-id="{{ $reward->id }}"
                        data-description="{{ $reward->description }}" 
                        data-avail_qty="{{ $reward->avail_qty }}" 
                        data-points_required="{{ $reward->points_required }}">
                        Exchange Reward
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center my-4"> 
        {{ $rewards->links('pagination::bootstrap-5') }} 
    </div>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="ajax-product-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="productCrudModal">Create a Reward Exchange Request</h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('reward_exchange.store') }}">
                    @csrf
                    <input type="hidden" name="reward_id" id="reward_id"> <!-- Hidden field for reward_id -->

                    <div class="form-group">
                        <label for="avail_points" class="col-sm-12 control-label">Available Reward Points</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="avail_points" name="avail_points" value="{{ $userStats ? $userStats->outstanding_points : 0 }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-sm-4 control-label">Reward Description</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" value="" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avail_qty" class="col-sm-4 control-label">Qty in stock</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="avail_qty" name="avail_qty" value="" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="points_required" class="col-sm-12 control-label">Points Needed to Exchange</label>
                        <div class="col-sm-12">points_remaining
                            <input type="text" class="form-control" id="reward_point" name="reward_point" value="" hidden>
                            <input type="text" class="form-control" id="points_required" name="points_required" value="" readonly>
                            <input type="text" class="form-control" id="points_remaining" name="points_remaining" value="" hidden>
                        </div>
                    </div>       
                    
                    
                    <div class="form-group">
                        <label for="qty" class="col-sm-4 control-label">Quantity to Redeem</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="qty" name="qty" value="" required>
                            <!-- Warning message -->
                            <small id="points-warning" class="text-danger" style="display: none;">You do not have enough points to redeem this quantity.</small>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save" style="margin-top: 10px;">Exchange Reward Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to populate modal with selected service data -->
{{-- <script>
    $(document).ready(function() {
        $('.book-now').click(function() {
            var rewardId = $(this).data('reward-id');
            var description = $(this).data('description');
            var avail_qty = $(this).data('avail_qty');
            var points_required = $(this).data('points_required');

            $('#reward_id').val(rewardId); 
            $('#description').val(description);
            $('#avail_qty').val(avail_qty);
            $('#points_required').val(points_required);

            // Show the modal
            $('#ajax-product-modal').modal('show');
        });
    });
</script> --}}
<script>
    $(document).ready(function() {
        // Open modal and populate fields
        $('.book-now').click(function() {
            var rewardId = $(this).data('reward-id');
            var description = $(this).data('description');
            var avail_qty = $(this).data('avail_qty');
            var points_required = $(this).data('points_required');

            $('#reward_id').val(rewardId); 
            $('#description').val(description);
            $('#avail_qty').val(avail_qty);
            $('#points_required').val(points_required);
            $('#reward_point').val(points_required);

            $('#ajax-product-modal').modal('show');
        });

        $('#qty').on('input', function() {
            var qty = parseInt($(this).val());
            var pointsRequired = parseInt($('#reward_point').val());
            var availPoints = parseInt($('#avail_points').val());
            
            var totalPointsRequired = pointsRequired * qty;
            var pointsRemaining = availPoints - totalPointsRequired;
            $('#points_remaining').val(pointsRemaining)

            if(!isNaN(qty)){
                $('#points_required').val(totalPointsRequired);
            }else{
                $('#points_required').val(pointsRequired);
            }

            if (totalPointsRequired > availPoints) {
                $('#points-warning').show();
                $('#btn-save').prop('disabled', true);
            } else {
                $('#points-warning').hide();
                $('#btn-save').prop('disabled', false);
            }
        });
    });

</script>

@endsection
