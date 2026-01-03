<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speechly Studio - Index</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/media-query.css') }}">
    <style>
        /* ---------- Global Styles ---------- */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            color: #000;
            margin: 0;
            padding: 0;
            /* 1. ENABLE SMOOTH SCROLLING */
            scroll-behavior: smooth;
            /* 2. ADD PADDING TO PREVENT FIXED NAVBAR FROM HIDING TOP CONTENT */
            padding-top: 10px;
            /* Adjust this value if your navbar height changes */
        }

        /* ---------- Navbar ---------- */
        .navbar {
            background-color: #fff;
            padding: 1rem 0;
            /* 3. FIX THE NAVBAR AT THE TOP */
            /* position: fixed;
            top: 0; */
            width: 100%;
            /* Ensure it stays on top of other elements */
            z-index: 1030;
            /* box-shadow: 0 2px 4px rgba(0,0,0,0.1); Optional: Adds a subtle shadow for definition */
        }

        .navbar .nav-link {
            color: rgba(0, 62, 120, 1);
            font-weight: 500;
        }

        .navbar .nav-link:hover {
            text-decoration: underline;
        }

        /* ---------- Buttons (No Change) ---------- */
        .btn-rounded {
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 10px 30px;
        }

        .btn-outline {
            border: 1px solid #ccc;
            background: transparent;
            color: #000;
        }

        /* .btn-outline:hover {
            background-color: #f8f8f8;
        } */
        .btn-outline:hover {
            color: #fff;

            background-color: #003E78;
        }

        .btn-primary-custom {
            background-color: rgba(0, 62, 120, 1);
            color: #fff;
        }

        /* .btn-primary-custom:hover {
            background-color: rgba(0, 62, 120, 0.9);
        } */
        .btn-primary-custom:hover {
            color: #003E78 !important;
            background: transparent !important;
            border-color: rgba(0, 62, 120, 0.9) !important;
        }

        /* ---------- Hero Section (No Change to styling) ---------- */
        .hero-section {
            text-align: center;
            padding: 10px 20px;
        }

        .hero-section h1 {
            font-size: 38px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .hero-section .text-color {
            color: rgba(0, 0, 0, 1);
            font-weight: 500;
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .hero-section .text-color p {
            margin: 5px 0;
        }

        /* ---------- Responsive (No Change) ---------- */
        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 15px;
            }

            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section .text-color {
                font-size: 1.1rem;
            }

            .btn-rounded {
                font-size: 1rem;
                padding: 8px 20px;
            }
        }


        /* ===== Sidebar (Mobile & Tablet) ===== */
.sidebar {
    position: fixed;
    top: 0;
    left: -300px;
    width: 280px;
    height: 100%;
    background: #fff;
    padding: 20px;
    transition: all 0.3s ease;
    z-index: 1050;
    box-shadow: 2px 0 15px rgba(0,0,0,0.15);
}

/* Open sidebar */
.sidebar.active {
    left: 0;
}

/* Overlay */
.sidebar-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: none;
    z-index: 1040;
}

.sidebar-overlay.active {
    display: block;
}

/* Close button */
.close-sidebar {
    font-size: 32px;
    background: none;
    border: none;
    position: absolute;
    top: 10px;
    right: 15px;
    cursor: pointer;
}

/* Buttons spacing */
.sidebar .btn {
    width: 100%;
}

/* ===== Desktop Layout ===== */
@media (min-width: 992px) {
    .sidebar {
        position: static;
        width: auto;
        height: auto;
        padding: 0;
        left: 0;
        box-shadow: none;
        display: flex !important;
        flex-direction: row;
        align-items: center;
    }

    .sidebar-overlay,
    .close-sidebar {
        display: none !important;
    }

    .navbar-nav {
        flex-direction: row;
        margin-left: 40px;
    }

    .navbar-toggler {
        display: none;
    }

    .sidebar .mt-4 {
        margin-top: 0 !important;
        /* margin-left: auto; */
        display: flex;
        gap: 12px;
    }

    .sidebar .btn {
        width: auto;
    }
}


    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light p-0">
    <div class="container mobile-header-padding">

        <!-- LOGO -->
        <a class="navbar-brand mt-3 mr-4" href="{{ url('/') }}">
            <img src="{{ asset('assets/images/Purple and Black Podcast Microphone Logo 1 (1).png') }}"
                alt="Logo" width="115">
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" id="sidebarToggle">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- SIDEBAR MENU -->
        <div class="navbar-collapse sidebar" id="navbarNav">
            <button class="close-sidebar d-lg-none">&times;</button>

            <ul class="navbar-nav mt-4 margin-bottom-sidebar-mobile">
                <li class="nav-item active">
                    <a class="nav-link" href="#home-section">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#pricing-section">Pricing</a>
                </li>
            </ul>

            <!-- BUTTONS -->
            {{-- <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-outline btn-block mb-2">
                    Log In
                </a>
                <a href="{{ route('register') }}" class="btn btn-primary-custom btn-block">
                    Sign Up
                </a>
            </div> --}}
            <div class="ml-auto d-flex align-items-center">
                    <a href="{{ route('login') }}" class="btn btn-outline btn-rounded mr-3">Log In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary-custom btn-rounded">Sign Up</a>
                </div>

        </div>

        <!-- OVERLAY -->
        <div class="sidebar-overlay"></div>

    </div>
</nav>


    <section class="hero-section container" id="home-section">
        <h1>The most realistic voice AI platform</h1>
        <div class="text-color">
            <p>AI voice models and products powering millions of developers, creators, and enterprises.</p>
            <p>From low-latency conversational agents to the leading AI voice generator for voiceovers and audiobooks.
            </p>
        </div>

        <div class="d-flex justify-content-center">
            <a href="{{ route('register') }}" class="btn btn-primary-custom btn-rounded mr-3">Sign Up</a>
            <a href="{{ route('login') }}" class="btn btn-outline btn-rounded">Contact Sale</a>
        </div>
    </section>
    {{-- <div class="text-center my-2">
        <video src="{{ asset('assets/video/1115101_Broadcast_Woman_3840x2160.mp4') }}"
            style="width: 70%; border-radius: 50px;"></video>
    </div> --}}
    <div class="text-center my-2">
        <video class="voice-mobile-width" src="{{ asset('assets/video/1115101_Broadcast_Woman_3840x2160.mp4') }}"
            style="width: 65%; height: 50vh; border-radius: 12px; object-fit: cover;" autoplay muted loop>
        </video>
    </div>


    <div class="container py-5" style="background:#fff;" id="pricing-section">
        <div class="row g-4">

            {{-- @php
                $plans = [
                    ['name' => 'Free Plan', 'usd' => '$0', 'pkr' => 'PKR 0', 'btn' => 'Choose Plan'],
                    ['name' => 'Basic Plan', 'usd' => '$49', 'pkr' => 'PKR 14,000', 'btn' => 'Choose Plan'],
                    ['name' => 'Standard Plan', 'usd' => '$89', 'pkr' => 'PKR 25,000', 'btn' => 'Choose Plan'],
                    ['name' => 'Premium Plan', 'usd' => '$189', 'pkr' => 'PKR 53,000', 'btn' => 'Choose Plan'],
                    ['name' => 'Business Plan', 'usd' => '$499', 'pkr' => 'PKR 140,000', 'btn' => 'Choose Plan'],
                    [
                        'name' => 'Enterprise Plan',
                        'usd' => 'Negotiable',
                        'pkr' => 'Custom Pricing',
                        'btn' => 'Contact Us',
                    ],
                ];
            @endphp

            @foreach ($plans as $plan)
                <div class="col-md-4 mt-5">
                    <div class="p-4 shadow-sm h-100 d-flex flex-column justify-content-between"
                        style="border-radius:25px; border:1px solid #eee;">
                        <div class="" style="color:#231D4F;">
                            <h2 class="fw-bold mb-2" style="font-size:26px; font-weight:800">{{ $plan['name'] }}</h2>
                            <h3 class="fw-bold mb-2" style="font-size:22px; font-weight:700">{{ $plan['usd'] }} <small
                                    style="font-size:16px; font-weight:600;">/month</small></h3>
                            <h4 style="font-size:18px; color:#231D4F;font-weight:600">{{ $plan['pkr'] }}</h4>
                        </div>

                        <ul class="list-unstyled text-start mt-3 mb-4"
                            style="color:rgba(132,129,153,1); font-size:16.96px; line-height:29.4px;">
                            <li class="mt-2"><i class="fas fa-check me-2"
                                    style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>5000
                                Characters</li>
                            <li class="mt-2"><i class="fas fa-check me-2"
                                    style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>5
                                Minutes</li>
                            <li class="mt-2"><i class="fas fa-check me-2"
                                    style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>Text-to-Speech
                            </li>
                            <li class="mt-2"><i class="fas fa-check me-2"
                                    style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>Bulk
                                Voice Generation</li>
                            <li class="mt-2"><i class="fas fa-check me-2"
                                    style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>Voice
                                Effects (Pitch, Speed, Emotion)</li>
                            <li class="mt-2"><i class="fas fa-check me-2"
                                    style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>Ultra
                                HD Audio (320 kbps)</li>
                            <li class="mt-2"><i class="fas fa-check me-2"
                                    style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>All
                                ElevenLabs voices & models</li>
                            <li class="mt-2"><i class="fas fa-check me-2"
                                    style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>Voice
                                Cloning & Change</li>
                        </ul>

                        <button class="btn text-white w-100 mt-auto"
                            style="background:rgba(0,62,120,1); height:50px; border-radius:27px; font-weight:500;">
                            {{ $plan['btn'] }}
                        </button>
                    </div>
                </div>
            @endforeach --}}


            @foreach ($plans as $webplans)
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-5">
                    <div class="p-4 shadow-sm h-100 d-flex flex-column justify-content-between"
                        style="border-radius:25px; border:1px solid #eee;">
                        <div class="" style="color:#231D4F;">
                            <h2 class="fw-bold mb-2" style="font-size:26px; font-weight:800">{{ $webplans->name }}</h2>
                            <h3 class="fw-bold mb-2" style="font-size:22px; font-weight:700">
                                {{ $webplans->currency }}
                                {{ rtrim(rtrim(number_format($webplans->price, 2, '.', ''), '0'), '.') }} /
                                <small style="font-size:16px; font-weight:600;">{{ $webplans->duration }} Days</small>
                            </h3>
                            {{-- <h4 style="font-size:18px; color:#231D4F;font-weight:600">{{ $webplans->price }}</h4> --}}
                        </div>
                        @php
                            $features = [
                                // 'Characters' => $webplans->characters,
                                // 'Minutes' => $webplans->minutes,
                                'Text to Speech' => $webplans->text_to_speech,
                                'Bulk Voice Generation' => $webplans->bulk_voice_generation,
                                'Voice Effects (Pitch, Speed, Emotion)' => $webplans->voice_effects,
                                'Ultra HD Audio (320 kbps)' => $webplans->ultra_hd_audio,
                                'All ElevenLabs voices & models' => $webplans->all_voices_models,
                                'Voice Cloning & Change' => $webplans->voice_cloning,
                            ];

                        @endphp

                        <ul class="list-unstyled text-start mt-3 mb-4"
                            style="color:rgba(132,129,153,1); font-size:16.96px; line-height:29.4px;">
                            <li class="mt-2">
                                @if (!empty($webplans->characters))
                                    <i class="fas fa-check me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                    {{ $webplans->characters }} Characters
                                @else
                                    <i class="fas fa-times me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                    {{ $webplans->characters }} Characters
                                @endif
                            </li>
                            <li class="mt-2">
                                @if (!empty($webplans->minutes))
                                    <i class="fas fa-check me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                    {{ $webplans->minutes }} Minutes
                                @else
                                    <i class="fas fa-times me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                    {{ $webplans->minutes }} Minutes
                                @endif
                            </li>


                            @foreach ($features as $label => $value)
                                <li class="mt-2">
                                    @if (!empty($value))
                                        <i class="fas fa-check me-2"
                                            style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        {{ $label }}
                                    @else
                                        <i class="fas fa-times me-2"
                                            style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        {{ $label }} {{-- {{ $value }} --}}
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        @if ($webplans->name == 'Free')
                            <a href="{{ url('FreePlanActive', base64_encode($webplans->id)) }}">
                                <button class="btn text-white w-100 mt-auto"
                                    style="background:rgba(0,62,120,1); height:50px; border-radius:27px; font-weight:500;">Choose
                                    Plan
                                    {{-- {{ $plan['btn'] }} --}}
                                </button>
                            </a>
                        @else
                            <a href="{{ url('viewCheckout', base64_encode($webplans->id)) }}">
                                <button class="btn text-white w-100 mt-auto"
                                    style="background:rgba(0,62,120,1); height:50px; border-radius:27px; font-weight:500;">Choose
                                    Plan
                                    {{-- {{ $plan['btn'] }} --}}
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('navbarNav');
    const overlay = document.querySelector('.sidebar-overlay');
    const closeBtn = document.querySelector('.close-sidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    function closeSidebar() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    overlay.addEventListener('click', closeSidebar);
    closeBtn.addEventListener('click', closeSidebar);
});
</script>




    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
            });
        @endif
    </script>

</body>

</html>
