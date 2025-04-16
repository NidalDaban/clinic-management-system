@extends('theme.master')

@section('register-active', 'active')
@section('title', 'Create Your RafiqCare Account')

@section('subtitle')
    <p>Join us and take the first step <br> toward better mental health and well-being.</p>
@endsection

@section('content')
    <div class="container-fluid mt-5" style="margin-bottom: 2rem">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Create an Account</h3>

                        <!-- Nav Tabs -->
                        <ul class="nav nav-pills" id="registration-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="personal-info-tab" data-bs-toggle="pill"
                                    href="#personal-info" role="tab" aria-controls="personal-info"
                                    aria-selected="true">Personal Info</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="health-info-tab" data-bs-toggle="pill" href="#health-info"
                                    role="tab" aria-controls="health-info" aria-selected="false">Health Info</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="user-info-tab" data-bs-toggle="pill" href="#user-info"
                                    role="tab" aria-controls="user-info" aria-selected="false">User Info</a>
                            </li>
                        </ul>

                        <!-- Form -->
                        <form action="{{ route('register.store') }}" method="POST">
                            @csrf

                            <div class="tab-content mt-3" id="registration-tabs-content">
                                <!-- Personal Info -->
                                <div class="tab-pane fade show active" id="personal-info" role="tabpanel"
                                    aria-labelledby="personal-info-tab">
                                    <h5 class="mb-3">Personal Information</h5>

                                    <div class="row">
                                        @foreach (['first', 'second', 'middle', 'last'] as $position)
                                            <div class="col-md-3 mb-3">
                                                <label for="{{ $position }}_name"
                                                    class="form-label">{{ ucfirst($position) }} Name</label>
                                                <input type="text" class="form-control" id="{{ $position }}_name"
                                                    name="{{ $position }}_name"
                                                    placeholder="{{ ucfirst($position) }} name"
                                                    value="{{ old($position . '_name') }}">
                                                @if ($errors->has($position . '_name'))
                                                    <ul class="text-danger mt-2">
                                                        @foreach ($errors->get($position . '_name') as $message)
                                                            <li>{{ $message }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select
                                                Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                            </option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <ul class="text-danger mt-2">
                                                @foreach ($errors->get('gender') as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}">
                                        @if ($errors->has('dob'))
                                            <ul class="text-danger mt-2">
                                                @foreach ($errors->get('dob') as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Marital Status</label><br>
                                        @foreach (['married', 'single'] as $status)
                                            <input type="radio" name="marital_status" value="{{ $status }}"
                                                id="{{ $status }}"
                                                {{ old('marital_status') == $status ? 'checked' : '' }}>
                                            <label for="{{ $status }}">{{ ucfirst($status) }}</label>
                                        @endforeach
                                        @if ($errors->has('marital_status'))
                                            <ul class="text-danger mt-2">
                                                @foreach ($errors->get('marital_status') as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>

                                <!-- Health Info -->
                                <div class="tab-pane fade" id="health-info" role="tabpanel"
                                    aria-labelledby="health-info-tab">
                                    <h5 class="mb-3">Health Information</h5>

                                    <div class="mb-3">
                                        <label for="job_title" class="form-label">Job Title</label>
                                        <input type="text" class="form-control" id="job_title" name="job_title"
                                            value="{{ old('job_title') }}" placeholder="Job title">
                                        @if ($errors->has('job_title'))
                                            <ul class="text-danger mt-2">
                                                @foreach ($errors->get('job_title') as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone') }}" placeholder="Phone number" maxlength="15">
                                        @if ($errors->has('phone'))
                                            <ul class="text-danger mt-2">
                                                @foreach ($errors->get('phone') as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <select class="form-control" id="country" name="country_id">
                                            <option value="" disabled {{ old('country_id') ? '' : 'selected' }}>
                                                Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country_id'))
                                            <ul class="text-danger mt-2">
                                                @foreach ($errors->get('country_id') as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="chronic_disease" class="form-label">Do you have any chronic
                                            diseases?</label><br>
                                        <input type="checkbox" name="chronic_disease" id="chronic_disease"
                                            value="yes" {{ old('chronic_disease') == 'yes' ? 'checked' : '' }}>
                                        <label for="chronic_disease">Yes</label>
                                        @if ($errors->has('chronic_disease'))
                                            <ul class="text-danger mt-2">
                                                @foreach ($errors->get('chronic_disease') as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="mb-3" id="chronic_disease_detail"
                                        style="display: {{ old('chronic_disease') == 'yes' ? 'block' : 'none' }};">
                                        <label for="chronic_disease_detail_input" class="form-label">Please
                                            specify:</label>
                                        <input type="text" class="form-control" id="chronic_disease_detail_input"
                                            name="chronic_disease_detail" value="{{ old('chronic_disease_detail') }}"
                                            placeholder="Enter chronic disease"
                                            {{ old('chronic_disease') == 'yes' ? ' ' : '' }}>
                                        @if ($errors->has('chronic_disease_detail'))
                                            <ul class="text-danger mt-2">
                                                @foreach ($errors->get('chronic_disease_detail') as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>

                                <!-- User Info -->
                                <div class="tab-pane fade" id="user-info" role="tabpanel"
                                    aria-labelledby="user-info-tab">
                                    <h5 class="mb-3">User Account Information</h5>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" placeholder="Email">
                                        @if ($errors->has('email'))
                                            <ul class="text-danger mt-2">
                                                @foreach ($errors->get('email') as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password">
                                        @if ($errors->has('password'))
                                            <ul class="text-danger mt-2">
                                                @foreach ($errors->get('password') as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Confirm Password">
                                    </div>

                                    <!-- Register button ONLY in final tab -->
                                    <div class="d-grid mt-4">
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <small>Already have an account? <a href="{{ route('login') }}">Login</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
