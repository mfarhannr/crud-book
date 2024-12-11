@extends('layouts')
@section('content')
    <div class="container my-4">
        <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Book Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $book->name }}"
                                    id="name">
                                @error('name')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">description</label>
                                <div id="description" style="height:350px;">{!! $book->description !!}</div>
                                <textarea class="form-control" name="description" id="content-textarea" hidden style="display: none;">{!! $book->description !!}</textarea>
                                @error('description')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="card shadow-none border text-center ">
                                    <label class="form-label border-dashed cursor-pointer" id="label"
                                        style="border-radius:10px;" for="imageFile">Edit Thumbnail
                                        <img class="img-preview img-fluid mb-2">
                                        <img src="{{ asset('img/thumbnail/' . $book->thumbnail) }}" id="plusimg"
                                            class="img-fluid p-md-3" alt="">
                                        <input accept="image/*" type="file" name="thumbnail" value="{{ $book->thumbnail }}"
                                            class="form-control mt-3" id="imageFile" onchange="previewImage()">
                                    </label>
                                    @error('thumbnail')
                                        <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="Select" class="form-label">Book Category</label>
                                <select class="form-select" name="book_category_id" id="Select">
                                    @foreach ($categories as $category)
                                        @if ($category->id === $book->book_category_id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}
                                            </option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('book_category_id')
                                    <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="/book" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
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
