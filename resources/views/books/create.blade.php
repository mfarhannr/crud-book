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
                                        <input type="text" name="name" class="form-control" id="name">
                                        @error('name')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">description</label>
                                        <div id="description" style="height:330px;"></div>
                                        <textarea class="form-control" name="description" id="content-textarea" hidden style="display: none;"></textarea>
                                        @error('description')
                                            <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-5">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="card shadow-none border text-center">
                                            <label class="form-label border-dashed cursor-pointer" id="label"
                                                style="border-radius:10px;" for="imageFile">Add Thumbnail
                                                <img class="img-preview img-fluid mb-2 mx-auto">
                                                <img src="{{ asset('img/imageplus.png') }}" id="plusimg"
                                                    class="img-fluid p-md-3" alt="">
                                                <input accept="image/*" type="file" name="thumbnail"
                                                    class="form-control mt-3" id="imageFile" onchange="previewImage()">
                                            </label>
                                            @error('thumbnail')
                                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                            @enderror
                                        </div>
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        function previewImage() {
            const imageFile = document.querySelector('#imageFile');
            const imgPreview = document.querySelector('.img-preview');
            const label = document.querySelector('#label');
            const img = document.querySelector('#plusimg');

            img.style.display = 'none';
            label.style.border = 0;
            imgPreview.style.display = 'block';

            const blob = URL.createObjectURL(imageFile.files[0]);
            imgPreview.src = blob;
        }
@endsection
