@extends('admin.layouts.app')

@section('title')
    Item Index
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-white shadow p-4">
                    <form action="/CreateUserAdmin" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
                                <label for="name" class="form-label">Profile Image</label>
                                <input type="file" name="profileImage" class="form-control" placeholder="Enter name"
                                    value="{{ old('profileImage') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="full_name" class="form-control" placeholder="Enter Full Name"
                                    value="{{ old('full_name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="name" class="form-label">User Name</label>
                                <input type="text" name="user_name" class="form-control" placeholder="Enter User Name"
                                    value="{{ old('user_name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 col-6">
                                <label for="email" class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-control" placeholder="Enter Phone Number"
                                    value="{{ old('phone') }}" required>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password"
                                    required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-6">
                                <label for="user_type" class="form-label">User Type</label>
                                <select name="user_role" class="form-select" required>
                                    <option value="">-- Select User Type --</option>
                                    <option value="admin" {{ old('user_role') == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="manager" {{ old('user_role') == 'manager' ? 'selected' : '' }}>Manager
                                    </option>
                                    <option value="user" {{ old('user_role') == 'user' ? 'selected' : '' }}>User
                                    </option>
                                </select>
                                @error('user_role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@endsection
