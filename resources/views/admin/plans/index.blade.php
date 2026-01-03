@extends('admin.layouts.app')

@section('title')
    Plans Index
@endsection

@section('body')
    <div class="container-fluid">
        <!-- PAGE HEADER AND ADD BUTTON -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb admin-plans-mobile">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Plans Index</li>
                </ol>
            </nav>
            <a href="{{ route('admin.plans.create') }}" class="btn btn-primary btn-sm">
                Plans
            </a>
        </div>

        <!-- USER TABLE -->
        <div class="col-xl-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 style="font-size: 20px;font-weight:800">Plans Create</h6>
                </div>
                <!-- TABLE DATA -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover text-nowrap" style="background: #003E78;">
                            <thead>
                                <tr>
                                    <th style="background: #003E78; color:white">Sr #</th>
                                    <th style="background: #003E78; color:white">Plan Name</th>
                                    <th style="background: #003E78; color:white">Credit</th>
                                    <th style="background: #003E78; color:white">Duration</th>
                                    <th style="background: #003E78; color:white">Expiry</th>
                                    <th style="background: #003E78; color:white">Price</th>
                                    <th style="background: #003E78; color:white">Minuts Limit</th>
                                    <th style="background: #003E78; color:white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Placeholder for 8 dummy records. In a real application, this data is passed from the controller. --}}

                                @foreach ($plans as $userPlans)
                                    <tr class="@if ($loop->odd) bg-light @else bg-white @endif">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $userPlans->name }}</td>
                                        <td>{{ $userPlans->characters }}</td>
                                        <td>{{ $userPlans->duration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($userPlans->expires)->format('d M Y, h:i A') }}</td>

                                        <td>{{ $userPlans->price }}{{ $userPlans->currency }}</td>
                                        <td>{{ $userPlans->minutes}}</td>
                                        <td>
                                            <a href="{{ url('editPlans/' . $userPlans->id) }}" class="btn btn-light btn-sm rounded-circle border"
                                                title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                                            <button class="btn btn-light btn-sm rounded-circle border deletePlan" title="Delete" data-id="{{ $userPlans->id }}"><i
                                                    class="fa fa-trash text-danger"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('.deletePlan').on('click', function() {
            let id = $(this).data('id');
            let button = $(this);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/deletedPlans/' + id,  // 👈 make sure your route matches this
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'  // required for Laravel
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                response.message || 'Plan has been deleted.',
                                'success'
                            );
                            button.closest('tr').fadeOut(500, function() {
                                $(this).remove();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong while deleting.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>

@endsection
