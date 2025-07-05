@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <div class="card mt-5">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Blogs List</h4>
                    <a href="{{ route('blog.createUpdate') }}" class="btn btn-primary">Add Blog</a>
                </div>



                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Event Date</th>
                                <th>Banner Image</th>
                                <th>Image</th>
                                <th>Video</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogs as $key => $blog)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $blog->event_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($blog->event_date)->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($blog->img)
                                            <img src="{{ URL($blog->banner_img) }}" width="80">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($blog->img)
                                            <img src="{{ URL($blog->img) }}" width="80">
                                        @else
                                            N/A
                                        @endif
                                    </td>


                                    <td>
                                        @if ($blog->video)
                                            <video width="120" controls>
                                                <source src="{{ asset('storage/' . $blog->video) }}">
                                            </video>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('blog.createUpdate', $blog->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{ route('blog.delete', $blog->id) }}"
                                            class="btn btn-sm btn-danger">Delete</a>

                                        {{-- Delete Option (optional, implement as needed) --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No blogs found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
