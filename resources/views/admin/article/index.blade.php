@extends('layouts.nav')
@section('content')

<div class="container">
    <h1>Articles</h1>
    <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-article">Add New Article</a>
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
                        <th>Title</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td><img src="{{ Vite::asset('storage/app/public/' . $article->image_url) }}" alt="Article Image" width="100"></td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->author }}</td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-primary edit-article" data-id="{{ $article->id }}">Edit</a>
                            <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this article?');">
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

<!-- Modal for creating/editing articles -->
<div class="modal fade" id="ajax-article-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="articleCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form id="articleForm" name="articleForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="article_id" id="article_id">
                    <input type="hidden" name="_method" id="method" value="POST">

                    <div class="form-group">
                        <label for="title" class="col-sm-4 control-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Article Title" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="intro" class="col-sm-4 control-label">Introduction</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="intro" name="intro" placeholder="Enter Article Introduction" required=""></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="body" class="col-sm-4 control-label">Body</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="body" name="body" placeholder="Enter Article Body" required=""></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="conclusion" class="col-sm-4 control-label">Conclusion</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="conclusion" name="conclusion" placeholder="Enter Article Conclusion" required=""></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="reference" class="col-sm-4 control-label">References</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="reference" name="reference" placeholder="Enter References" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="author" class="col-sm-4 control-label">Author</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="author" name="author" placeholder="Enter Author Name" value="" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Upload Image</label>
                        <div class="col-sm-12">
                            <input id="image_url" type="file" name="image_url" accept="image/*" onchange="readURL(this);">
                            <input type="hidden" name="hidden_image" id="hidden_image">
                        </div>            
                    </div>
                    
                    <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="200" height="200" style="margin-top: 10px;">
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
        // Show the modal for adding new article
        $('#create-new-article').click(function() {
            $('#articleForm').trigger("reset"); 
            $('#ajax-article-modal').modal('show'); 
            $('#articleCrudModal').html("Add Article");
            $('#modal-preview').attr('src', 'https://via.placeholder.com/150').addClass('hidden'); 
            $('#btn-save').text('Save Article'); 
            $('#method').val('POST'); 
            $('#articleForm').attr('action', "{{ route('article.store') }}");
        });

        // Show the modal for editing an existing article
        $('body').on('click', '.edit-article', function() {
            var article_id = $(this).data('id');
            $.get("{{ route('article.index') }}" + '/' + article_id + '/edit', function(data) {
                $('#articleCrudModal').html("Edit Article");
                $('#method').val('PUT'); 
                $('#article_id').val(data.id); 
                $('#title').val(data.title);
                $('#intro').val(data.intro);
                $('#body').val(data.body);
                $('#conclusion').val(data.conclusion);
                $('#reference').val(data.reference);
                $('#author').val(data.author);
                $('#hidden_image').val(data.image_url);
                $('#modal-preview').attr('src', '{{ Vite::asset('storage/app/public/') }}' + data.image_url).removeClass('hidden'); 
                $('#articleForm').attr('action', "{{ route('article.update', '') }}/" + data.id); 
                $('#btn-save').text('Update Article'); 
                $('#ajax-article-modal').modal('show'); 
            });
        });

        // Handle form submission
        $('#articleForm').on('submit', function(e) {
            e.preventDefault(); 
            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: (data) => {
                    $('#ajax-article-modal').modal('hide');
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
