@extends('layouts')

@section('content')
    <div class="container my-4">
        <div>
            @if ($message = session()->has('success'))
                <div class="alert alert-success fade show" role="alert">
                    <p class="mb-0">{{ session()->get('success') }}</p>
                </div>
            @endif
            @if ($message = session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    <p class="mb-0">{{ session()->get('error') }}</p>
                </div>
            @endif
        </div>
        <div class="mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="fw-bold my-auto">Tambah Kategori</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategori.perform') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="namaJudul" class="form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" id="namaJudul">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="fw-bold my-auto">Categories Management</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive small">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width:25%">#</th>
                                <th scope="col" style="width:25%">Category Name</th>
                                <th scope="col" style="width:25%">Create at</th>
                                <th scope="col" style="width:25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($categories as $item)
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->created_at->format('F j, Y') }}</td>
                                    <td>
                                        <a href="{{ route('kategori.edit', $item->id) }}"
                                            class="btn btn-sm btn-success">Edit</a>
                                        <form class="d-inline" onsubmit="return confirm('sure to delete this data')"
                                            action="{{ route('kategori.delete', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger mb-0">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
