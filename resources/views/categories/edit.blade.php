@extends('layouts')

@section('content')
    <div class="container my-4">
        <div class="mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="fw-bold my-auto">Edit category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategori.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Category Name</label>
                            <input type="text" name="nama_kategori" value="{{ $category->name }}"
                                class="form-control" id="namaKategori">
                        </div>
                        <div class="text-end">
                            <a href="/kategori" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
