@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Rewards</h1>
    <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-product">Add New</a>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Published Articles
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>                  
                        <th>Image</th>              
                        <th>Description</th>     
                        <th>Available Quantity</th>     
                        <th>Points Required</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>                  
                        <th>Image</th>              
                        <th>Description</th>     
                        <th>Available Quantity</th>     
                        <th>Points Required</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($rewards as $reward)
                    <tr>
                        <td><img src="{{Vite::asset('storage/app/public/' . $reward->image_url) }}" alt="Reward Image"  width="100"></td>
                        <td>{{ $reward->description }}</td>
                        <td>{{ $reward->avail_qty }}</td>
                        <td>{{ $reward->points_required }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary edit-reward" data-id="{{ $reward->id }}">Edit</a>
                            <form action="{{ route('reward.destroy', $reward->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this reward?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach              
                </tbody>
            </table>
        </div>
    </div>    
</div>

<!-- Modal for creating/editing rewards -->
<div class="modal fade" id="ajax-product-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="productCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id">
                    <input type="hidden" name="_method" id="method" value="POST">
                    
                    <div class="form-group">
                        <label for="description" class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Reward Description" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="avail_qty" class="col-sm-4 control-label">Quantity in Stock</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="avail_qty" name="avail_qty" placeholder="Enter Available Quantity" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="points_required" class="col-sm-4 control-label">Points Required</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="points_required" name="points_required" placeholder="Enter Points Required" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Upload Image</label>
                        <div class="col-sm-12">
                            <input id="image_url" type="file" name="image_url" accept="image/*" onchange="readURL(this);" >
                            <input type="hidden" name="hidden_image" id="hidden_image" >
                        </div>
                    </div>
                    <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100" height="100" style="margin-top: 10px;">
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
        // Show the modal for adding new reward
        $('#create-new-product').click(function() {
            $('#productForm').trigger("reset"); 
            $('#ajax-product-modal').modal('show'); 
            $('#productCrudModal').html("Add Reward");
            $('#modal-preview').attr('src', 'https://via.placeholder.com/150').addClass('hidden'); 
            $('#btn-save').text('Save Reward'); 
            $('#method').val('POST'); 
            $('#productForm').attr('action', "{{ route('reward.store') }}"); 
        });

        // Show the modal for editing an existing reward
        $('body').on('click', '.edit-reward', function() {
            var reward_id = $(this).data('id');
            $.get("{{ route('reward.index') }}" + '/' + reward_id + '/edit', function(data) {
                $('#productCrudModal').html("Edit Reward");
                $('#method').val('PUT'); 
                $('#product_id').val(data.id); 
                $('#description').val(data.description); 
                $('#avail_qty').val(data.avail_qty);
                $('#points_required').val(data.points_required);
                $('#hidden_image').val(data.image_url);
                $('#modal-preview').attr('src', '{{ Vite::asset('storage/app/public/') }}' + data.image_url).removeClass('hidden'); 
                $('#productForm').attr('action', "{{ route('reward.update', '') }}/" + data.id); 
                $('#btn-save').text('Update Reward'); 
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

        // Preview the selected image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#modal-preview').attr('src', e.target.result).removeClass('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#image_url').change(function() {
            readURL(this); 
        });
    });
</script>

@endsection
