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
                        <h3 class="text-white r">{{ $FreePlansCount }}</h3>
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
                        <h3 class="text-white r">{{ $PaidPlansCount }}</h3>
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
                        <h3 class="text-white r"> $ {{ number_format($TotalRevenue ?? 0, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">

                <div class="year-buttons mb-3">
                    <button id="thisYearBtn" class="btn btn-primary">This Year</button>
                    <button id="lastYearBtn" class="btn btn-secondary">Last Year</button>
                </div>

                <div id="chartContainer" style="height: 400px; width: 100%;"></div>
                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            title: {
                                text: "Total Users"
                            },
                            axisX: {
                                valueFormatString: "MMM"
                            },
                            axisY: {
                                title: "Users"
                            },
                            data: [{
                                type: "area",
                                xValueFormatString: "MMM",
                                yValueFormatString: "#,###",
                                dataPoints: []
                            }]
                        });

                        chart.render();

                        function fetchData(year) {
                            fetch(`/users-stats?year=${year}`)
                                .then(res => res.json())
                                .then(data => {
                                    if (data.error) {
                                        console.error("Server error:", data.error);
                                        return;
                                    }

                                    chart.options.data[0].dataPoints = data.map(dp => ({
                                        x: new Date(dp.x),
                                        y: dp.y
                                    }));

                                    chart.options.title.text = `Total Users - ${year}`;
                                    chart.render();
                                })
                                .catch(err => console.error("Failed to fetch user data", err));
                        }

                        const currentYear = new Date().getFullYear();

                        // Initial load
                        fetchData(currentYear);

                        // Button events
                        document.getElementById("thisYearBtn").addEventListener("click", () => fetchData(currentYear));
                        document.getElementById("lastYearBtn").addEventListener("click", () => fetchData(currentYear - 1));
                    });
                </script>
            </div>

            <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="card custom-card shadow-sm p-4" style="height: 400px; overflow: auto; margin-top: 52px;">
                    <h3 style="font-size: 20px">New Users</h3>
                    @foreach ($users as $user)
                        <div class="d-flex align-items-center gap-3 mt-4">

                            <div><img
                                    src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('assets/images/profile.png') }}"
                                    alt="" width="50px" class="rounded-circle"></div>


                            <div>
                                <h5>{{ $user->user_name }}({{ $user->user_role }})</h5>
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
