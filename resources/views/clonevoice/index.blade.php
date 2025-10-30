@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('body')
    <!-- Styles -->
    <style>
        /* Upload Area */
        .upload-area {
            border: 2px dashed #C6D6E2;
            border-radius: 12px;
            text-align: center;
            padding: 2rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .upload-area:hover {
            background-color: rgba(0, 62, 120, 0.05);
            border-color: #003E78;
        }

        .upload-icon {
            font-size: 2rem;
            color: #003E78;
        }

        /* Inputs */
        .input-custom {
            width: 101%;
            height: 55px;
            border-radius: 10px;
        }

        /* Switch */
        .switch-custom {
            background-color: #003E78 !important;
            border: none;
        }

        /* Button */
        .clone-btn {
            background: rgba(0, 62, 120, 1);
            border-radius: 20px;
            width: 27%;
            height: 55px;
        }

        /* Saved Voice List */
        .desktop-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .delete-icon {
            cursor: pointer;
            transition: color 0.2s;
        }

        .delete-icon:hover {
            color: #c82333;
        }

        /* Remove hover effect for Clone Voice button */
        .clone-btn:hover,
        .clone-btn:focus,
        .clone-btn:active {
            background: rgba(0, 62, 120, 1) !important;
            color: #fff !important;
            box-shadow: none !important;
        }
    </style>

    <!-- Script for Drag & Drop -->
    <div class="container-fluid mt-4">
        <div class="card shadow-sm p-4">
            <div class="d-flex align-items-center justify-content-between ">
                <h3 class="fw-bold mb-2"><i class="fa-solid fa-filter"></i> Speechly Studio</h3>
                <div style="background: #F2F5F2; padding:10px">
                    <h6>Voice slots remaining: 1/5</h6>
                </div>
            </div>
            <hr>

            <div class="row">
                <!-- Left: Clone Voice Form -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <h4 class="fw-semibold mb-3">Clone a Voice</h4>
                    <h6 class="fw-semibold mb-1">Upload Voice File</h6>

                    <!-- Drag & Drop File Upload -->
                    <div class="mb-3 mt-4">
                        <div id="upload-area" class="upload-area">
                            <i class="fa-solid fa-cloud-arrow-up mb-3 upload-icon"></i>
                            <p class="mb-1 fw-semibold text-dark">Drag & drop your audio file here</p>
                            <p class="text-muted small text-center">or click to browse</p>
                            <input type="file" class="d-none" id="fileInput" accept="audio/*">
                            <button class="btn btn-light btn-md">Upload</button>
                        </div>
                    </div>

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label class="fw-semibold mb-1">Name</label>
                        <input type="text" class="form-control input-custom shadow-sm" placeholder="Enter Name">
                    </div>

                    <!-- Noise Reduction Switch -->
                    <div class="form-check form-switch mb-3 mt-4">
                        <input class="form-check-input switch-custom" type="checkbox" id="noiseReductionSwitch" checked>
                        <label class="form-check-label fw-semibold" for="noiseReductionSwitch">
                            Enable Noise Reduction
                        </label>
                    </div>

                    <!-- Sample Text -->
                    <div class="mb-3">
                        <label class="fw-semibold mb-1">Sample Text</label>
                        <input type="text" class="form-control input-custom shadow-sm"
                            placeholder="Enter sample text for testing">
                    </div>

                    <!-- Button -->
                    <div class="text-end mt-4">
                        <button class="btn btn-lg text-white px-4 clone-btn" style="border-radius: 40px">
                            Clone Voice
                        </button>
                    </div>
                </div>

                <!-- Right: Saved Voices -->
                <div class="col-lg-6 col-md-12">
                    <h5 class="fw-bold mb-3 pl-5">Cloned Voices</h5>

                    @for ($i = 1; $i <= 5; $i++)
                        <div class="d-flex align-items-center justify-content-between mb-3 voice-item">
                            <div class="d-flex align-items-center voice-info">
                                <img src="{{ asset('assets/images/profile.png') }}" alt="logo"
                                    class="desktop-logo me-3">
                                <div>
                                    <h6 class="fw-semibold mb-0">Voice {{ $i }}</h6>
                                    <small class="text-muted">English Female</small>
                                </div>
                            </div>
                            <i class="fa-solid fa-trash text-danger fs-5 delete-icon"></i>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <script>
        const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('fileInput');

        uploadArea.addEventListener('click', () => fileInput.click());

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('bg-primary', 'bg-opacity-10');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('bg-primary', 'bg-opacity-10');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('bg-primary', 'bg-opacity-10');
            const file = e.dataTransfer.files[0];
            if (file) {
                uploadArea.innerHTML = `
                <i class="fa-solid fa-file-audio mb-3 upload-icon"></i>
                <p class="fw-semibold text-dark mb-0">${file.name}</p>
                <p class="text-muted small">File ready for upload</p>`;
            }
        });
    </script>
@endsection
