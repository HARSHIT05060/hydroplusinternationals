@extends('admin.layouts.app')
@section('content')
    <div class="container mt-5">

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Category List</h4>
                    <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Add New Category</a>
                </div>
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                    <table class="table table-bordered table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if ($category->img)
                                        <img src="{{ URL($category->img) }}" width="80">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
