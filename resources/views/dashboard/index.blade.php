@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('body')
    <style>
        .profile-card {
            border: 2px solid rgba(231, 234, 233, 1);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            background: #fff;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid rgba(231, 234, 233, 1);
            object-fit: cover;
            margin-bottom: 12px;
        }

        .profile-card h4 {
            font-weight: bold;
            margin: 0;
            color: #333;
        }

        .profile-card p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        .profile-card hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid rgba(231, 234, 233, 1);
        }

        .profile-info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid rgba(231, 234, 233, 1);
            text-align: left;
        }

        .profile-info-row:last-child {
            border-bottom: none;
        }

        .profile-label {
            font-weight: 600;
            color: #555;
        }

        .profile-value {
            color: #333;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="card custom-card">
                    <div class="row" style="padding: 15px">

                        <!-- Recent Tasks -->
                        <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="card custom-card"
                                style="border-radius:10px; border:2px solid rgba(231, 234, 233, 1);">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <span class="avatar" style="font-size: 30px">
                                            <i class="fas fa-tasks fa-lg" style="color:#003E78;"></i>
                                        </span>
                                        <div class="flex-fill ms-3">
                                            <h5 class="fw-semibold mb-0 lh-1">12</h5>
                                            <p class="mb-0 fs-10 text-muted fw-semibold">Recent Tasks</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Completed Tasks -->
                        <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="card custom-card"
                                style="border-radius:10px; border:2px solid rgba(231, 234, 233, 1);">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <span class="avatar" style="font-size: 30px">
                                            <i class="fas fa-check-circle fa-lg" style="color:#003E78;"></i>
                                        </span>
                                        <div class="flex-fill ms-3">
                                            <h5 class="fw-semibold mb-0 lh-1">8</h5>
                                            <p class="mb-0 fs-10 text-muted fw-semibold">Completed Tasks</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Processing Tasks -->
                        <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="card custom-card"
                                style="border-radius:10px; border:2px solid rgba(231, 234, 233, 1);">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <span class="avatar" style="font-size: 30px">
                                            <i class="fas fa-sync-alt fa-lg" style="color:#003E78;"></i>
                                        </span>
                                        <div class="flex-fill ms-3">
                                            <h5 class="fw-semibold mb-0 lh-1">3</h5>
                                            <p class="mb-0 fs-10 text-muted fw-semibold">Processing Tasks</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Failed Tasks -->
                        <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12 mb-4">
                            <div class="card custom-card"
                                style="border-radius:10px; border:2px solid rgba(231, 234, 233, 1);">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <span class="avatar" style="font-size: 30px">
                                            <i class="fas fa-times-circle fa-lg" style="color:#003E78;"></i>
                                        </span>
                                        <div class="flex-fill ms-3">
                                            <h5 class="fw-semibold mb-0 lh-1">1</h5>
                                            <p class="mb-0 fs-10 text-muted fw-semibold">Failed Tasks</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Table -->
                    <div class="card-header justify-content-between">
                        <h6>Recent Generation</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table text-nowrap table-hover border align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Text Preview</th>
                                        <th scope="col">Voice Used</th>
                                        <th scope="col">Speed/Pitch</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($voices as $voice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @php
                                                $shortText = \Illuminate\Support\Str::words($voice->text, 5, '...');
                                            @endphp

                                            <span class="short-text">{{ $shortText }}</span>
                                            <span class="full-text d-none">{{ $voice->text }}</span>

                                            @if(str_word_count($voice->text) > 5)
                                                <a href="javascript:void(0)" class="read-more text-primary" style="text-decoration: underline;">Read More</a>
                                            @endif
                                        </td>

                                        <td>{{ $voice->voice_name }}</td>
                                        <td>
                                            @php
                                                $settings = json_decode($voice->voice_settings, true);
                                            @endphp

                                            @if($settings)
                                            <p style="margin: 0 !important;">
                                                <strong>Speed:</strong> {{ $settings['speed'] ?? 'N/A' }} / <strong>Stability:</strong> {{ $settings['stability'] ?? 'N/A' }}

                                            </p>
                                            @else
                                                <em>No settings</em>
                                            @endif
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($voice->started_time)->format('d M, Y, h:i A') }}
                                        </td>

                                        <td class="text-center">
                                            <button class="btn btn-sm me-1 download-voice" data-audio="{{ asset($voice->audio_path) }}" style="color: #003E78;">
                                                <i class="fas fa-download"></i>
                                            </button>
                                            <button class="btn btn-sm me-1 play-voice" data-audio="{{ $voice->audio_path }}" style="color: #DBBF4D;">
                                                <i class="fas fa-play"></i>
                                            </button>
                                            <button class="btn btn-sm" id="deleteVoice" data-id="{{ $voice->id }}" style="color: #FF0000;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <button class="btn btn-sm viewVoice" data-bs-toggle="modal" data-bs-target="#taskModal"
                                            data-id="{{ $voice->id }}"
                                                title="View Task" style="background: transparent; border: none;">
                                                <i class="fa-regular fa-eye" style="color: #003E78; font-size: 18px;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                     @endforeach

                                    <!-- more rows -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

        <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 70vw; height: 50vh;">
            <div class="modal-content border-0 shadow-sm rounded-3" style="height: 100%;">
                <!-- Header -->
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark px-3" id="taskModalLabel">Task Details</h5>
                    <button type="button" class="btn-close btn-close-white btn-lg" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <!-- Body -->
                <div class="modal-body">
                    <div class="card border-0 p-4 rounded-3">
                        <!-- Task Information -->
                        <h6 class="fw-bold text-primary mb-3" style="color: #003E78 !important;">Task Information</h6>
                        <div class="row mb-4">
                            <div class="col-md-4 small">
                                <p><strong style="color:#47739E;">Status:</strong><br> <span id="modalStatus"></span></p>
                                {{-- <p>
                                    <strong style="color:#47739E;">Completed:</strong><br>
                                    <span id="modalCompleted"></span>
                                </p> --}}
                                <p><strong style="color:#47739E;">Filename:</strong><br><span id="modalFilename"></span></p>
                                <p><strong style="color:#47739E;">Model ID:</strong><br> <span id="modalModel"></span></p>
                                <p><strong style="color:#47739E;">Languages:</strong><br> <span id="modalLanguage"></span></p>
                            </div>
                            <div class="col-md-4 small">
                               <p>
                                <strong style="color:#47739E;">Created:</strong><br>
                                <span id="modalCreated"></span>
                                {{-- <span class="voice-time" data-time="{{ $voice->started_time }}">Loading...</span> --}}
                                </p>

                                <p><strong style="color:#47739E;">Voice ID:</strong><br> <span id="modalVoiceId"></p>
                                <p><strong style="color:#47739E;">Voice Name:</strong><br> <span id="modalVoiceName"></p>
                                <p><strong style="color:#47739E;">Voice Settings:</strong><br>
                                   <p><strong>Speed:</strong> <span id="modalSpeed"></span> /
                                    <strong>Stability:</strong> <span id="modalStability"></span></p>
                                </p>
                            </div>
                            {{-- <div class="col-md-4 d-grid gap-2">
                                <button class="btn btn-primary btn-lg fw-semibold"
                                    style="background:#003E78; border:none;">Download Audio</button>
                                <button class="btn btn-lg fw-semibold" style="background: #E5EDF5; border:none;">Download
                                    Subtitles (SRT)</button>
                                <button class="btn btn-lg fw-semibold" style="background: #E5EDF5; border:none;">Copy
                                    Text</button>
                                <button class="btn btn-lg fw-semibold" style="background: #E5EDF5; border:none;">Copy
                                    Voice ID</button>
                                <button class="btn btn-lg fw-semibold" style="background: #E5EDF5; border:none;">Copy
                                    Model ID</button>
                            </div> --}}
                            <div class="col-md-4 d-grid gap-2">
    <button id="downloadAudio" class="btn btn-primary btn-lg fw-semibold"
        style="background:#003E78; border:none;">Download Audio</button>

    <button id="downloadSubtitles" class="btn btn-lg fw-semibold"
        style="background: #E5EDF5; border:none;">Download Subtitles (SRT)</button>

    <button id="copyText" class="btn btn-lg fw-semibold"
        style="background: #E5EDF5; border:none;">Copy Text</button>

    <button id="copyVoiceId" class="btn btn-lg fw-semibold"
        style="background: #E5EDF5; border:none;">Copy Voice ID</button>

    <button id="copyModelId" class="btn btn-lg fw-semibold"
        style="background: #E5EDF5; border:none;">Copy Model ID</button>
</div>

                        </div>
                        <!-- Text Content -->
                        <h6 class="fw-bold mb-2" style="color: #003E78;">Text Content</h6>
                        <p class="small text-muted mb-1" id="modalText"></p>
                        <div class="text-end small text-muted mb-3">
                            Character count: <span id="charCount">0</span> |
                            Word count: <span id="wordCount">0</span>
                        </div>
                        <audio id="voicePlayer" controls class="w-100 rounded shadow-sm" style="background: #E5EDF5; height: 45px;">
  <source id="modalAudioSource" src="" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>




                    </div>
                </div>
            </div>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

// DataTable
$(document).ready( function () {
    $('#myTable').DataTable();
} );


    // Download Voice File
$(document).on('click', '.download-voice', function(e){
    e.preventDefault();
    var audioUrl = $(this).data('audio');
    if(!audioUrl){
        alert("No audio file path found!");
        return;
    }
    var a = document.createElement('a');
    a.href = audioUrl;
    a.download = audioUrl.split('/').pop();
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);

})


// Play voice File
$(document).on('click', '.play-voice', function() {
    const button = $(this);
    const audioUrl = button.data('audio'); // must be full URL

    if (!audioUrl) {
        alert("No audio file path found!");
        return;
    }

    if (!button.data('audioObj')) {
        const audio = new Audio(audioUrl);
        button.data('audioObj', audio);

        audio.onended = () => {
            button.find('i').removeClass('fa-pause').addClass('fa-play');
            button.data('playing', false);
        };

        audio.onerror = () => {
            alert('⚠️ Audio file not found or unsupported format.');
            console.error("Audio failed to load:", audioUrl);
            button.find('i').removeClass('fa-pause').addClass('fa-play');
            button.data('playing', false);
        };
    }

    const audio = button.data('audioObj');
    const isPlaying = button.data('playing');

    if (isPlaying) {
        audio.pause();
        button.find('i').removeClass('fa-pause').addClass('fa-play');
    } else {
        audio.play().catch(e => {
            console.error("Audio play blocked:", e);
            alert("⚠️ Audio cannot play. Check console for details.");
        });
        button.find('i').removeClass('fa-play').addClass('fa-pause');
    }

    button.data('playing', !isPlaying);
});


</script>



<script>
$(document).ready(function(){
    $(document).on('click', '#deleteVoice', function(e){
        e.preventDefault();

        var button = $(this);
        var voiceId = button.data('id');

        //  Ask for confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "This voice will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                //  Perform AJAX delete
                $.ajax({
                    url: '/deletedVoice/' + voiceId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Show success popup
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Voice deleted successfully.',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        //  Remove row from table
                        button.closest('tr').fadeOut(500, function(){
                            $(this).remove();
                        });
                    },
                    error: function(xhr) {
                        console.error('AJAX Error:', xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to delete the voice. Please try again.'
                        });
                    }
                });
            }
        });
    });
});
</script>



{{-- Fatch and display voice details in modal --}}
<script>
function formatVoiceTime(utcTime) {
    if (!utcTime) return 'N/A';

    // Laravel returns UTC in ISO format, e.g., "2025-10-29T05:12:00.000000Z"
    // Remove microseconds if present
    utcTime = utcTime.split('.')[0] + 'Z';

    const localDate = new Date(utcTime);
    if (isNaN(localDate)) return 'N/A';

    return localDate.toLocaleString(undefined, {
        year: 'numeric',
        month: 'short',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    });
}


    $(document).ready(function () {
    let currentVoice = null; // store voice data for buttons

    $('.viewVoice').on('click', function () {
        let id = $(this).data('id');
        $('#modalAudioSource').attr('src', '');
        $('#voicePlayer')[0].load();

        // Clear previous data
        $('#modalStatus, #modalCompleted, #modalFilename, #modalModel, #modalLanguage, #modalVoiceId, #modalVoiceName, #modalSpeed, #modalStability, #modalText').text('Loading...');

        $.ajax({
            url: `/fetchVoices/${id}`,
            type: 'GET',
            success: function (response) {
                if (response.success) {
                    let voice = response.data;
                    currentVoice = voice; // store for button actions

                    $('#modalStatus').text(voice.status ?? 'N/A');
                    $('#modalCreated').text(formatVoiceTime(voice.created_at) ?? 'N/A');
                    $('#modalCompleted').text(formatVoiceTime(voice.completed_time) ?? 'N/A');
                    $('#modalFilename').text('document_' + voice.id + '.txt');
                    $('#modalModel').text(voice.model ?? 'N/A');
                    $('#modalLanguage').text(voice.language ?? 'N/A');
                    $('#modalVoiceId').text(voice.api_voice_id ?? 'N/A');
                    $('#modalVoiceName').text(voice.voice_name ?? 'N/A');
                    $('#modalText').text(voice.text ?? '');
                    $('#charCount').text((voice.text ?? '').length);
                    $('#wordCount').text((voice.text ?? '').split(/\s+/).filter(Boolean).length);

                    // Parse settings JSON
                    try {
                        let settings = JSON.parse(voice.voice_settings || '{}');
                        $('#modalSpeed').text(settings.speed ?? 'N/A');
                        $('#modalStability').text(settings.stability ?? 'N/A');
                    } catch {
                        $('#modalSpeed').text('N/A');
                        $('#modalStability').text('N/A');
                    }

                    // Audio load
                    if (voice.audio_path) {
                        let audioPath = `/${voice.audio_path}`;
                        $('#modalAudioSource').attr('src', audioPath);
                        $('#voicePlayer')[0].load();
                    }
                }
            }
        });
    });

    // 🎧 Download Audio
    $('#downloadAudio').on('click', function () {
        if (currentVoice?.audio_path) {
            let url = `/${currentVoice.audio_path}`;
            let a = document.createElement('a');
            a.href = url;
            a.download = currentVoice.audio_path.split('/').pop();
            a.click();
        } else {
            alert('No audio file available.');
        }
    });

    // 📝 Download Subtitles (SRT)
    $('#downloadSubtitles').on('click', function () {
        if (currentVoice?.text) {
            let srt = "1\n00:00:00,000 --> 00:00:05,000\n" + currentVoice.text;
            let blob = new Blob([srt], { type: 'text/plain' });
            let a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = `voice_${currentVoice.id}.srt`;
            a.click();
        } else {
            alert('No text available for subtitles.');
        }
    });

    // 📋 Copy Text
    $('#copyText').on('click', function () {
        if (currentVoice?.text) {
            navigator.clipboard.writeText(currentVoice.text);
            alert('Text copied!');
        }
    });

    // 📋 Copy Voice ID
    $('#copyVoiceId').on('click', function () {
        if (currentVoice?.api_voice_id) {
            navigator.clipboard.writeText(currentVoice.api_voice_id);
            alert('Voice ID copied!');
        }
    });

    // 📋 Copy Model ID
    $('#copyModelId').on('click', function () {
        if (currentVoice?.model) {
            navigator.clipboard.writeText(currentVoice.model);
            alert('Model ID copied!');
        }
    });
});

</script>




{{-- show read-more text --}}
    <script>
$(document).ready(function() {
    $(document).on('click', '.read-more', function() {
        const shortText = $(this).siblings('.short-text');
        const fullText = $(this).siblings('.full-text');

        // Toggle visibility
        if (shortText.hasClass('d-none')) {
            shortText.removeClass('d-none');
            fullText.addClass('d-none');
            $(this).text('Read More');
        } else {
            shortText.addClass('d-none');
            fullText.removeClass('d-none');
            $(this).text('Show Less');
        }
    });
});
</script>


{{-- Show time zone conversion --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.voice-time').forEach(el => {
        const utcDate = new Date(utcTime + ' UTC');
utcDate.setHours(utcDate.getHours() + 5); // add 5 hours for PKT
el.textContent = utcDate.toLocaleString('en-US', {
    year: 'numeric',
    month: 'short',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit'
});

    });
});
</script>


{{-- show character and word count --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const textElement = document.getElementById('textContent');
    const charCountElement = document.getElementById('charCount');
    const wordCountElement = document.getElementById('wordCount');

    if (textElement) {
        // Get text content and trim extra spaces
        const text = textElement.textContent.trim();

        // Calculate character count (excluding spaces)
        const charCount = text.replace(/\s+/g, '').length;

        // Calculate word count (split by spaces)
        const wordCount = text.length ? text.trim().split(/\s+/).length : 0;

        // Display results
        charCountElement.textContent = charCount;
        wordCountElement.textContent = wordCount;
    }
});
</script>

{{-- <script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.voice-time').forEach(el => {
        const utcTime = el.dataset.time;
        if (utcTime) {
            // Convert stored UTC time to local time
            const localDate = new Date(utcTime + ' UTC');
            const formatted = localDate.toLocaleString(undefined, {
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            el.textContent = formatted;
        } else {
            el.textContent = '—'; // fallback if time is null
        }
    });
});
</script> --}}


@endsection
