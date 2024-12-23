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
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold my-auto">Book Management</h5>
                    <a href="/book/create" class="btn btn-secondary">Add Book</a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
                        @csrf
                        <div class="input-group">
                            <input type="file" name="file" class="form-control form-control-sm" required>
                            <button type="submit" class="btn btn-success btn-sm">Import</button>
                        </div>
                    </form>
                    <a href="{{ route('books.export') }}" class="btn btn-primary btn-sm ms-2">Export</a>
                </div>
                <div class="table-responsive small">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Book Category</th>
                                <th scope="col">Author</th>
                                <th scope="col">Thumbnail</th>
                                <th scope="col">Description</th>
                                <th scope="col">Create_at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($books as $item)
                                <tr>
                                    <th>{{ $no++ }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td>{{ $item->thumbnail }}</td>
                                    <td>{!! Str::limit($item->description, 100) !!}</td>
                                    <td>{{ $item->created_at->format('F j, Y') }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('book.edit', $item->id) }}"
                                                class="btn btn-success btn-sm"><i
                                                    class="bi bi-pencil-square"></i>Edit</a>
                                            <form onsubmit="return confirm('sure to delete this data')"
                                                action="{{ route('book.destroy' ,  $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger mb-0 ms-2">
                                                    <i class="bi bi-trash"></i>Delete</button>
                                            </form>
                                        </div>
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
