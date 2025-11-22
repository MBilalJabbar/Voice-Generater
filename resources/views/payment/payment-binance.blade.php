<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .pay-button {
            background-color: #003E78;
            padding: 12px 28px;
            border-radius: 32px;
        }

        .card-border {
            border: 1px solid #003E78;
            border-radius: 12px;
            padding: 26px;
            box-shadow: 0 0 4px #003E78;
        }

        .card-border2 {
            border: 1px solid #003E78;
            border-radius: 12px;
            padding: 12px;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h2><strong>Pay with Binance</strong></h2>
        <p>Pay with Binance app</p>
    </div>
    <div class="container mt-5">
        <div class="row">

            <!-- LEFT CARD -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-6 card-border">
                <h3>Transfer Information</h3>
                <p>Use Binance app to transfer according to the information below</p>

                <div class="row">
                    <div class="col-6">
                        <p>Currency:</p>
                        <p>Binance User ID:</p>
                        <p>Note:</p>
                    </div>

                    <div class="col-6 text-end">
                        <p class="copy-item" onclick="copyText('USDT')">
                            USDT <span class="text-primary ms-2" style="cursor:pointer;"><img src="{{ asset('copy-svgrepo-com.svg') }}" width="18" alt=""></span>
                        </p>

                        <p class="copy-item" onclick="copyText('12801280')">
                            12801280 <span class="text-primary ms-2" style="cursor:pointer;"><img src="{{ asset('copy-svgrepo-com.svg') }}" width="18" alt=""></span>
                        </p>

                        <p class="copy-item" onclick="copyText('Speechly Studio')">
                            Speechly Studio <span class="text-primary ms-2" style="cursor:pointer;"><img src="{{ asset('copy-svgrepo-com.svg') }}" width="18" alt=""></span>
                            {{-- 📋 --}}
                        </p>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="button" onclick="copyAll()" class="btn btn-primary w-100 pay-button">
                       <img src="{{ asset('copy-svgrepo-com (1).svg') }}" width="18" alt=""> Copy All Information
                    </button>
                </div>
                 <div class="col-12 col-md-12 col-lg-12 col-xl-12 card-border2 mt-2 text-danger">
                <h6><b>Important Note</b></h6>
                <p>Please enter the correct transfer information and select the correct token.</p>
            </div>
            </div>

            <!-- RIGHT CARD -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-6 card-border">
                <h4>IMPORTANT NOTE</h4>
                <p class="text-danger">
                    Make sure to fill in complete note information for automatic transaction confirmation.
                </p>

                <div class="d-flex justify-content-center">
                    <img src="{{ asset('binance_note.jpg') }}" width="226" alt="binance-note">
                </div>
            </div>

        </div>
    </div>

    <div class="container my-4">
        <div class="row card-border">
            <div class="text-center mb-2">
                <h3>Transaction Confirmation Process</h3>
                <p>Your transaction will be processed according to the following timeline</p>
            </div>
            <!-- LEFT CARD -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-6 card-border2">
                <h4>Processing Time</h4>
                <p>Transactions are typically confirmed within 5-15 minutes after successful payment</p>
            </div>

            <!-- RIGHT CARD -->
            <div class="col-12 col-md-6 col-lg-6 col-xl-6 card-border2">
                <h4>Need Support?</h4>
                <p>If you have any questions or issues, contact us at Telegram Channel</p>
            </div>

        </div>
    </div>




    <!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div id="copyToast" class="toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                Copied to clipboard!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

   <script>
    function showToast() {
        var toastEl = document.getElementById('copyToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    }

    // Copy individual fields
    function copyText(text) {
        navigator.clipboard.writeText(text).then(() => {
            showToast();
        });
    }

    // Copy ALL fields
    function copyAll() {
        const text = `
Currency: USDT
Binance User ID: 12801280
Note: Speechly Studio
        `.trim();

        navigator.clipboard.writeText(text).then(() => {
            showToast();
        });
    }
</script>



</body>

</html>
