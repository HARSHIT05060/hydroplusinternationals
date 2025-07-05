@extends('admin.layouts.app')
@section('content')
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <style>
        .profile_preview_img {
            width: 100px !important;
            height: 100px !important;
            object-fit: cover !important;
            border: 1px solid lightgray !important;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            @if ($user != '')
                                Update
                            @else
                                Add
                            @endif User Details
                        </h4>
                        <form class="forms-sample" action="{{ route('users.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id"
                                @if ($user != '') value="{{ $user->id }}" @endif>
                            <div class="form-group">
                                <label for="name" class="mb-2">Name</label>
                                <input type="text" name="name" class="form-control mb-2" placeholder="Enter name"
                                    @if ($user != '') value="{{ $user->name }}" @else {{ old('name') }} @endif>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="email" class="mb-2">Email</label>
                                <input type="email" name="email" class="form-control mb-2" placeholder="Enter email"
                                    value="{{ old('email', $user->email ?? '') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="mobile_number" class="mb-2">Phone</label>
                                <input type="text" name="mobile_number" class="form-control mb-2"
                                    placeholder="Enter phone" value="{{ old('mobile_number', $user->mobile_number ?? '') }}"
                                    maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10)">
                                @error('mobile_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror


                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

    {{-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script> --}}
    <script>
        function countrySelect() {
            var country_id = document.getElementById('country_id').value;
            $.ajax({
                url: window.location.href,
                type: "GET",
                data: {
                    'country_id': country_id
                },
                success: function(data) {
                    var stateData = data.country_data;
                    var state_html = '<option value="">-- Select State --</option>';
                    if (stateData.length != 0) {
                        for (let i = 0; i < stateData.length; i++) {
                            state_html += '<option value="' + stateData[i]['id'] + '">' + stateData[i][
                                'state_name'
                            ] + '</option>';
                        }
                    }
                    document.getElementById('state').innerHTML = state_html;
                }
            });
        }

        function citySelect() {
            var state = document.getElementById('state').value;
            $.ajax({
                url: window.location.href,
                type: "GET",
                data: {
                    'state': state
                },
                success: function(data) {
                    console.log(data);

                    var cityData = data.city_data || [];
                    var state_html = '<option value="">-- Select City --</option>';

                    if (cityData.length !== 0) {
                        for (let i = 0; i < cityData.length; i++) {
                            state_html += '<option value="' + cityData[i]['id'] + '">' + cityData[i][
                                'citi_name'
                            ] + '</option>';
                        }
                    }
                    document.getElementById('city').innerHTML = state_html;

                }
            });
        }

        function image_select() {
            document.getElementById('img').click();
        }

        $(document).ready(function() {
            $('#img').change(function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_select2').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    // $('#imgPreview').hide();
                }
            });
        });
    </script>
@endsection
