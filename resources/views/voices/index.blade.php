@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('body')
    <style>
        /* Updated avatar style for a cleaner look */
        .avatar {
            display: inline-block;
            width: 45px;
            /* Set a specific width */
            height: 45px;
            /* Set a specific height */
            overflow: hidden;
            /* Ensure image doesn't bleed */
            border-radius: .5rem;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: inherit;
        }

        /* Style for the voice detail text */
        .voice-meta {
            font-size: 0.85rem;
            color: #6c757d;
            /* text-muted */
            font-weight: 500;
            /* fw-semibold */
            line-height: 1.2;
        }

        .voice-meta span {
            margin-right: 0.5rem;
            display: inline-flex;
            /* Use flex to align items vertically */
            align-items: center;
            /* Center items vertically */
        }

        .voice-meta img {
            vertical-align: middle;
            /* Align image with text */
        }

        .voice-actions {
            display: flex;
            align-items: center;
            margin-left: auto;
            /* Push actions to the right */
        }

        .voice-actions button {
            background: none;
            border: none;
            padding: 0 0.25rem;
            color: #343a40;
            /* dark color for icons */
            font-size: 1.25rem;
        }

        .voice-actions button:hover {
            color: #003E78;
            /* hover effect */
        }

        /* Specific styles for the search bar card and input */
        .card.search-card {
            padding: 0.5rem !important;
            /* Reduced padding on the card */
        }

        .card.search-card .input-group-text,
        .card.search-card .form-control {
            border: none;
            /* Remove borders from search input group */
            padding: 0.5rem 0.75rem; /* Adjusted padding */
            height: auto; /* Reset height */
        }
        
        /* New style for smaller Trending/Filter buttons */
        .compact-header-btn {
            padding: 0.5rem 1rem; /* Reduced padding for smaller size */
            font-size: 0.9rem; /* Smaller font size */
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 20px;
        }

        /* Active/Selected button style (Trending) */
        .trending-btn.active {
            background-color: #ffffff;
            color: #003E78;
        }

        /* Default style for Filter button */
        .filter-btn {
            background-color: #ffffff;
            color: #343a40;
            /* border: 1px solid #e7eaec; */
        }
    </style>
    <div class="container-fluid mt-4">
        <div class="row align-items-center mb-4">

            <div class="col-xl-8 col-lg-7 col-md-12 col-sm-12 col-12 mb-3 mb-xl-0" style="width: 50%">
                <div class="card custom-card search-card shadow-sm">
                    <div class="input-group">
                        <span class="input-group-text bg-white" style="padding-right: 0.5rem;">
                            <i class="fa-solid fa-magnifying-glass" style="color:#003E78; font-size: 1rem;"></i>
                        </span>
                        <input type="search" class="form-control" placeholder="Search library voices...">
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 mb-3 mb-xl-0">
                <div class="card custom-card">
                    <div class="compact-header-btn trending-btn active" style="padding: 17px">
                        <i class="fa-solid fa-chart-line me-2" style="color:#003E78;"></i> Trending
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-6 mb-3 mb-xl-0">
                <div class="card custom-card">
                    <div class="compact-header-btn filter-btn" style="padding: 17px">
                        <i class="fa-solid fa-filter me-2" style="color:#003E78;"></i> Filter
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-6 mb-3 mb-xl-0">
                <div class="card custom-card">
                    <div class="compact-header-btn filter-btn" style="padding: 17px">
                        <i class="fa-solid fa-clone me-2" style="color:#003E78;"></i> Cloned Voice
                    </div>
                </div>
            </div>

        </div>

        <h3 style="font-size: 1.5rem; font-weight:600; margin-bottom: 1.5rem;">Trending Voices</h3>
        <div class="row">
            @for ($i = 0; $i < 9; $i++)
                {{-- Loop to create 9 identical cards --}}
                <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card custom-card shadow-sm"
                        style="border-radius:10px; border:2px solid rgba(231, 234, 233, 1);">
                        <div class="card-body d-flex align-items-center p-3">
                            <span class="avatar">
                                <img src="{{ asset('assets/images/Ellipse 22.png') }}" alt="Voice Profile">
                            </span>
                            <div class="flex-fill ms-3">
                                <h5 class="fw-semibold mb-1 lh-1" style="font-size: 1rem;">Declan Sage - Wise, Deliberate...
                                </h5>
                                <div class="voice-meta d-flex flex-column"> {{-- Use flex-column to stack meta info --}}
                                    <span>Narrative & Story</span>
                                    <span class="mt-1 d-flex align-items-center"> {{-- Added mt-1 for spacing and d-flex for alignment --}}
                                        <img src="{{ asset('assets/images/Ellipse 32.png') }}" alt="Country Flag 1"
                                            style="width: 15px; height: 15px; margin-right: 3px;">
                                        <img src="{{ asset('assets/images/Ellipse 33.png') }}" alt="Country Flag 2"
                                            style="width: 15px; height: 15px; margin-right: 5px;">
                                        English +8
                                    </span>
                                </div>
                            </div>
                            {{-- Action Buttons --}}
                            <div class="voice-actions">
                                <button type="button" class="btn btn-sm text-dark p-0 me-2" title="Add">
                                    <i class="fa-solid fa-plus-circle"></i>
                                </button>
                                <button type="button" class="btn btn-sm text-dark p-0" title="More Options">
                                    <i class="fa-solid fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection