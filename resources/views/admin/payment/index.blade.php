@extends('admin.layouts.app')

@section('title')
    Payment Proof
@endsection

@section('body')
    <div class="container-fluid">
        <!-- PAGE HEADER AND ADD BUTTON -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment Proof</li>
                </ol>
            </nav>
        </div>

        <!-- PAYMENT PROOF TABLE -->
        <div class="col-xl-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 style="font-size: 20px;font-weight:800">Payment Proofs</h6>
                </div>

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
                                    <th style="background: #003E78; color:white">Plan Day Remaining</th>
                                    <th style="background: #003E78; color:white">Status</th>
                                    {{-- <th style="background: #003E78; color:white">Payment Proof</th> --}}
                                    <th style="background: #003E78; color:white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentProofs as $paymentProof)

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('assets/images/profile.png') }}" width="40"
                                                class="rounded-circle border"></td>
                                        <td>{{ $paymentProof->user->user_name }}</td>
                                        <td>{{ $paymentProof->user->email }}</td>
                                        <td>{{ $paymentProof->user->phone }}</td>
                                        <td>{{ $paymentProof->plan->name }}</td>

                                        <td>
@php
    $latestCredit = $paymentProof->latestCredit;
    $statusText = '';
    $daysRemaining = 0;

    if ($paymentProof->status === 'pending') {
        $statusText = 'Subscription Not Approved';
    }
    elseif ($paymentProof->status === 'approved') {
        if ($latestCredit && $latestCredit->expiry_date) {
            $expiry = \Carbon\Carbon::parse($latestCredit->expiry_date);
            $daysRemaining = now()->startOfDay()->diffInDays($expiry->startOfDay(), false);

            if ($daysRemaining <= 0) {
                $statusText = 'Expired';
                $paymentProof->status = 'expired';
                $paymentProof->save();
            } else {
                $statusText = $daysRemaining . ' days remaining';
            }
        } else {
            $statusText = 'No Plan Found';
        }
    }
    elseif ($paymentProof->status === 'expired') {
        $statusText = 'Expired';
    }
@endphp

@if($statusText === 'Expired')
    <span class="text-danger">{{ $statusText }}</span>
@elseif($statusText === 'Subscription Not Approved')
    <span class="text-warning">{{ $statusText }}</span>
@else
    <span class="text-success">{{ $statusText }}</span>
@endif
</td>


                                        <td>
                                            @if ($paymentProof->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($paymentProof->status == 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @else
                                                <span class="badge bg-danger">Expired</span>
                                            @endif
                                        </td>
                                        {{-- <td><img src="assets/images/payment-proof.png" width="50" class="border rounded">
                                    </td> --}}
                                        <td>
                                            <div class="d-flex gap-1">
                                                {{-- <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a> --}}
                                                <button data-bs-toggle="modal"
                                                        data-id="{{ $paymentProof->id }}"
                                                        data-bs-target="#taskModal"
                                                        class="btn btn-light btn-sm rounded-circle border viewPlan"
                                                        title="View">
                                                    <i class="fa fa-eye text-primary"></i>
                                                </button>

                                                <button class="btn btn-light btn-sm rounded-circle border deletePlan" data-id="{{ $paymentProof->id }}"  title="Delete">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- Continue same pattern for other rows -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 50vw;">
            <div class="modal-content border-0 shadow-sm rounded-3" style="height: 80%;">
                <!-- Header -->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark px-3" id="taskModalLabel">Plan Details</h5>
                    <button type="button" class="btn-close btn-close-white btn-lg" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <div class="card border-0 p-4 rounded-3">
                        <!-- Task Information -->
                        <h6 class="fw-bold text-primary mb-3" style="color: #003E78 !important;">Plan Information</h6>
                        <form id="subscriptionForm" method="POST">
                            @csrf
                            <div class="my-4">
                                <label for="status" style="color:#47739E;">Status</label>
                                <select name="status" id="status" style="padding: 8px;">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="expired">Expired</option>
                                </select>
                            </div>
                            <div class="col-md-12 small">
                                <button type="button" id="saveStatus" class="btn float-end" style="background: #47739E; color: #fff; padding: 10px 24px; border-radius: 8px;">Save</button>
                            </div>
                        </form>

                        <div class="row mb-4">
                            <div class="col-md-6 small">
                                <p><strong style="color:#47739E;">Status:</strong><br> <span id="modalStatus"></span></p>

                            </div>
                            <div class="col-md-6 small">
                                <p>
                                    <strong style="color:#47739E;">Name:</strong><br>
                                    <span id="modalName"></span>
                                </p>
                            </div>
                            <div class="col-md-6 small">
                                <p><strong style="color:#47739E;">Email:</strong><br><span id="modalEmail"></span></p>
                            </div>
                            <div class="col-md-6 small">
                                <p><strong style="color:#47739E;">Phone Number:</strong><br> <span id="modalPhone"></span></p>
                            </div>
                            <div class="col-md-6 small">
                                <p><strong style="color:#47739E;">Plan:</strong><br> <span id="modalPlanName"></span>
                                </p>
                            </div>
                            <div class="col-md-6 small">
                                <p><strong style="color:#47739E;">Payment Method:</strong><br> <span id="modalPaymentMethod"></span>
                                </p>
                            </div>
                            <div class="col-md-6 small">
                                <p><strong style="color:#47739E;">Plan Day Remaining:</strong><br> <span id="modalRemaningday"></span>
                                </p>
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
        $('.viewPlan').on('click', function() {
    let id = $(this).data('id');

    $.ajax({
        url: `/fetchPlan/${id}`,
        type: 'GET',
        success: function(response) {
            if (response.success) {
                let s = response.data;

                $('#modalStatus').text(s.status ?? 'N/A');
                $('#modalName').text(s.user.full_name ?? 'N/A');
                $('#modalEmail').text(s.user.email ?? 'N/A');
                $('#modalPhone').text(s.user.phone ?? 'N/A');
                $('#modalPlanName').text(s.plan.name ?? 'N/A');
                $('#modalRemaningday').text(s.days_remaining ?? '0');
                $('#modalCreated').text(s.created_at ?? 'N/A');
                $('#status').val(s.status).data('id', s.id);
                $('#modalPaymentMethod').text(s.payment_method ?? 'N/A');
                $('#subscriptionForm').data('id', s.id);
            }
        }
    });
});

$('#saveStatus').on('click', function() {
    let status = $('#status').val();
    let id = $('#subscriptionForm').data('id'); // subscription ID

    $.ajax({
        url: `{{ url('PlanStatusUpdate') }}/${id}`, // <-- full URL
        type: 'POST',
        data: { status: status, _token: '{{ csrf_token() }}' },
        success: function(res){
            Swal.fire('Updated!', 'Subscription status updated.', 'success');
            $('#taskModal').modal('hide');
            location.reload(); // refresh table
        }
    });
});

$('.deletePlan').on('click', function(){
    let id = $(this).data('id');

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
                url: `{{ url('deleteProofPlan') }}/${id}`,
                type: 'POST',
                data: { _token: '{{ csrf_token() }}' },
                success: function(res){
                    Swal.fire('Deleted!', 'Subscription has been deleted.', 'success');
                    location.reload(); // refresh table
                }
            });
        }
    });
})


    </script>
@endsection
