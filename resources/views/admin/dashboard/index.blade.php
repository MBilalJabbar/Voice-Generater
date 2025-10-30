@extends('admin.layouts.app')

@section('title')
    Dashboard
@endsection

@section('body')
    <div class="container-fluid mt-4">
        <div class="row g-4">
            <!-- Total Users -->
            <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="card custom-card shadow-sm"
                    style="background:#003E78; color:#fff; border-radius:25px;
                        padding:42px;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="text-white mb-2" style="font-weight: 200">Total Users</h5>
                        <h3 class="text-white r">{{ $userCount }}</h3>
                    </div>
                </div>
            </div>

            <!-- Free Plan -->
            <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="card custom-card shadow-sm"
                    style="background:#003E78; color:#fff; border-radius:25px;
                        padding:42px;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="text-white mb-2" style="font-weight: 200">Free Plan</h5>
                        <h3 class="text-white r">3,671</h3>
                    </div>
                </div>
            </div>

            <!-- Paid Plan -->
            <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="card custom-card shadow-sm"
                    style="background:#003E78; color:#fff; border-radius:25px;
                        padding:42px;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="text-white mb-2" style="font-weight: 200">Paid Plan</h5>
                        <h3 class="text-white r">156</h3>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="card custom-card shadow-sm"
                    style="background:#003E78; color:#fff; border-radius:25px;
                        padding:42px;">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <h5 class="text-white mb-2" style="font-weight: 200">Total Revenue</h5>
                        <h3 class="text-white r">156</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">asd</div>
            <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="card custom-card shadow-sm p-4" style="height: 400px; overflow: auto;">
                    <h3 style="font-size: 20px">New Users</h3>
                    @foreach ($users as $user)
                    <div class="d-flex align-items-center gap-3 mt-4">

                            <div><img src="{{ $user->profile_picture ? asset($user->profile_picture)  :  asset('assets/images/profile.png') }}" alt="" width="50px" class="rounded-circle"></div>


                        <div>
                            <h5>{{ $user->user_name }}({{$user->user_role}})</h5>
                        </div>

                    </div>
                     @endforeach
                    {{-- <div class="d-flex align-items-center gap-3 mt-4">
                        <div><img src="{{ asset('assets/images/profile.png') }}" alt="" width="50px"></div>
                        <div>
                            <h5>Natil Guyawa</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div><img src="{{ asset('assets/images/profile.png') }}" alt="" width="50px"></div>
                        <div>
                            <h5>Natil Guyawa</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div><img src="{{ asset('assets/images/profile.png') }}" alt="" width="50px"></div>
                        <div>
                            <h5>Natil Guyawa</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div><img src="{{ asset('assets/images/profile.png') }}" alt="" width="50px"></div>
                        <div>
                            <h5>Natil Guyawa</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div><img src="{{ asset('assets/images/profile.png') }}" alt="" width="50px"></div>
                        <div>
                            <h5>Natil Guyawa</h5>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
