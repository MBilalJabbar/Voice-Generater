@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('body')
    <style>
        /* Updated avatar style for a cleaner look */
        .avatar {
            display: inline-block;
            width: 100%;
            /* Set a specific width */
            height: 100%;
            /* Set a specific height */
            overflow: hidden;
            /* Ensure image doesn't bleed */
            border-radius: .5rem;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: inherit;
        }

        /* Style for the voice detail text */
        .voice-meta {
            font-size: 0.85rem;
            color: #6c757d;
            /* text-muted */
            font-weight: 500;
            /* fw-semibold */
            line-height: 1.2;
        }

        .voice-meta span {
            margin-right: 0.5rem;
            display: inline-flex;
            /* Use flex to align items vertically */
            align-items: center;
            /* Center items vertically */
        }

        .voice-meta img {
            vertical-align: middle;
            /* Align image with text */
        }

        .voice-actions {
            display: flex;
            align-items: center;
            margin-left: auto;
            /* Push actions to the right */
        }

        .voice-actions button {
            background: none;
            border: none;
            padding: 0 0.25rem;
            color: #343a40;
            /* dark color for icons */
            font-size: 1.25rem;
        }

        .voice-actions button:hover {
            color: #003E78;
            /* hover effect */
        }

        /* Specific styles for the search bar card and input */
        .card.search-card {
            padding: 0.5rem !important;
            /* Reduced padding on the card */
        }

        .card.search-card .input-group-text,
        .card.search-card .form-control {
            border: none;
            /* Remove borders from search input group */
            padding: 0.5rem 0.75rem;
            /* Adjusted padding */
            height: auto;
            /* Reset height */
        }

        /* New style for smaller Trending/Filter buttons */
        .compact-header-btn {
            padding: 0.5rem 1rem;
            /* Reduced padding for smaller size */
            font-size: 0.9rem;
            /* Smaller font size */
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 20px;
        }

        /* Active/Selected button style (Trending) */
        .trending-btn.active {
            background-color: #ffffff;
            color: #003E78;
        }

        /* Default style for Filter button */
        .filter-btn {
            background-color: #ffffff;
            color: #343a40;
            /* border: 1px solid #e7eaec; */
        }

        .voice-avatar-wrapper:hover .play-overlay {
            opacity: 1;
        }

        .play-btn i {
            font-size: 18px;
        }

        .voice-avatar-wrapper {
            position: relative;
            display: inline-block;
            border-radius: 50%;
            overflow: hidden;
            /* ensures overlay stays inside circle */
        }

        .voice-avatar-wrapper .play-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            /* dark overlay */
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
            /* ensures overlay is above image */
        }

        .voice-avatar-wrapper:hover .play-overlay {
            opacity: 1;
        }

        .play-btn i {
            font-size: 18px;
        }
    </style>
    <div class="container-fluid mt-4">
        <div class="row  mb-4">

            <div class="col-xl-8 col-lg-7 col-md-12 col-sm-12 col-12 mb-3 mb-xl-0" style="width: 50%">
                <div class="card custom-card search-card shadow-sm">
                    <div class="input-group">
                        <span class="input-group-text bg-white" style="padding-right: 0.5rem;">
                            <i class="fa-solid fa-magnifying-glass" style="color:#003E78; font-size: 1rem;"></i>
                        </span>
                        <input type="search" class="form-control" placeholder="Search library voices...">
                    </div>
                </div>
            </div>

    <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12 col-12 mb-3 mb-xl-0">
         <div class="row mb-4">
    <!-- Trending Dropdown -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3 mb-xl-0">
        <div class="card custom-card">
            <div class="compact-header-btn trending-btn active" style="padding: 17px; cursor:pointer;">
                <i class="fa-solid fa-chart-line me-2" style="color:#003E78;"></i> Trending
            </div>
            <div class="dropdown-menu trending-menu" style="display:none; padding:10px;">
                <button class="dropdown-item filter-sort" data-sort="trending">Trending</button>
                <button class="dropdown-item filter-sort" data-sort="latest">Latest</button>
                <button class="dropdown-item filter-sort" data-sort="mostusers">Most Users</button>
            </div>
        </div>
    </div>

    <!-- Filter Dropdown -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3 mb-xl-0">
        <div class="card custom-card">
            <div class="compact-header-btn filter-btn" style="padding: 17px; cursor:pointer;">
                <i class="fa-solid fa-filter me-2" style="color:#003E78;"></i> Filter
            </div>
            <div class="dropdown-menu filter-menu" style="display:none; padding:10px;">
                <select id="languageFilter" class="form-select mb-2">
                    <option value="">All Languages</option>
                    <option value="en">English</option>
                    <option value="vi">Vietnamese</option>
                    <option value="French">French</option>
                    <option value="Spanish">Spanish</option>
                    <option value="Japanese">Japanese</option>
                    <!-- Add as many as supported by API -->
                </select>

                </select>
                <select id="genderFilter" class="form-select mb-2">
                    <option value="">All Genders</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <button id="applyFilters" class="btn btn-primary w-100">Apply</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Voices Container -->

<h3 style="font-size: 1.5rem; font-weight:600; margin-bottom: 1.5rem;">Trending Voices</h3>
<div id="voicesContainer" class="row"></div>


            {{-- <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-6 mb-3 mb-xl-0">
                <div class="card custom-card">
                    <div class="compact-header-btn filter-btn" style="padding: 17px">
                        <i class="fa-solid fa-clone me-2" style="color:#003E78;"></i> Cloned Voice
                    </div>
                </div>
            </div> --}}


        </div>






    </div>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentAudio = null;
            let currentButton = null;

            document.querySelectorAll('.play-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const audioUrl = this.dataset.audio;
                    if (!audioUrl) {
                        alert('No sample audio available for this voice.');
                        return;
                    }

                    // If this button is already playing, pause it
                    if (currentButton === this && currentAudio && !currentAudio.paused) {
                        currentAudio.pause();
                        this.innerHTML = '<i class="fa-solid fa-play"></i>';
                        return;
                    }

                    // Stop currently playing audio (if any)
                    if (currentAudio) {
                        currentAudio.pause();
                        if (currentButton) {
                            currentButton.innerHTML = '<i class="fa-solid fa-play"></i>';
                        }
                    }

                    // Play new audio
                    const audio = new Audio(audioUrl);
                    audio.play();

                    // Update references
                    currentAudio = audio;
                    currentButton = this;

                    // Change icon to pause
                    this.innerHTML = '<i class="fa-solid fa-pause"></i>';

                    // When audio ends → revert icon to play
                    audio.addEventListener('ended', () => {
                        this.innerHTML = '<i class="fa-solid fa-play"></i>';
                        currentAudio = null;
                        currentButton = null;
                    });
                });
            });
        });
    </script> --}}

    <script>
        let currentAudio = null;
let currentButton = null;

$(document).on('click', '.play-btn', function() {
    const audioUrl = $(this).data('audio');
    if (!audioUrl) {
        alert('No sample audio available for this voice.');
        return;
    }

    // If the same button is already playing, pause it
    if (currentButton === $(this)[0] && currentAudio && !currentAudio.paused) {
        currentAudio.pause();
        $(this).html('<i class="fa-solid fa-play"></i>');
        currentAudio = null;
        currentButton = null;
        return;
    }

    // Stop currently playing audio (if any)
    if (currentAudio) {
        currentAudio.pause();
        if (currentButton) $(currentButton).html('<i class="fa-solid fa-play"></i>');
    }

    // Play new audio
    const audio = new Audio(audioUrl);
    audio.play();

    currentAudio = audio;
    currentButton = $(this)[0];
    $(this).html('<i class="fa-solid fa-pause"></i>');

    // When audio ends → revert icon
    audio.addEventListener('ended', () => {
        $(this).html('<i class="fa-solid fa-play"></i>');
        currentAudio = null;
        currentButton = null;
    });
});

    </script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Toggle dropdowns
    $('.trending-btn').on('click', function() {
        $('.trending-menu').toggle();
        $('.filter-menu').hide();
    });

    $('.filter-btn').on('click', function() {
        $('.filter-menu').toggle();
        $('.trending-menu').hide();
    });

    // Sort handler
    $('.filter-sort').on('click', function() {
        let sort = $(this).data('sort');
        fetchVoices(sort);
    });

    // Apply filter button
    $('#applyFilters').on('click', function() {
        fetchVoices();
        $('.filter-menu').hide(); // hide dropdown after applying
    });

    // Fetch voices function
    function fetchVoices(sort = 'trending') {
let language = $('#languageFilter').val();
if(language) {
    // Convert to full proper name if needed
    if(language.toLowerCase() === 'en') language = 'English';
    if(language.toLowerCase() === 'vi') language = 'Vietnamese';
    if(language.toLowerCase() === 'French') language = 'French';
    if(language.toLowerCase() === 'Spanish') language = 'Spanish';
    if(language.toLowerCase() === 'Japanese') language = 'Japanese';
}

let gender = $('#genderFilter').val();
if(gender) {
    gender = gender.charAt(0).toUpperCase() + gender.slice(1); // Female / Male
}


        $.ajax({
            url: "{{ route('voices.filter') }}",
            type: "GET",
            data: { language: language, gender: gender, sort: sort },
            success: function(res){
                let html = '';
                if(res.voices.length > 0){
                    res.voices.forEach(voice => {
                        html += `
                        <div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card custom-card shadow-sm"
                                style="border-radius:10px; border:2px solid rgba(231, 234, 233, 1); overflow:hidden;">
                                <div class="card-body d-flex align-items-center p-3">
                                    <div class="voice-avatar-wrapper position-relative" style="width:100px; height:100px;">
                                        <img src="${voice.cover_url ?? '{{ asset('assets/images/default.png') }}'}"
                                            alt="Voice Profile" class="voice-avatar rounded-circle"
                                            style="width:100%; height:100%; object-fit:cover; border:2px solid #ddd;">
                                        <div class="play-overlay d-flex justify-content-center align-items-center">
                                            <button class="btn btn-light rounded-circle play-btn"
                                                data-audio="${voice.sample_audio ?? ''}" style="width:40px; height:40px;">
                                                <i class="fa-solid fa-play"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="flex-fill ms-3">
                                        <h5 class="fw-semibold mb-1 lh-1" style="font-size: 1rem;">
                                            ${voice.voice_name ?? 'Unnamed Voice'}
                                        </h5>
                                        <div class="voice-meta d-flex flex-column">
                                            <span>${(voice.tag_list ?? []).join(', ')}</span>
                                            <span class="mt-1 d-flex align-items-center">
                                                <img src="{{ asset('assets/images/Ellipse 32.png') }}" alt="Country Flag 1"
                                                    style="width: 15px; height: 15px; margin-right: 3px;">
                                                <img src="{{ asset('assets/images/Ellipse 33.png') }}" alt="Country Flag 2"
                                                    style="width: 15px; height: 15px; margin-right: 5px;">
                                                ${voice.language ?? 'English'} +${voice.voice_count ?? 0}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="voice-actions">
                                        <button type="button" class="btn btn-sm text-dark p-0 me-2" title="Add">
                                            <i class="fa-solid fa-plus-circle"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm text-dark p-0" title="More Options">
                                            <i class="fa-solid fa-ellipsis-h"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>`;
                    });
                } else {
                    html = '<p class="text-center">No voices found</p>';
                }
                $('#voicesContainer').html(html);
            },
            error: function(err){
                alert('Failed to fetch voices');
            }
        });
    }

    // Initial load
    fetchVoices();

    // Optional: play audio
    $(document).on('click', '.play-btn', function(){
        let audioSrc = $(this).data('audio');
        if(audioSrc){
            let audio = new Audio(audioSrc);
            audio.play();
        }
    });

});
</script>




@endsection
