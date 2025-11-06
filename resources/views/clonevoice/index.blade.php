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
                    <form action="{{ route('addVoiceClone') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 mt-4">
                            <div id="upload-area" class="upload-area text-center">
                                <i class="fa-solid fa-cloud-arrow-up mb-3 upload-icon"></i>
                                <p class="mb-1 fw-semibold text-dark">Drag & drop your audio file here</p>
                                <p class="text-muted small text-center">or click to browse</p>

                                <input type="file" class="d-none" id="fileInput" name="voice_file" accept="audio/*"
                                    required>

                                <!-- This triggers file input click -->
                                <button type="button" class="btn btn-light btn-md"
                                    onclick="document.getElementById('fileInput').click()">Upload</button>
                            </div>
                        </div>

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label class="fw-semibold mb-1">Name</label>
                            <input type="text" name="name" class="form-control input-custom shadow-sm"
                                placeholder="Enter Name" required>
                        </div>

                        <!-- Noise Reduction Switch -->
                        <div class="form-check form-switch mb-3 mt-4">
                            <!-- Hidden input ensures value is sent even when unchecked -->
                            <input type="hidden" name="noise_reduction" value="0">

                            <input class="form-check-input switch-custom" type="checkbox" name="noise_reduction"
                                id="noiseReductionSwitch" value="1" checked>

                            <label class="form-check-label fw-semibold" for="noiseReductionSwitch">
                                Enable Noise Reduction
                            </label>
                        </div>


                        <!-- Sample Text -->
                        <div class="mb-3">
                            <label class="fw-semibold mb-1">Sample Text</label>
                            <input type="text" name="sample_text" class="form-control input-custom shadow-sm"
                                placeholder="Enter sample text for testing">
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-lg text-white px-4 clone-btn" style="border-radius: 40px">
                                Clone Voice
                            </button>
                        </div>
                    </form>

                </div>

                <!-- Right: Saved Voices -->
                <div class="col-lg-6 col-md-12" style="overflow: auto;">
                    <h5 class="fw-bold mb-3 pl-5">Cloned Voices</h5>
@foreach ($VoiceClone as $clone)
    <div class="d-flex align-items-center justify-content-between mb-3 voice-item">
        <div class="d-flex align-items-center voice-info">
            <img src="{{ asset('assets/images/profile.png') }}" alt="logo" class="desktop-logo me-3">
            <div>
                <h6 class="fw-semibold mb-0">{{ $clone->name }}</h6>
                <small class="text-muted">English Female</small>
            </div>
        </div>

        <div class="d-flex align-items-center">
            @php
                $audioSrc = null;
                if ($clone->last_generated_audio) {
                    $audioSrc = $clone->last_generated_audio;
                } elseif ($clone->file_path && Storage::disk('public')->exists($clone->file_path)) {
                    $audioSrc = Storage::url($clone->file_path);
                }

            @endphp

            @if($audioSrc)
                <audio class="voice-audio" src="{{ $audioSrc }}"></audio>
                <button type="button" class="btn btn-light btn-sm me-2 play-btn">
                    <i class="fa fa-play text-success"></i>
                </button>
            @else
                <span class="text-danger">Audio not available</span>
            @endif

            <button type="button" class="btn btn-light btn-sm rounded-circle border delete-btn"
                data-id="{{ $clone->id }}" title="Delete">
                <i class="fa fa-trash text-danger"></i>
            </button>
        </div>
    </div>
@endforeach



                    {{-- @for ($i = 1; $i <= 5; $i++)
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
                    @endfor --}}
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
    <script>
        document.getElementById('fileInput').addEventListener('change', function() {
            const fileName = this.files[0]?.name || "No file chosen";
            document.querySelector('#upload-area p.mb-1').textContent = fileName;
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function(e) {
                e.preventDefault();

                let button = $(this);
                let id = button.data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to recover this voice clone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/cloneVoiceDelete/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1300);
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something went wrong. Please try again.',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>


<script>
    let currentAudio = null;
    let currentBtn = null;

    document.querySelectorAll('.play-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const audio = this.previousElementSibling;
            const icon = this.querySelector('i');

            if (!audio || !audio.src) {
                alert('Audio not available or invalid source.');
                return;
            }

            // Pause the previously playing audio
            if (currentAudio && currentAudio !== audio) {
                currentAudio.pause();
                currentBtn.querySelector('i').classList.remove('fa-pause', 'text-warning');
                currentBtn.querySelector('i').classList.add('fa-play', 'text-success');
            }

            // Toggle play/pause
            if (audio.paused) {
                audio.play().catch(err => {
                    console.error('Playback failed:', err);
                    alert('Audio cannot be played.');
                });
                icon.classList.remove('fa-play', 'text-success');
                icon.classList.add('fa-pause', 'text-warning');
                currentAudio = audio;
                currentBtn = this;
            } else {
                audio.pause();
                icon.classList.remove('fa-pause', 'text-warning');
                icon.classList.add('fa-play', 'text-success');
                currentAudio = null;
                currentBtn = null;
            }

            // Reset icon when audio ends
            audio.onended = () => {
                icon.classList.remove('fa-pause', 'text-warning');
                icon.classList.add('fa-play', 'text-success');
                currentAudio = null;
                currentBtn = null;
            };
        });
    });
</script>


@endsection
