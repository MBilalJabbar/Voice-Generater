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
            justify-content: flex-end;
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

        .play-btn {
            color: #ffffff;
            background-color: #003E78;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .btn-light:hover {
            background-color: #8C52FF;
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
            background: #f1f1f1;
            /* dark overlay */
            border-radius: 50%;
            opacity: 1;
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

        .add-voice-btn i {
            font-size: 16px;
            margin-top: 16px;
        }
    </style>
    <div class="container-fluid mt-4">
        <div class="row  mb-4 hole-container">

            <div class="col-xl-8 col-lg-7 col-md-12 col-sm-12 col-12 mb-3 mb-xl-0 filters-margin-b searchFilter-width" style="width: 50%">
                <div class="card custom-card search-card shadow-sm">
                    <div class="input-group">
                        <span class="input-group-text bg-white" style="padding-right: 0.5rem;">
                            <i class="fa-solid fa-magnifying-glass" style="color:#003E78; font-size: 1rem;"></i>
                        </span>
                        <input type="search" id="searchFilter" class="form-control" placeholder="Search library voices...">
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-5 col-md-12 col-sm-12 col-12 mb-3 mb-xl-0 ">
                <div class="row mb-4">
                    <!-- Trending Dropdown -->
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3 mb-xl-0 filters-margin-b">
                        <div class="card custom-card">
                            <div class="compact-header-btn trending-btn active" style="padding: 17px; cursor:pointer;">
                                <i class="fa-solid fa-chart-line me-2" style="color:#003E78;"></i> Trending
                            </div>
                            <div class="dropdown-menu trending-menu" style="display:none; padding:10px;">
                                <button class="dropdown-item filter-sort" data-sort="trending">Trending</button>
                                <button class="dropdown-item filter-sort" data-sort="created_date">Latest</button>
                                <button class="dropdown-item filter-sort" data-sort="cloned_by_count">Most Users</button>

                            </div>
                        </div>
                    </div>

                    <!-- Filter Dropdown -->
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-3 mb-xl-0 filters-margin-b">
                        <div class="card custom-card">
                            <div class="compact-header-btn filter-btn" style="padding: 17px; cursor:pointer;">
                                <i class="fa-solid fa-filter me-2" style="color:#003E78;"></i> Filter
                            </div>
                            <div class="dropdown-menu filter-menu" style="display:none; padding:10px;">
    <select id="languageFilter" class="form-select mb-2">
        <option value="">All Languages</option>
        <option value="en">English</option>
        <option value="hi">Hindi</option>
        <option value="it">Italian</option>
        <option value="de">German</option>
        <option value="es">Spanish</option>
        <option value="fr">French</option>
        <option value="pl">Polish</option>
        <option value="ru">Russian</option>
        <option value="ar">Arabic</option>
        <option value="pt">Portuguese</option>
        <option value="tr">Turkish</option>
        <option value="nl">Dutch</option>
        <option value="sv">Swedish</option>
        <option value="zh">Chinese</option>
        <option value="ja">Japanese</option>
        <option value="ko">Korean</option>
        <option value="vi">Vietnamese</option>
    </select>

    <select id="genderFilter" class="form-select mb-2">
        <option value="">All Genders</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <select id="ageFilter" class="form-select mb-2">
        <option value="">All Ages</option>
        <option value="young">Young</option>
        <option value="middle">Middle Aged</option>
        <option value="old">Old</option>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    // --- Variables ---
    let currentAudio = null;
    let currentButton = null;
    let currentSort = 'trending';
    let searchDebounceTimer = null;
    const DEBOUNCE_MS = 400;

    const languageMap = {
        en: "English", hi: "Hindi", it: "Italian", de: "German", es: "Spanish",
        fr: "French", pl: "Polish", ru: "Russian", ar: "Arabic", pt: "Portuguese",
        tr: "Turkish", nl: "Dutch", sv: "Swedish", zh: "Chinese", ja: "Japanese",
        ko: "Korean", vi: "Vietnamese"
    };

    // --- Render a single voice card ---
    function renderVoiceCard(voice) {
        const fullLanguage = languageMap[voice.language] || voice.language || 'Unknown';
        const accentText = Array.isArray(voice.accent) ? voice.accent.join(', ') : (voice.accent || 'No accent');
        const audioUrl = voice.sample_audio || voice.audio_url || voice.preview_url || '';
        const imgUrl = voice.cover_url || voice.avatar_url || voice.image_url || '{{ asset("assets/images/Ellipse 22.png") }}';
        const metaLine = `${voice.gender || 'N/A'} • ${voice.age || 'N/A'} • ${fullLanguage} • ${accentText}`;

        return `
<div class="col-xxl-4 col-lg-4 col-md-6 col-sm-12 mb-4 crad-margin-b">
  <div class="card custom-card shadow-sm" style="border-radius:10px; border:2px solid rgba(231,234,233,1); overflow:hidden;">
    <div class="card-body d-flex align-items-center p-3">
      <div style="width:30%;">
        <div class="voice-avatar-wrapper position-relative" style="width:100px; height:100px;">
          <div class="play-overlay d-flex justify-content-center align-items-center">
            <button class="btn btn-light rounded-circle play-btn" data-audio="${audioUrl}" style="width:40px; height:40px;">
              <i class="fa-solid fa-play"></i>
            </button>
          </div>
        </div>
      </div>
      <div style="width:70%;">
        <div class="flex-fill ms-3">
          <h5 class="fw-semibold mb-1 lh-1" style="font-size:1rem;">${voice.voice_name || voice.name || 'Unnamed Voice'}</h5>
          <span class="mt-1 d-flex align-items-center" style="font-size:0.85rem;">${metaLine}</span>
        </div>
        <div class="voice-actions">
          <button type="button" class="btn btn-sm text-dark p-0 me-2 add-voice-btn"
                  data-voice-id="${voice.voice_id || voice.id}"
                  data-voice-name="${voice.voice_name || voice.name}" title="Add">
            <i class="fa-solid fa-plus-circle"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>`;
    }

    // --- Fetch voices via AJAX ---
    function fetchVoices(sort = currentSort) {
        const language = ($('#languageFilter').val() || '').toLowerCase();
        const gender = ($('#genderFilter').val() || '').toLowerCase();
        const age = ($('#ageFilter').val() || '').toLowerCase();
        const search = ($('#searchFilter').val() || '').trim();

        $.ajax({
            url: "{{ route('voices.filter') }}",
            type: "GET",
            data: { language, gender, age, sort, search },
            success: function(res) {
                let html = '';
                if (res && Array.isArray(res.voices) && res.voices.length > 0) {
                    res.voices.forEach(v => html += renderVoiceCard(v));
                } else {
                    html = `<div class="col-12 text-center p-4 text-muted">No voices found</div>`;
                }
                $('#voicesContainer').html(html);
            },
            error: function(err) {
                console.error(err);
                $('#voicesContainer').html('<div class="col-12 text-center p-4 text-danger">Failed to fetch voices</div>');
            }
        });
    }

    // --- Sorting buttons ---
    $(document).on('click', '.filter-sort', function(e) {
        e.stopPropagation();
        currentSort = $(this).data('sort') || 'trending';

        $('.filter-sort').removeClass('active');
        $(this).addClass('active');

        $('.trending-btn').html(`
            <i class="fa-solid fa-chart-line me-2" style="color:#003E78;"></i>
            ${$(this).text()}
            <i class="fa-solid fa-chevron-down ms-2" style="color:#003E78; font-size:0.8rem;"></i>
        `);

        $('.trending-menu').hide();
        fetchVoices(currentSort);
    });

    // --- Apply Filters button ---
    $('#applyFilters').on('click', function(e) {
        e.preventDefault();
        fetchVoices(currentSort);
        $('.filter-menu').hide();
    });

    // --- Search input ---
    $('#searchFilter').on('input', function() {
        clearTimeout(searchDebounceTimer);
        searchDebounceTimer = setTimeout(() => fetchVoices(currentSort), DEBOUNCE_MS);
    });

    $('#searchFilter').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            clearTimeout(searchDebounceTimer);
            fetchVoices(currentSort);
        }
    });

    // --- Audio play/pause ---
    $(document).on('click', '.play-btn', function(e) {
        e.stopPropagation();
        const audioUrl = $(this).data('audio');
        if (!audioUrl) return;

        const btn = $(this);
        if (currentButton === this && currentAudio && !currentAudio.paused) {
            currentAudio.pause();
            btn.html('<i class="fa-solid fa-play"></i>');
            currentAudio = null; currentButton = null;
            return;
        }

        if (currentAudio) {
            currentAudio.pause();
            if (currentButton) $(currentButton).html('<i class="fa-solid fa-play"></i>');
        }

        const audio = new Audio(audioUrl);
        audio.play();
        currentAudio = audio; currentButton = this;
        btn.html('<i class="fa-solid fa-pause"></i>');

        audio.addEventListener('ended', () => {
            btn.html('<i class="fa-solid fa-play"></i>');
            currentAudio = null; currentButton = null;
        });
    });

    // --- Add voice button ---
    $(document).on('click', '.add-voice-btn', function(e) {
        e.stopPropagation();
        const voiceId = $(this).data('voice-id');
        const voiceName = $(this).data('voice-name');
        if (!voiceId || !voiceName) return alert('Voice data missing!');
        window.location.href = "/genrate-audio?voice_id=" + voiceId + "&voice_name=" + encodeURIComponent(voiceName);
    });

    // --- Dropdown toggles ---
    $('.trending-btn').on('click', function(e) {
        e.stopPropagation();
        $('.trending-menu').toggle();
        $('.filter-menu').hide();
    });

    $('.filter-btn').on('click', function(e) {
        e.stopPropagation();
        $('.filter-menu').toggle();
        $('.trending-menu').hide();
    });

    // --- Prevent closing filter menu when clicking inside it ---
    $('.filter-menu').on('click', function(e) {
        e.stopPropagation();
    });

    // --- Click outside closes dropdowns ---
    $(document).on('click', function() {
        $('.trending-menu, .filter-menu').hide();
    });

    // --- Initial load ---
    fetchVoices(currentSort);
});
</script>

@endsection
