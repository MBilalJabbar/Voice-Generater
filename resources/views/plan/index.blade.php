<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speechly Studio - Register</title>

    <!-- Bootstrap & Icons -->
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
        }

        /* ---------- Navbar ---------- */
        .navbar {
            background-color: #fff;
            padding: 1rem 0;
        }

        .navbar .nav-link {
            color: rgba(0, 62, 120, 1);
            font-weight: 500;
        }

        .navbar .nav-link:hover {
            text-decoration: underline;
        }

        /* ---------- Buttons ---------- */
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

        .btn-outline:hover {
            background-color: #f8f8f8;
        }

        .btn-primary-custom {
            background-color: rgba(0, 62, 120, 1);
            color: #fff;
        }

        .btn-primary-custom:hover {
            background-color: rgba(0, 62, 120, 0.9);
        }

        /* ---------- Hero Section ---------- */
        .hero-section {
            text-align: center;
            padding: 80px 20px;
        }

        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-section .text-color {
            color: rgba(0, 0, 0, 1);
            font-weight: 500;
            font-size: 1.4rem;
            line-height: 1.5;
            margin-bottom: 40px;
        }

        .hero-section .text-color p {
            margin: 5px 0;
        }

        /* ---------- Responsive ---------- */
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand mt-3" href="#">
                <img src="{{ asset('assets/images/Purple and Black Podcast Microphone Logo 1 (1).png') }}" alt="Logo" width="80">
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links & buttons -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto ml-3">
                    <li class="nav-item active">
                        <a class="nav-link" href="#" style="color:  #003E78;">Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color:  #333333;">Pricing</a>
                    </li>
                </ul>

                <!-- Sign In / Sign Up Buttons -->
                <div class="ml-auto d-flex align-items-center">
                    <a href="{{ route('login') }}" class="btn btn-outline btn-rounded mr-3">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary-custom btn-rounded">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="hero-section container">
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

    <div class="text-center">
        <video src="{{ asset('assets/video/1115101_Broadcast_Woman_3840x2160.mp4') }}"
            style="width: 80%; height: auto; border-radius: 12px;" autoplay muted loop></video>
    </div>
    <div class="container py-5" style="background:#fff;">
        <div class="row g-4">

            <div class="row">
                @foreach ($plans as $plan)
                    <div class="col-md-4 mb-4">
                        <div class="p-4 shadow-sm h-100 d-flex flex-column justify-content-between"
                            style="border-radius:25px; border:1px solid #eee;">
                            <div class="" style="color:#231D4F;">
                                <h2 class="fw-bold mb-2" style="font-weight: 800">{{ $plan->name }}</h2>
                                <h2 class="fw-bold mb-2" style="font-weight: 700">
                                    ${{ number_format($plan->price, 0) }}
                                    <small style="font-size:16px; font-weight:600;">/month</small>
                                </h2>
                                <h4 style="font-size:20px; color:#231D4F">
                                    PKR {{ number_format($plan->price, 0) }}
                                </h4>
                            </div>

                            <ul class="list-unstyled text-start mt-3 mb-4"
                                style="color:rgba(132,129,153,1); font-size:16.96px; line-height:29.4px;">
                                @if ($plan->characters)
                                    <li class="mt-2"><i class="fas fa-check me-2"
                                            style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        {{ number_format($plan->characters) }} Characters
                                    </li>
                                @endif

                                @if ($plan->minutes)
                                    <li class="mt-2"><i class="fas fa-check me-2"
                                            style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        {{ number_format($plan->minutes) }} Minutes
                                    </li>
                                @endif

                                @if ($plan->text_to_speech)
                                    <li class="mt-2"><i class="fas fa-check me-2"
                                            style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        Text to Speech
                                    </li>
                                @endif

                                @if ($plan->bulk_voice_generation)
                                    <li class="mt-2"><i class="fas fa-check me-2"
                                            style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        Bulk Voice Generation
                                    </li>
                                @endif

                                @if ($plan->voice_cloning)
                                    <li class="mt-2"><i class="fas fa-check me-2"
                                            style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        Voice Cloning
                                    </li>
                                @endif

                                @if ($plan->voice_effects)
                                    <li class="mt-2"><i class="fas fa-check me-2"
                                            style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        Voice Effects
                                    </li>
                                @endif
                            </ul>

                            <button class="btn text-white w-100 mt-auto"
                                style="background:rgba(0,62,120,1); height:50px; border-radius:27px; font-weight:500;">
                                Choose Plan
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
