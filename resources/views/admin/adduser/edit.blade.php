@extends('admin.layouts.app')

@section('title')
    Speechly Studio - Edit User
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Item Edit</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-white shadow p-4">
                    <form action="{{ route('updateUserAdmin', $user->user_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Change this to PUT for update --}}

                        <div class="row">
                            <div class="mb-3 col-8">
                                <label for="name" class="form-label">Profile Image</label>
                                <input type="file" name="profileImage" class="form-control" placeholder="Enter name"
                                    value="{{ old('profileImage', $user->profile_image) }}" required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" placeholder="Enter Full Name"
                                    value="{{ old('full_name', $user->full_name) }}" required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="form-label">User Name</label>
                                <input type="text" name="user_name" class="form-control" placeholder="Enter Full Name"
                                    value="{{ old('user_name', $user->user_name) }}" required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" placeholder="Enter Phone Number"
                                    value="{{ old('phone', $user->phone) }}" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>


                            <div class="mb-3 col-6">
                                <label for="password" class="form-label">Password (optional)</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter new password">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="user_role" class="form-label">User Type</label>
                                <select name="user_role" class="form-select" required>
                                    <option value="">-- Select User Type --</option>
                                    <option value="admin"
                                        {{ old('user_role', $user->user_type) == 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                    <option value="manager"
                                        {{ old('user_role', $user->user_type) == 'manager' ? 'selected' : '' }}>
                                        Manager
                                    </option>
                                    <option value="user"
                                        {{ old('user_role', $user->user_type) == 'user' ? 'selected' : '' }}>
                                        User
                                    </option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
