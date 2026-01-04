@extends('layouts.app')

@section('title')
   Speechly Studio - Profile
@endsection

@section('body')
    <style>
        /* Custom Styles for Profile Card */
        .profile-section-title {
            color: rgba(0, 62, 120, 1);
            font-weight: bold;
            margin-bottom: 25px;
            font-size: 1.5rem;
        }

        .profile-img-container {
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid #e7eae9;
            margin-bottom: 20px;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff; /* Optional white border for depth */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .profile-detail-row {
            padding: 15px 0;
            border-bottom: 1px dashed #e7eae9;
        }

        .profile-detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 500;
            color: #6c757d; /* Muted gray for labels */
        }

        .detail-value {
            font-weight: bold;
            color: #343a40;
            text-align: right;
        }

        /* Ensure card takes full width of the body section */
        .full-width-card {
            max-width: 100%;
        }
    </style>

    <div class="container-fluid mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-12 full-width-card">
                <div class="card shadow-sm" style="border-radius: 15px; border: 2px solid rgba(231, 234, 233, 1);">
                    <div class="card-body p-4 p-md-5">

                        <h2 class="profile-section-title">Account Information</h2>

                        <div class="row">

                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="profile-img-container">
                                    <img src="{{ Auth::user()->profile_picture ? (asset(Auth::user()->profile_picture)) : (asset('assets/images/pessanger photo.png')) }}" alt="User Photo"
                                        class="profile-img">

                                    <h4 class="mt-2" style="font-weight: bold; color: rgba(0,62,120,1);">{{ Auth::user()->full_name }}</h4>
                                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">

                                    <div class="col-12 profile-detail-row">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4 detail-label">Email</div>
                                            <div class="col-sm-8 detail-value">{{ Auth::user()->email }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12 profile-detail-row">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4 detail-label">Mobile</div>
                                            <div class="col-sm-8 detail-value">{{ Auth::user()->phone }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12 profile-detail-row">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4 detail-label">Date of Birth</div>
                                            <div class="col-sm-8 detail-value">{{ \Carbon\Carbon::parse(Auth::user()->dob)->format('d M, Y') }}</div>

                                        </div>
                                    </div>

                                    {{-- <div class="col-12 profile-detail-row">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4 detail-label">Account Type</div>
                                            <div class="col-sm-8 detail-value">
                                                <span class="badge bg-primary text-white p-2">Premium</span>
                                            </div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
