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
                            {{ isset($blogs) && $blogs->id ? 'Edit Blog' : 'Add Blog' }}
                        </h4>
                        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $blogs->id ?? '' }}">

                            <div class="form-group">
                                <label>Event Name</label>
                                <input type="text" name="event_name"
                                    value="{{ old('event_name', $blogs->event_name ?? '') }}" class="form-control">
                                @error('event_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Event Date</label>
                                <input type="date" name="event_date"
                                    value="{{ old('event_date', $blogs->event_date ?? '') }}" class="form-control">
                                @error('event_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Banner Image</label>
                                <input type="file" name="banner_img" class="form-control">
                                @if (!empty($blogs->banner_img))
                                    <img src="{{ asset('storage/' . $blogs->banner_img) }}" width="100" class="mt-2">
                                @endif
                                @error('banner_img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Video</label>
                                <input type="file" name="video" class="form-control">
                                @if (!empty($blogs->video))
                                    <video width="200" controls class="mt-2">
                                        <source src="{{ asset('storage/' . $blogs->video) }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                                @error('video')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="img" class="form-control">
                                @if (!empty($blogs->img))
                                    <img src="{{ asset('storage/' . $blogs->img) }}" width="100" class="mt-2">
                                @endif
                                                                @error('img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <button type="submit" class="btn btn-primary mt-3">
                                {{ isset($blogs) ? 'Update' : 'Create' }} Blog
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
