<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Speechly Studio - Checkout</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav-icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .pay-button {
            background-color: #003E78;
            padding: 12px 28px;
            border-radius: 32px;
        }
        .pay-button img {
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <div class="row">

            <!-- LEFT SIDE: Summary -->
            <div class="col-md-6">
                <h1>Speechly Studio</h1>

                <div class="my-5">
                    <h2><b>${{ $fatchPlan->price }} due today</b></h2>
                    <h4><b>{{ $fatchPlan->name }}</b></h4>
                </div>

                <div class="row">
                    <h2>Summary</h2>

                    <div class="col-6">
                        <p>SubTotal</p>
                        <p>Discount applied</p>
                        <p>Tax</p>
                        <p>Total due today</p>
                    </div>

                    <div class="col-6 text-center">
                        <p>${{ $fatchPlan->price * 2 }}</p>
                        <p>-${{ $fatchPlan->price }}</p>
                        <p>$0.00</p>
                        <p>${{ $fatchPlan->price }}</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: Payment -->
            <div class="col-md-6 align-content-center">

                <!-- Binance Payment -->
                <div class="d-flex justify-content-center flex-column align-items-center mb-3">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 my-3">
                        <form action="{{ url('progressCheckout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan_id" value="{{ $fatchPlan->id }}">
                            <input type="hidden" name="payment_method" value="binance">

                            <button class="btn btn-primary w-100 pay-button">
                                <img src="{{ asset('binance-svgrepo-com.svg') }}" width="20">
                                Pay With Binance
                            </button>
                        </form>

                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                        <form action="{{ url('progressCheckout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan_id" value="{{ $fatchPlan->id }}">
                            <input type="hidden" name="payment_method" value="usdt">

                            <button class="btn btn-primary w-100 pay-button">
                                <img src="{{ asset('bitcoin-money-cryptocurrency-svgrepo-com.svg') }}" width="20">
                                    Pay With USDT
                            </button>
                        </form>
                        {{-- <a href="{{ url('usdtPayPage') }}?plan_id={{ $fatchPlan->id }}" class="btn btn-primary w-100 pay-button">
                            <img src="{{ asset('bitcoin-money-cryptocurrency-svgrepo-com.svg') }}" width="20">
                            Pay With USDT
                        </a> --}}
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 my-3">
                        <form action="{{ url('progressCheckout') }}" method="POST">
                            @csrf

                            <input type="hidden" name="plan_id" value="{{ $fatchPlan->id }}">
                            <input type="hidden" name="payment_method" value="jazzcash">  <!-- FIXED -->

                            <button class="btn btn-primary w-100 pay-button">
                                <img src="{{ asset('binance-svgrepo-com.svg') }}" width="20">
                                JazzCash / Easypaisa Pay
                            </button>
                        </form>
                    </div>


                </div>

                <!-- Card Payment Form -->
                {{-- <h2><strong>Pay With Card</strong></h2>

                <form class="row g-3" action="{{ url('progressCheckout') }}" method="POST">
                    @csrf

                    <input type="hidden" name="plan_id" value="{{ $fatchPlan->id }}">
                    <input type="hidden" name="payment_method" id="payment_method" value="card">

                    <div class="col-md-12">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Card Number</label>
                        <input type="text" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Expiry (MM/YY)</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">CVC</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Cardholder Name</label>
                        <input type="text" name="holder" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Country</label>
                        <select class="form-select">
                            <option disabled selected>Select Country</option>
                            <option value="PK">Pakistan</option>
                            <option value="IN">India</option>
                            <option value="US">United States</option>
                            <option value="UK">United Kingdom</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100 pay-button">Subscribe</button>
                    </div>
                </form> --}}
            </div>

        </div>
    </div>

</body>
</html>
