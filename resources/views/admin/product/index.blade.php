@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">
                        {{ isset($product) && $product->id ? 'Edit Product' : 'Add Product' }}
                    </h4>

                    <a href="{{ route('product.createUpdate') }}" class="btn btn-primary">Add Product</a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                    <table class="table table-bordered table-striped ">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Best Selling</th>
                            <th>Images</th>
                            <th>Categories</th>
                            <th>Subcategories</th>
                            <th>Features</th>
                            {{-- <th>Specification</th>
                            <th>Description</th>
                            <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                            <tr>
                                <td>{{ $p->title }}</td>
                                <td>{{ $p->best_selling ? 'Yes' : 'No' }}</td>
                                <td>
                                    @if ($p->img_1)
                                        <img src="{{ URL($p->img_1) }}" width="40">
                                    @endif
                                    @if ($p->img_2)
                                        <img src="{{ URL($p->img_2) }}" width="40">
                                    @endif
                                    @if ($p->img_3)
                                        <img src="{{ URL($p->img_3) }}" width="40">
                                    @endif
                                    @if ($p->img_4)
                                        <img src="{{ URL($p->img_4) }}" width="40">
                                    @endif
                                    @if ($p->img_5)
                                        <img src="{{ URL($p->img_5) }}" width="40">
                                    @endif
                                </td>
                                <td>
                                    {{ optional($p->category_1)->name }}<br>
                                    {{ optional($p->category_2)->name }}<br>
                                    {{ optional($p->category_3)->name }}<br>
                                    {{ optional($p->category_4)->name }}<br>
                                    {{ optional($p->category_5)->name }}
                                </td>
                                <td>
                                    {{ optional($p->subcategory_1)->name }}<br>
                                    {{ optional($p->subcategory_2)->name }}<br>
                                    {{ optional($p->subcategory_3)->name }}<br>
                                    {{ optional($p->subcategory_4)->name }}<br>
                                    {{ optional($p->subcategory_5)->name }}
                                </td>
                                {{-- <td>{{ Str::limit($p->features, 30) }}</td>
                                <td>{{ Str::limit($p->specification, 30) }}</td>
                                <td>{{ Str::limit($p->description, 30) }}</td> --}}
                                <td>
                                    <a href="{{ route('product.createUpdate', $p->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('product.delete', $p->id) }}" class="btn btn-sm btn-danger"
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
