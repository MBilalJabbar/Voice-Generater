@extends('admin.layouts.app')

@section('title')
    Admin - Profile Settings
@endsection

@section('body')
    <!--
        Layout updated to serve as a User Profile/Settings page,
        matching the exact aesthetic, two-column grid, field heights (45px),
        and centered profile image/role setup from the reference image.
    -->
    <div class="container-fluid mt-5 mb-5">
        <div class="row ">
            <!-- Central Card for Settings Form -->
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm" style="border-radius: 15px; border: 2px solid rgba(231, 234, 233, 1);">
                    <div class="card-body p-4 p-md-5">
                        <!-- Profile Picture and Role Section (Centered) -->
                        <div class="text-center">
                            <!-- Placeholder for Profile Image - Mimics the centered circular image -->
                            <img src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('assets/images/profile.png') }}" alt="Profile Image"
                                 class="rounded-circle mb-3 border border-light shadow-sm"
                                 style="width: 100px; height: 100px; object-fit: cover;">
                            <!-- Role Text -->
                            <p class="mb-0 font-weight-bold" style="color: #555;">Role: User</p>
                            <!-- Optional: Button to change image -->
                            {{-- <small class="text-primary cursor-pointer" style="cursor: pointer;">Change Photo</small> --}}
                        </div>

                        <form action="/UpdateSetting" method="POST" enctype="multipart/form-data">
                            @csrf

                             <div class="mb-3">
                <input type="file" name="profile_picture" class="form-control mt-2" accept="image/*">
            </div>
                            <!-- Row 1: Full Name and Username -->
                            <div class="row mb-4">
                                <!-- Full Name (Left Column) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullName" class="text-muted small">Full Name</label>
                                        <input type="text" value="{{ Auth::user()->full_name }}" class="form-control" id="fullName" name="full_name"
                                            placeholder="Enter Full Name" required
                                            style="border-radius: 8px; height: 45px; border: 1px solid #ced4da;">
                                    </div>
                                </div>

                                <!-- Username (Right Column) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username" class="text-muted small">Username</label>
                                        <input type="text" value="{{ Auth::user()->user_name }}" class="form-control" id="username" name="user_name"
                                            placeholder="Enter Username" required
                                            style="border-radius: 8px; height: 45px; border: 1px solid #ced4da;">
                                    </div>
                                </div>
                            </div>

                            <!-- Row 2: WhatsApp Number and Email -->
                            <div class="row mb-4">
                                <!-- WhatsApp Number (Left Column) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="whatsapp" class="text-muted small">WhatsApp Number</label>
                                        <input type="tel" value="{{ Auth::user()->phone }}" class="form-control" id="whatsapp" name="phone"
                                            placeholder="Enter WhatsApp Number"
                                            style="border-radius: 8px; height: 45px; border: 1px solid #ced4da;">
                                    </div>
                                </div>

                                <!-- Email (Right Column) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="text-muted small">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ Auth::user()->email }}" required
                                            style="border-radius: 8px; height: 45px; border: 1px solid #ced4da;">
                                    </div>
                                </div>
                            </div>

                            <!-- Row 3: New Password and Confirm Password -->
                            <div class="row mb-4">
                                <!-- New Password (Left Column) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newPassword" class="text-muted small">New Password</label>
                                        <input type="password" class="form-control" id="newPassword" name="password"
                                            placeholder="********"
                                            style="border-radius: 8px; height: 45px; border: 1px solid #ced4da;">
                                    </div>
                                </div>

                                <!-- Confirm Password (Right Column) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirmPassword" class="text-muted small">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation"
                                            placeholder="********"
                                            style="border-radius: 8px; height: 45px; border: 1px solid #ced4da;">
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button (Dark Blue and Right Aligned) -->
                            <div class="row mt-5">
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn text-white shadow-sm mr-3"
                                        style="background-color: #0D47A1; border-radius: 28px; padding: 15px; font-weight: 600; border: none;">
                                        Update Profile
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
