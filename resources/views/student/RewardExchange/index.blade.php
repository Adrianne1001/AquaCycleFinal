@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Exchange Rewards</h1>
    <a href="{{ route('reward_exchange.create') }}" class="btn btn-info ml-3" >Exchange Rewards Now!</a>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List of Pending/Approved Exchange Requests
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Reward Description</th>
                        <th>Exchanged Quantity</th>
                        <th>Pts per Qty</th>
                        {{-- <th>Request Date</th> --}}
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Reward Description</th>
                        <th>Exchanged Quantity</th>
                        <th>Pts per Qty</th>
                        {{-- <th>Request Date</th> --}}
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($rewardExchanges as $rewardExchange)
                    <tr>
                        <td>{{ $rewardExchange->reward->description }}</td>
                        <td>{{ $rewardExchange->qty }}</td>
                        <td>{{ $rewardExchange->reward->points_required }}</td>
                        {{-- <td>{{ $rewardExchange->created_at->format('Y-m-d h:i A') }}</td> --}}
                        <td>{{ $rewardExchange->status }}</td>
                        <td>
                            @if($rewardExchange->status === "Approved")
                            Your request has been approved. Please claim it at <br>the IT bldg lobby this Friday at 5:00PM.
                            @else
                            Your request is still pending approval. Please wait for confirmation.
                            @endif
                        </td>                        
                        <td>
                            @if($rewardExchange->status === "Approved")
                            <button type="#" class="btn btn-secondary" disabled>Not Applicable</button>
                            @else
                            {{-- <a href="javascript:void(0)" class="btn btn-primary edit-reward_exchange" data-id="{{ $rewardExchange->id }}">Edit</a> --}}
                            <form action="{{ route('reward_exchange.destroy', $rewardExchange->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to Cancel this Exchange Request?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancel Request</button>
                            </form>    
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="ajax-product-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="productCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="reward_exchange_id" id="reward_exchange_id">
                    <input type="hidden" name="_method" id="method" value="POST">

                    <div class="form-group">
                        <label for="avail_points" class="col-sm-12 control-label">Available Reward Points</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="avail_points" name="avail_points" value="{{ $userStats ? $userStats->outstanding_points : 0 }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reward_id" class="col-sm-4 control-label">Reward</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="reward_id" name="reward_id" required="">
                                <option value="">Select a reward</option>
                                @foreach($rewards as $reward)
                                    <option value="{{ $reward->id }}" data-img-url="{{ $reward->image_url }}"
                                        data-points_required="{{ $reward->points_required }}"
                                        data-avail_qty="{{ $reward->avail_qty }}"
                                        >{{ $reward->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="points_required" class="col-sm-4 control-label">Required Points</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="points_required" name="points_required" value="" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avail_qty" class="col-sm-4 control-label">Quantity In Stock</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="avail_qty" name="avail_qty" value="" disabled>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="modal-preview" class="form-label">Reward Preview</label>
                        </div>
                        <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="150" height="150" style="margin-top: 10px;">
                    </div>       
                    <div class="form-group">
                        <label for="qty" class="col-sm-4 control-label">Quantity to Redeem</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="qty" name="qty" value="" required>
                        </div>
                    </div>                 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save" style="margin-top: 10px;"></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // $('#create-new-booking').click(function() {
        //     $('#productForm').trigger("reset"); 
        //     $('#ajax-product-modal').modal('show'); 
        //     $('#productCrudModal').html("Add Booking");
        //     $('#modal-preview').attr('src', 'https://via.placeholder.com/150').addClass('hidden');
        //     $('#btn-save').text('Submit Booking'); 
        //     $('#method').val('POST'); 
        //     $('#productForm').attr('action', "{{ route('reward_exchange.store') }}"); 
        // });

        $('body').on('click', '.edit-reward_exchange', function() {
            var reward_exchange_id = $(this).data('id');
            $.get("{{ route('reward_exchange.index') }}" + '/' + reward_exchange_id + '/edit', function(data) {
                $('#productCrudModal').html("Edit Exchange Request");
                $('#method').val('PUT'); 
                $('#reward_exchange_id').val(data.id); 
                $('#reward_id').val(data.reward_id); 
                $('#points_required').val(data.reward.points_required); 
                $('#avail_qty').val(data.reward.avail_qty); 
                $('#qty').val(data.qty); 
                var image_url = data.reward.image_url;
                console.log(image_url);
                if(image_url != null){
                $('#modal-preview').attr('src', '{{ Vite::asset('storage/app/public/') }}' + image_url).removeClass('hidden'); 
                }
                else{
                    $('#modal-preview').attr('src', 'https://via.placeholder.com/150').addClass('hidden');
                }
                $('#productForm').attr('action', "{{ route('reward_exchange.update', '') }}/" + data.id); 
                $('#btn-save').text('Save Changes'); 
                $('#ajax-product-modal').modal('show'); 
            });
        });

        // Handle form submission
        $('#productForm').on('submit', function(e) {
            e.preventDefault(); 
            let formData = new FormData(this); 

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: (data) => {
                    $('#ajax-product-modal').modal('hide');
                    location.reload(); 
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#reward_id').on('change', function() {
            var image_url = $(this).find(':selected').data('img-url');
            var  points_required = $(this).find(':selected').data('points_required');
            var avail_qty = $(this).find(':selected').data('avail_qty');
            $('#points_required').val(points_required); 
            $('#avail_qty').val(avail_qty); 

            if (image_url != null) {
                $('#modal-preview').attr('src', '{{ Vite::asset('storage/app/public/') }}' + image_url).removeClass('hidden');
            } else {
                $('#modal-preview').attr('src', 'https://via.placeholder.com/150').addClass('hidden');
            }
        });
    });
</script>

@endsection
