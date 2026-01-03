<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speechly Studio - Sign In</title>
    <!-- Load Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Load Font Awesome for the Google icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/media-query.css') }}">

    <style>
        /* --- Colors & Typography --- */
        :root {
            --primary-indigo: #291A87;
            /* Dark Blue/Indigo from image */
            --accent-purple: #955BFF;
            /* Bright Purple for icon/links */
            --google-button-bg: #EBF2FF;
            --login-button-dark: #003E78;
            /* Darker blue for the main button */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            /* Default background is white */
            min-height: 100vh;
            margin: 0;
            padding: 0;
            position: relative;
        }

        /* --- Custom Background Layout (Dark Indigo Top Half) --- */

        /* This container establishes the dark indigo background for the top half of the screen */
        .top-half-bg {
            background-color: var(--primary-indigo);
            height: 320px;
            /* Define the height of the blue band */
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
            /* Keep it behind the content */
        }

        /* The main content wrapper positions the grid over the background */
        .content-wrapper {
            position: relative;
            z-index: 1;
            padding-top: 50px;
            /* Initial top padding */
        }

        /* --- Left Branding Column Styling --- */

        .left-branding {
            color: #ffffff;
            /* padding-left: 100px;
            padding-right: 50px; */
            /* Adjust padding on smaller screens */
        }

        .logo-section {
            display: flex;
            align-items: center;
            margin-bottom: 200px;
        }

        .logo-icon {
            background-color: var(--accent-purple);
            border-radius: 50%;
            padding: 20px;
            margin-right: 15px;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Using inline SVG for the microphone icon */
        .logo-icon svg {
            fill: #ffffff;
            width: 40px;
            height: 40px;
        }

        .logo-text {
            font-size: 2rem;
            font-weight: 700;
        }

        /* Lower text section (Sign In) */
        .sign-in-text-block {
            color: #000000;
            padding-right: 50px;
        }

        .sign-in-text-block h1 {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 10px;
        }

        .sign-in-text-block p {
            font-size: 1rem;
            color: #495057;
            line-height: 1.6;
        }

        /* --- Right Login Card Styling --- */

        .right-form-col {
            display: flex;
            justify-content: center;
            /* Align to the top of the content-wrapper */
            align-items: flex-start;
        }

        .login-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 25px;
            width: 100%;
            max-width: 450px;
            /* CRITICAL: Box Shadow for the floating card */
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transform: translateY(100px);
            /* Lift the card to float over the background split */
        }

        .login-card h3 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .account-link-container {
            display: flex;
            justify-content: flex-end;
            margin-top: -30px;
            /* Position the link next to "Sign In" title */
            font-size: 0.8rem;
        }

        .account-link-container a {
            color: var(--accent-purple);
            font-weight: 600;
        }

        /* Input Fields */
        .form-control {
            border-radius: 6px;
            padding: 10px 15px;
            font-size: 1rem;
            box-shadow: none;
        }

        .form-group label {
            font-weight: 500;
            color: #212529;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        /* Buttons */
        .google-btn {
            background-color: var(--google-button-bg);
            color: #4285F4;
            border: none;
            padding: 10px;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.2s;
            margin-top: 20px;
        }

        .login-btn {
            background-color: var(--login-button-dark);
            color: #ffffff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .forgot-password-link {
            font-size: 0.8rem;
            color: #007BFF;
            font-weight: 500;
        }


        /* --- RESPONSIVENESS (Mobile/Tablet) --- */

        @media (max-width: 991.98px) {
            /* Medium devices and down */

            /* Stacked layout */
            .content-wrapper {
                padding-top: 0;
                min-height: auto;
            }

            .top-half-bg {
                height: 250px;
                /* Smaller blue band on mobile */
            }

            /* Left column styling adjustments */
            .left-branding {
                padding: 30px 20px;
                margin-bottom: 0;
                text-align: center;
                /* Ensure it sits over the blue background */
            }

            .logo-section {
                justify-content: center;
                margin-bottom: 50px;
            }

            .logo-text {
                font-size: 1.5rem;
            }

            /* Lower text block moves to standard white background area */
            .sign-in-text-block {
                padding: 40px 20px;
                /* text-align: center; */
            }

            .sign-in-text-block h1 {
                font-size: 2rem;
            }

            /* Right form column adjustments */
            .right-form-col {
                padding-top: 0;
                align-items: flex-start;
                justify-content: center;
            }

            .login-card {
                max-width: 90%;
                margin: 0 auto 50px auto;
                transform: translateY(50px);
                /* Lift card less on mobile */
                padding: 30px 25px;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }
        }

        .signup-margin-top{
            margin-top: -150px;
        }
    </style>
</head>

<body>
    <!-- Full-width Dark Indigo background for the top section -->
    <div class="top-half-bg"></div>

    <div class="container content-wrapper">
        <div class="row">

            <!-- Left Branding Column (col-lg-6) -->
            <div class="col-12 col-lg-6">
                <div class="left-branding">
                    <a href="{{ url('/') }}">
                    <img class="mt-5 logo-responsive" src="{{ asset('assets/images/Group 1000007299@3x.png') }}" alt=""
                        width="50%">
                        </a>
                </div>
            </div>

            <!-- Right Login Form Column (col-lg-6) -->
            <div class="col-12 col-lg-6 right-form-col">
                <div class="login-card" style="margin-top: -65px">

                    <!-- Sign In Header and Account Link -->
                    <h3 class="d-inline-block">Sign Up</h3>
                    <div class="account-link-container" style="color:#8D8D8D;">
                        Have an Account?<a href="{{ url('/login') }}"><br> Sign in</a>
                    </div>

                    <hr class="d-none d-lg-block my-3 border-0"> <!-- Separator for better spacing on large screens -->

                    <!-- Sign in with Google Button -->
                    <div class="google-btn">
                    <a href="{{ route('google.login') }}" class="d-flex justify-content-center" >
                        <img class="mr-1" src="{{ asset('assets/images/google logo.png') }}" alt=""
                            width="20px"> Sign in with Google

                    </a>
                    </div>


                    <form id="userCreate">
                        @csrf
                        <!-- Full Name Field -->
                        <div class="form-group mt-2">
                            <label>Enter your Full Name</label>
                            <input type="text" class="form-control @error('full_name')
                                is-invalid
                            @enderror" name="full_name" style="height: 50px; border: 1px solid #4285F4;"
                                placeholder="Enter your full name" required>
                                @error('full_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                        </div>

                        <!-- Username Field -->
                        <div class="form-group mt-4">
                            <label>Enter your Username</label>
                            <input type="text" class="form-control @error('user_name')
                                is-invalid
                            @enderror" name="user_name" style="height: 50px; border: 1px solid #4285F4;"
                                placeholder="Enter your username" required>
                                @error('user_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-group mt-4">
                            <label>Enter your Email Address</label>
                            <input type="email" class="form-control @error('email')
                                is-invalid
                            @enderror" name="email" style="height: 50px; border: 1px solid #4285F4;"
                                placeholder="Enter your email address" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <!-- Phone Number Field -->
                        <div class="form-group mt-4">
                            <label>Enter your Phone Number</label>
                            <input type="tel" class="form-control @error('phone')
                                is-invalid
                            @enderror" name="phone" style="height: 50px; border: 1px solid #4285F4;"
                                placeholder="Enter your phone number" required>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                         <!-- Date of Birth Field -->
                        <div class="form-group mt-4">
                            <label>Enter your Date of Birth</label>
                            <input type="date" class="form-control @error('dob')
                                is-invalid
                            @enderror" name="dob" style="height: 50px; border: 1px solid #4285F4;"
                                placeholder="Enter your date of birth" required>
                                @error('dob')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group mt-4">
                            <label>Enter your Password</label>
                            <input type="password" class="form-control @error('password')
                                is-invalid
                            @enderror" name="password" style="height: 50px; border: 1px solid #4285F4;"
                                placeholder="Enter your password" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group mt-4">
                            <label>Confirm your Password</label>
                            <input type="password" class="form-control @error('password_confirmation')
                                is-invalid
                            @enderror" name="password_confirmation" style="height: 50px; border: 1px solid #4285F4;"
                                placeholder="Confirm your password" required>
                                @error('confirm_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="login-btn">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- --- Lower Text Section (Appears below the blue band on the left) --- -->
        <div class="row">
            <div class="col-12 col-lg-6 signup-margin-top">
                <div class="sign-in-text-block">
                    <h1 style="color: #003E78; font-weight:700;margin-top:-90%">Sign Up to </h1>
                    <h1 style="font-weight:300">Speechly Studio</h1>
                    <p style="color: var(--dark, #333333);">
                        Turn your text into lifelike speech in seconds.<br> Create voiceovers, narrations, and content
                        with <br> just one click.<br> Trusted by creators, educators, and businesses <br> worldwide.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for dropdowns/modals) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function(){
    $('#userCreate').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/CreateUser',
            data: $(this).serialize(),
            success: function(response){
                Swal.fire({
                    title: 'Success!',
                    text: 'User created successfully.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/login'; // ✅ redirect to login
                    }
                });
            },
            error: function(error){
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error creating the user.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>

</body>

</html>
