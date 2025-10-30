@extends('admin.layouts.app')

@section('title')
    Plans Index
@endsection

@section('body')
    <div class="container-fluid">
        <!-- PAGE HEADER AND ADD BUTTON -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
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
                                <?php
                                $userPlans = [
                                    ['plan_name' => 'Basic Monthly', 'credit' => 100, 'duration' => '30 Days', 'expiry' => '2025-11-15', 'price' => '$9.99', 'minutes_limit' => 60, 'id' => 1],
                                    ['plan_name' => 'Standard Quarterly', 'credit' => 500, 'duration' => '90 Days', 'expiry' => '2026-01-20', 'price' => '$29.99', 'minutes_limit' => 300, 'id' => 2],
                                    ['plan_name' => 'Premium Annual', 'credit' => 2000, 'duration' => '365 Days', 'expiry' => '2026-10-17', 'price' => '$99.99', 'minutes_limit' => 1200, 'id' => 3],
                                    ['plan_name' => 'Starter Pack', 'credit' => 50, 'duration' => '7 Days', 'expiry' => '2025-10-24', 'price' => '$4.99', 'minutes_limit' => 30, 'id' => 4],
                                    ['plan_name' => 'Pro Monthly', 'credit' => 800, 'duration' => '30 Days', 'expiry' => '2025-11-10', 'price' => '$49.99', 'minutes_limit' => 480, 'id' => 5],
                                    ['plan_name' => 'Enterprise Custom', 'credit' => 'Unlimited', 'duration' => '365 Days', 'expiry' => 'N/A', 'price' => 'Negotiated', 'minutes_limit' => 'Unlimited', 'id' => 6],
                                    ['plan_name' => 'Trial (Expired)', 'credit' => 10, 'duration' => 'N/A', 'expiry' => '2025-09-01', 'price' => 'Free', 'minutes_limit' => 10, 'id' => 7],
                                    ['plan_name' => 'Student Discount', 'credit' => 200, 'duration' => '90 Days', 'expiry' => '2026-02-01', 'price' => '$19.99', 'minutes_limit' => 120, 'id' => 8],
                                ];
                                ?>
                                @foreach ($userPlans as $plan)
                                    <tr class="@if ($loop->odd) bg-light @else bg-white @endif">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $plan['plan_name'] }}</td>
                                        <td>{{ $plan['credit'] }}</td>
                                        <td>{{ $plan['duration'] }}</td>
                                        <td>{{ $plan['expiry'] }}</td>
                                        <td>{{ $plan['price'] }}</td>
                                        <td>{{ $plan['minutes_limit'] }}</td>
                                        <td>
                                            <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i
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
@endsection
