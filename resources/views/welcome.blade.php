<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speechly Studio - Register</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            padding-top: 100px; /* Adjust this value if your navbar height changes */
        }

        /* ---------- Navbar ---------- */
        .navbar {
            background-color: #fff;
            padding: 1rem 0;
            /* 3. FIX THE NAVBAR AT THE TOP */
            position: fixed;
            top: 0;
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light p-0">
        <div class="container">
            <a class="navbar-brand mt-3" href="#home-section">
                    <img src="{{ asset('assets/images/Purple and Black Podcast Microphone Logo 1 (1).png') }}" alt="Logo" width="90">
                {{-- <img src="{{ asset('assets/images/Group 1000007299@3x.png') }}" alt="Logo" width="80"> --}}
                <br>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto ml-3">
                    <li class="nav-item active">
                        <a class="nav-link" href="#home-section">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing-section">Pricing</a>
                    </li>
                </ul>

                <div class="ml-auto d-flex align-items-center">
                    <a href="{{ route('login') }}" class="btn btn-outline btn-rounded mr-3">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary-custom btn-rounded">Sign Up</a>
                </div>
            </div>
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
    <video
        src="{{ asset('assets/video/1115101_Broadcast_Woman_3840x2160.mp4') }}"
        style="width: 65%; height: 50vh; border-radius: 12px; object-fit: cover;"
        autoplay muted loop>
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
                <div class="col-md-4 mt-5">
                    <div class="p-4 shadow-sm h-100 d-flex flex-column justify-content-between"
                        style="border-radius:25px; border:1px solid #eee;">
                        <div class="" style="color:#231D4F;">
                            <h2 class="fw-bold mb-2" style="font-size:26px; font-weight:800">{{ $webplans->name }}</h2>
                            <h3 class="fw-bold mb-2" style="font-size:22px; font-weight:700">{{ rtrim(rtrim(number_format($webplans->price, 2, '.', ''), '0'), '.') }}
 {{ $webplans->currency }} <small
                                    style="font-size:16px; font-weight:600;">/{{ $webplans->duration }}</small></h3>
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
                                    @if (!empty($webplans->minutes))
                                        <i class="fas fa-check me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        {{$webplans->minutes}} Characters
                                    @else
                                        <i class="fas fa-times me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                         {{ $webplans->minutes }} Characters
                                    @endif
                                </li>
                                <li class="mt-2">
                                    @if (!empty($webplans->characters))
                                        <i class="fas fa-check me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        {{$webplans->characters}} Minutes
                                    @else
                                        <i class="fas fa-times me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                         {{ $webplans->characters }} Minutes
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
                                         {{ $label }}     {{-- {{ $value }} --}}
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ url('viewCheckout', base64_encode($webplans->id)) }}">
                        <button class="btn text-white w-100 mt-auto"
                            style="background:rgba(0,62,120,1); height:50px; border-radius:27px; font-weight:500;">Choose Plan
                            {{-- {{ $plan['btn'] }} --}}
                        </button>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
