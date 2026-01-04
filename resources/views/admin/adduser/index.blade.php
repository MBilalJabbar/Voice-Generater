@extends('admin.layouts.app')

@section('title')
    Speechly Studio - Add User
@endsection

@section('body')
    <div class="container-fluid">
        <!-- PAGE HEADER AND ADD BUTTON -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb add-user-mobile">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Index</li>
                </ol>
            </nav>
            <a href="/CreateUserAdminPage" class="btn btn-primary btn-sm">
                Add User
            </a>
        </div>

        <!-- USER TABLE -->
        <div class="col-xl-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 style="font-size: 20px;font-weight:800">Users</h6>
                </div>
                <!-- TABLE DATA -->
                <div class="card-body">
    <div class="table-responsive">
        <table id="example" class="table table-hover text-nowrap" style="background: #003E78;">
            <thead>
                <tr>
                    <th style="background: #003E78; color:white">Sr #</th>
                    <th style="background: #003E78; color:white">Image</th>
                    <th style="background: #003E78; color:white">Name</th>
                    <th style="background: #003E78; color:white">Email</th>
                    <th style="background: #003E78; color:white">Phone Number</th>
                    <th style="background: #003E78; color:white">Plan</th>
                    <th style="background: #003E78; color:white">Plan Expire Date</th>
                    <th style="background: #003E78; color:white">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)


                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('assets/images/profile.png') }}" width="40" class="rounded-circle border"></td>
                    <td>{{ $user->user_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->plan_name ?? 'No Plan Buy' }}</td>
                    <td>
    @php
        $latestCredit = $user->creditHistories->sortByDesc('created_at')->first();
        $expiry = $latestCredit ? \Carbon\Carbon::parse($latestCredit->expiry_date) : null;

        $daysRemaining = 0;
        if ($expiry) {
            $daysRemaining = now()->startOfDay()->diffInDays($expiry->startOfDay(), false);
            if ($daysRemaining < 0) $daysRemaining = 0;
        }
    @endphp

    {{ $daysRemaining }} days
</td>

                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm viewUser" data-bs-toggle="modal" data-bs-target="#taskModal"
                                            data-id="{{ $user->user_id }}"
                                                title="View Task" style="background: transparent; border: none;">
                                                <i class="fa-regular fa-eye" style="color: #003E78; font-size: 18px;"></i>
                                            </button>
                            <a href="{{ route('editUserAdmin',$user->user_id) }}" class="btn btn-light btn-sm rounded-circle border" title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                            <!-- Delete Button -->
<button type="button"
        class="btn btn-light btn-sm rounded-circle border delete-btn"
        data-id="{{ $user->user_id }}"
        title="Delete">
    <i class="fa fa-trash text-danger"></i>
</button>

<!-- Hidden Delete Form -->
<form id="delete-form-{{ $user->user_id }}"
      action="{{ route('deleteUserAdmin', $user->user_id) }}"
      method="POST"
      style="display: none;">
    @csrf
    @method('DELETE')
</form>


                        </div>
                    </td>
                </tr>
                 @endforeach
                {{-- <tr>
                    <td>2</td>
                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40" class="rounded-circle border"></td>
                    <td>Sara Ahmed</td>
                    <td>sara@example.com</td>
                    <td>0312-7654321</td>
                    <td>Free</td>
                    <td>18 days</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="View"><i class="fa fa-eye text-primary"></i></a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i class="fa fa-trash text-danger"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40" class="rounded-circle border"></td>
                    <td>Bilal Iqbal</td>
                    <td>bilal@example.com</td>
                    <td>0333-4445556</td>
                    <td>Standard</td>
                    <td>12 days</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="View"><i class="fa fa-eye text-primary"></i></a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i class="fa fa-trash text-danger"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40" class="rounded-circle border"></td>
                    <td>Hira Fatima</td>
                    <td>hira@example.com</td>
                    <td>0345-2233445</td>
                    <td>Premium</td>
                    <td>20 days</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="View"><i class="fa fa-eye text-primary"></i></a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i class="fa fa-trash text-danger"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40" class="rounded-circle border"></td>
                    <td>Usman Riaz</td>
                    <td>usman@example.com</td>
                    <td>0301-9876543</td>
                    <td>Basic</td>
                    <td>14 days</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="View"><i class="fa fa-eye text-primary"></i></a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i class="fa fa-trash text-danger"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40" class="rounded-circle border"></td>
                    <td>Ayesha Noor</td>
                    <td>ayesha@example.com</td>
                    <td>0321-3344556</td>
                    <td>Free</td>
                    <td>9 days</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="View"><i class="fa fa-eye text-primary"></i></a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i class="fa fa-trash text-danger"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40" class="rounded-circle border"></td>
                    <td>Hamza Malik</td>
                    <td>hamza@example.com</td>
                    <td>0344-5566778</td>
                    <td>Standard</td>
                    <td>15 days</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="View"><i class="fa fa-eye text-primary"></i></a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i class="fa fa-trash text-danger"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40" class="rounded-circle border"></td>
                    <td>Zainab Tariq</td>
                    <td>zainab@example.com</td>
                    <td>0331-1122334</td>
                    <td>Basic</td>
                    <td>7 days</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="View"><i class="fa fa-eye text-primary"></i></a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i class="fa fa-trash text-danger"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40" class="rounded-circle border"></td>
                    <td>Ahmad Saeed</td>
                    <td>ahmad@example.com</td>
                    <td>0305-6677889</td>
                    <td>Premium</td>
                    <td>10 days</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="View"><i class="fa fa-eye text-primary"></i></a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle border" title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i class="fa fa-trash text-danger"></i></button>
                        </div>
                    </td>
                </tr> --}}
            </tbody>
        </table>
    </div>
</div>


            </div>
        </div>
    </div>


    {{-- View Modal Data --}}
    {{-- <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 50vw; height: 30vh;">
        <div class="modal-content border-0 shadow-sm rounded-3" style="height: 80%;">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close btn-close-white btn-lg" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card border-0 p-4 rounded-3">
                    <h6 class="fw-bold text-primary mb-3" style="color: #003E78 !important;">User Information</h6>
                    <div class="text-center">
                        <img id="modalImage" src="{{ asset('assets/images/profile.png') }}" alt="Profile Image"
                            class="rounded-circle mb-3 border border-light shadow-sm"
                            style="width: 100px; height: 100px; object-fit: cover;">
                        <p class="mb-0 font-weight-bold" id="modalRole" style="color: #555;">Role: N/A</p>
                    </div>

                    <div class="container d-flex justify-content-end">

                        <div class="row my-4 " style="width: 80%">
                            <div class="col-md-6 small">
                                <h6 style="color:#47739E;">Name</h6>
                                <h6 style="color:#47739E;">Email</h6>
                                <h6 style="color:#47739E;">Phone</h6>

                            </div>
                            <div class="col-md-6 small">
                                <h6 id="modalName"></h6>
                                <h6 id="modalEmail"></h6>
                                <h6 id="modalPhone"></h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- View Modal Data --}}
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down modal-lg">
        <div class="modal-content border-0 shadow rounded-4">

            {{-- Header --}}
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body p-4">
                <div class="card border-0 rounded-4">

                    <h6 class="fw-bold text-primary mb-4 text-center text-md-center">
                        User Information
                    </h6>

                    <div class="row align-items-center">

                        {{-- Profile --}}
                        <div class="col-12 col-md-4 text-center mb-4 mb-md-0">
                            <img id="modalImage"
                                src="{{ asset('assets/images/profile.png') }}"
                                alt="Profile Image"
                                class="rounded-circle border shadow-sm mb-2"
                                style="width: 110px; height: 110px; object-fit: cover;">

                            <p class="mb-0 fw-semibold text-muted" id="modalRole">
                                Role: N/A
                            </p>
                        </div>

                        {{-- User Info --}}
                        <div class="col-12 col-md-8">
                            <div class="row g-3 small">

                                <div class="col-5 text-muted fw-semibold">
                                    Name
                                </div>
                                <div class="col-7" id="modalName"></div>

                                <div class="col-5 text-muted fw-semibold">
                                    Email
                                </div>
                                <div class="col-7" id="modalEmail"></div>

                                <div class="col-5 text-muted fw-semibold">
                                    Phone
                                </div>
                                <div class="col-7" id="modalPhone"></div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
    $('.viewUser').on('click', function() {
        let id = $(this).data('id');
        console.log("Clicked user ID:", id);
        // Reset modal fields while loading
        $('#modalName, #modalEmail, #modalPhone, #modalRole').text('Loading...');
        $('#modalImage').attr('src', '/assets/images/profile.png');

        $.ajax({
            url: `/ShowUserAdminDetails/${id}`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    let user = response.data;

                    // ✅ Update modal fields
                    $('#modalName').text(user.user_name ?? 'N/A');
                    $('#modalEmail').text(user.email ?? 'N/A');
                    $('#modalPhone').text(user.phone ?? 'N/A');
                    $('#modalRole').text('Role: ' + (user.user_role ?? 'N/A'));

                    // ✅ Set profile image dynamically
                    let imagePath = user.profile_picture
                        ? `/${user.profile_picture}`
                        : '/assets/images/profile.png';
                    $('#modalImage').attr('src', imagePath);

                    // ✅ Show modal after loading data
                    $('#taskModal').modal('show');
                } else {
                    alert('User not found.');
                }
            },
            error: function() {
                alert('Error fetching user details.');
            }
        });
    });
});

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        });
    });
});


</script>

@if(session('success'))
<script>
Swal.fire({
  icon: 'success',
  title: 'Deleted!',
  text: '{{ session('success') }}',
  showConfirmButton: false,
  timer: 2000
});

</script>
@endif

@endsection
