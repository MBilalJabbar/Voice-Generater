<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Speechly Studio - Payment Method</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/fav-icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .copy-item{
            cursor: pointer !important;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h2><strong>Pay with USDT</strong></h2>
        <p>Pay with USDT</p>
    </div>
    <div class="container mt-5">
        <div class="row g-4"> <!-- GAP FIXED HERE -->
            <!-- RIGHT CARD -->
            <div class="col-12 col-md-6">
                <div class="p-4 border rounded"> <!-- PROPER CARD SPACING -->
                    <h4>QR Code Payment</h4>
                    <p class="text-danger">
                        Use Crypto wallet to pay. Blockchain Network: TRC - Binance Smart Chain (TRC20)
                    </p>

                    <div class="text-center">
                        <img src="{{ asset('WhatsApp Image 2025-12-10 at 23.23.23_c3f573c6.jpg') }}" style="border: 2px solid #fafafa; margin-block: 32px; border-radius: 12px;" width="242" alt="binance-note">
                    </div>
                    <p class="text-center">Scan QR code or pay according to the information next to it</p>
                </div>
            </div>

            <!-- LEFT CARD -->
            <div class="col-12 col-md-6">
                <div class="p-4 border rounded"> <!-- PROPER CARD SPACING -->
                    <h3>Transfer Information</h3>
                    <p>Transfer according to the information below</p>

                    <div class="row mb-3">
                        <div class="col-4">
                            <p>Cryptocurrency type:</p>
                            <p>Network:</p>
                            <p>Wallet address:</p>
                        </div>

                        <div class="col-8 text-end">
                            <p class="copy-item cursor-pointer" onclick="copyText('USDT')">
                                USDT <img src="{{ asset('copy-svgrepo-com.svg') }}" width="18">
                            </p>

                            <p class="copy-item cursor-pointer" onclick="copyText('TRC20')">
                                TRC20 <img src="{{ asset('copy-svgrepo-com.svg') }}" width="18">
                            </p>

                            <p class="copy-item cursor-pointer"
                            onclick="copyText('TMcAamuSPZxJ2vu5j9WKCmR6hnNTLn6bt3')">
                                TMcAamuSPZxJ2vu5j9WKCmR6hnNTLn6bt3 <img src="{{ asset('copy-svgrepo-com.svg') }}" width="18">
                            </p>
                        </div>
                    </div>

                    <button type="button" onclick="copyAll()" class="btn btn-primary w-100 pay-button">
                        <img src="{{ asset('copy-svgrepo-com (1).svg') }}" width="18"> Copy All Information
                    </button>

                    <div class="mt-3 p-3 border rounded text-danger bg-light">
                        <h6><b>Important Note</b></h6>
                        <p>Please select the correct network and token. We will not be responsible if you send to the wrong network or wrong token.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container my-5">
        <div class="text-center mb-4">
            <h3>Transaction Confirmation Process</h3>
            <p>Your transaction will be processed according to the following timeline</p>
        </div>

        <div class="row g-4"> <!-- GAP FIXED -->

            <!-- LEFT CARD -->
            <div class="col-12 col-md-6">
                <div class="p-4 border rounded">
                    <h4>Processing Time</h4>
                    <p>Transactions are typically confirmed within 5–15 minutes after successful payment.</p>
                </div>
            </div>

            <!-- RIGHT CARD -->
            <div class="col-12 col-md-6">
                <div class="p-4 border rounded">
                    <h4>Need Support?</h4>
                    <p>If you have any questions or issues, contact us at Telegram Channel.</p>
                </div>
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
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

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
            USDT: USDT
            Network: TRC20
            Wallet address: TMcAamuSPZxJ2vu5j9WKCmR6hnNTLn6bt3
                    `.trim();

            navigator.clipboard.writeText(text).then(() => {
                showToast();
            });
        }
    </script>

</body>

</html>
