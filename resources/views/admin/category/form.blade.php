@extends('admin.layouts.app')
@section('content')
    <style>
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
    <div class="container mt-5">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ isset($category) && $category->id ? 'Edit Category' : 'Add Category' }}
                        </h4>
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $category->id ?? '' }}">

                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
                                    class="form-control">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="img" class="form-control">
                                @if (!empty($category->img))
                                    <img src="{{ asset($category->img) }}" width="100" class="mt-2">
                                @endif
                                @error('img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <button type="submit" class="btn btn-primary mt-3">
                                {{ isset($category) ? 'Update' : 'Create' }} Category
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#form').validate({
                rules: {
                    state_name: {
                        required: true
                    },
                    country_id: {
                        required: true
                    }
                },
                messages: {
                    state_name: {
                        required: "Please enter a state name"
                    },
                    country_id: {
                        required: "Please select a country name"

                    }
                }
            });
        });
    </script>
    </div>
    </div>
@endsection
