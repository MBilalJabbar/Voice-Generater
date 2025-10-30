@extends('layouts.app')

@section('title')
    Contact Us
@endsection

@section('body')
    <div class="container-fluid mt-5 mb-5">
        <!-- Restoring the centered column size for a cleaner form appearance -->
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm" style="border-radius: 15px; border: 2px solid rgba(231, 234, 233, 1);">
                    <div class="card-body p-4 p-md-5">
                        <h4 style="font-weight: 800">Contact Us</h4>
                        <form action="/contact" method="POST">
                            @csrf

                            <!-- Row 1: Full Name and Email -->
                            <div class="row mb-4 mt-4">
                                <!-- Full Name (Left Column) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullName" class="text-muted small">First Name</label>
                                        <input type="text" class="form-control" id="fullName" name="full_name"
                                            placeholder="Enter First Name" required
                                            style="border-radius: 8px; height: 45px; border: 1px solid #ced4da;">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fullName" class="text-muted small">Last Name</label>
                                        <input type="text" class="form-control" id="fullName" name="full_name"
                                            placeholder="Enter Last Name" required
                                            style="border-radius: 8px; height: 45px; border: 1px solid #ced4da;">
                                    </div>
                                </div>
                            </div>

                            <!-- Row 2: Phone Number and Subject -->
                            <div class="row mb-4">
                                <!-- Phone Number (Left Column) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="text-muted small">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone_number"
                                            placeholder="Enter Phone Number"
                                            style="border-radius: 8px; height: 45px; border: 1px solid #ced4da;">
                                    </div>
                                </div>

                                <!-- Email (Right Column) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="text-muted small">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter Email Address" required
                                            style="border-radius: 8px; height: 45px; border: 1px solid #ced4da;">
                                    </div>
                                </div>
                            </div>

                            <!-- Row 3: Message (Text Area - Full Width) -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="message" class="text-muted small">Message</label>
                                        <textarea class="form-control" id="message" name="message" rows="5"
                                            placeholder="Type your detailed message here..." required style="border-radius: 8px; border: 1px solid #ced4da;"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button (Dark Blue and Right Aligned) -->
                            <div class="row mt-4">
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn text-white shadow-sm"
                                        style="background-color: #0D47A1; border-radius: 8px; padding: 12px 40px; font-weight: 600; border: none;">
                                        Send Message
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
