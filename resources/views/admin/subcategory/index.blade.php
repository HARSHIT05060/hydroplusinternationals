@extends('admin.layouts.app')
@section('content')
    <div class="container mt-5">

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Subcategory List</h4>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('subcategory.createUpdate') }}" class="btn btn-primary">+ Add Subcategory</a>
                    </div>

                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-striped table-responsive">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $sub)
                            <tr>
                                <td>{{ $sub->name }}</td>
                                <td>{{ $sub->category->name }}</td>
                                <td><img src="{{ URL($sub->img) }}" width="60"></td>
                                <td>
                                    <a href="{{ route('subcategory.createUpdate', $sub->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('subcategory.delete', $sub->id) }}" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
