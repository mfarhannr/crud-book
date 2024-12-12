@extends('layouts')
@section('content')
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <h5 class="fw-bold my-auto">Add Book</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Book Name</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p class='text-danger mb-0 text-xs pt-1'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" name="author" class="form-control" id="author" value="{{ old('author') }}">
                                        @error('author')
                                            <p class="text-danger mb-0 text-xs pt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="10">{{ old('description') }}</textarea>
                                        @error('description')
                                            <p class="text-danger mb-0 text-xs pt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="imageFile" class="form-label">Add Thumbnail</label>
                                        <div class="text-center">
                                            <img id="imgPreview" src="{{ asset('img/image-preview.png') }}" class="img-fluid mb-3" alt="Preview">
                                            <input type="file" name="thumbnail" class="form-control" id="imageFile" onchange="previewImage()">
                                        </div>
                                        @error('thumbnail')
                                            <p class='text-danger mb-0 text-xs pt-1'>{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategoriSelect" class="form-label">Book Category</label>
                                        <select class="form-select" name="book_category_id" id="Select">
                                            <option selected="" value="">Choose Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('book_category_id')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="/berita" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
         function previewImage() {
            const imageFile = document.getElementById('imageFile');
            const imgPreview = document.getElementById('imgPreview');
            const file = imageFile.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
