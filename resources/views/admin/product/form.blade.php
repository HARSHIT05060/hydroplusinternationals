@extends('admin.layouts.app')
<style>
    .error {
        color: red;
        margin-top: 10px;
    }
</style>

@section('content')
    <div class="container mt-5">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($product))
                <input type="hidden" name="id" value="{{ $product->id }}">
            @endif

            <div class="card">
                <div class="card-body">
                        <h4 class="card-title">
                            {{ isset($product) && $product->id ? 'Edit Product' : 'Add Product' }}
                        </h4>

                    {{-- Title --}}
                    <div class="row">
                        <div class="col-10">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $product->title ?? '') }}" placeholder="title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Best Selling --}}
                        <div class="col-2">
                            <label>Best Selling</label>
                            <select name="best_selling" class="form-control">
                                <option value="1"
                                    {{ old('best_selling', $product->best_selling ?? '') == 1 ? 'selected' : '' }}>Yes
                                </option>
                                <option value="0"
                                    {{ old('best_selling', $product->best_selling ?? '') == 0 ? 'selected' : '' }}>No
                                </option>
                            </select>
                            @error('best_selling')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Images --}}
                    <div class="row mt-3">
                        @php $img_labels = ['img_1', 'img_2', 'img_3', 'img_4', 'img_5']; @endphp
                        @foreach ($img_labels as $label)
                            <div class="col-md-4 mt-2">
                                <label>{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
                                <input type="file" name="{{ $label }}" class="form-control">
                                @if (isset($product) && $product->$label)
                                    <img src="{{ asset($product->$label) }}"  class="mt-2">
                                @endif
                                @error($label)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                    </div>

                    {{-- Categories and Subcategories --}}
                    <div class="row mt-3">
                        @php
                            $categoryFields = [1, 2, 3, 4, 5];
                        @endphp
                        @foreach ($categoryFields as $i)
                            <div class="col-md-6 mt-2">
                                <label>Category {{ $i }}</label>
                                <select name="category_{{ $i }}_id" class="form-control">
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old("category_{$i}_id", $product->{"category_{$i}_id"} ?? '') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error("category_{$i}_id")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mt-2">
                                <label>Subcategory {{ $i }}</label>
                                <select name="subcategory_{{ $i }}_id" class="form-control">
                                    <option value="">-- Select Subcategory --</option>
                                    @foreach ($subcategories as $sub)
                                        <option value="{{ $sub->id }}"
                                            {{ old("subcategory_{$i}_id", $product->{"subcategory_{$i}_id"} ?? '') == $sub->id ? 'selected' : '' }}>
                                            {{ $sub->name }}</option>
                                    @endforeach
                                </select>
                                @error("subcategory_{$i}_id")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endforeach
                    </div>

                    {{-- Features --}}
                    <div class="mt-3">
                        <label>Features</label>
                        <textarea name="features" class="form-control" rows="3" placeholder="features">{{ old('features', $product->features ?? '') }}</textarea>
                        @error('features')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Specification --}}
                    <div class="mt-3">
                        <label>Specification</label>
                        <textarea name="specification" class="form-control" rows="3" placeholder="specification">{{ old('specification', $product->specification ?? '') }}</textarea>
                        @error('specification')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mt-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="description">{{ old('description', $product->description ?? '') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary mt-4">
                        {{ isset($product) ? 'Update Product' : 'Add Product' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
@endsection
