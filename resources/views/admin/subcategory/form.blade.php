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
                            {{ isset($subcategory) && $subcategory->id ? 'Edit Subcategory' : 'Add Subcategory' }}
                        </h4>
                        <form action="{{ route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $subcategory->id ?? '' }}">

                            <div class="form-group">
                                <label>Subcategory Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $subcategory->name ?? '' }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            

                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ isset($subcategory) && $subcategory->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="img" class="form-control ">
                                @if (isset($subcategory) && $subcategory->img)
                                    <img src="{{ asset($subcategory->img) }}" width="80" class="mt-2">
                                @endif
                                @error('img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <button type="submit" class="btn btn-primary mt-3">
                                {{ isset($subcategory) ? 'Update' : 'Create' }} Subcategory
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
