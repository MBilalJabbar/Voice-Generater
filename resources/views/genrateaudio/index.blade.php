@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('body')
    <style>
        .slider-short {
            width: 100%;
            height: 8px;
        }

        .slider-short::-webkit-slider-thumb {
            height: 16px;
            width: 16px;
        }

        .slider-short::-moz-range-thumb {
            height: 16px;
            width: 16px;
        }

        input[type=range] {
            -webkit-appearance: none;
            width: 100%;
            height: 4px;
            background: #ddd;
            border-radius: 5px;
            outline: none;
        }

        input[type=range]::-webkit-slider-runnable-track {
            height: 4px;
            background: #ddd;
            border-radius: 5px;
        }

        input[type=range]::-webkit-slider-runnable-track {
            background: linear-gradient(to right, #003E78 0%, #003E78 var(--value, 50%), #ddd var(--value, 50%), #ddd 100%);
        }

        input[type=range]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            background: #fff;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            margin-top: -6px;
            position: relative;
            z-index: 2;
        }

        input[type=range]::-moz-range-track {
            height: 4px;
            background: #ddd;
            border-radius: 5px;
        }

        input[type=range]::-moz-range-progress {
            height: 4px;
            background: #003E78;
            border-radius: 5px;
        }

        input[type=range]::-moz-range-thumb {
            width: 16px;
            height: 16px;
            background: #fff;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        .voice-sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }

        .voice-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 400px;
            height: 100%;
            background-color: #fff;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1050;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            padding: 20px;
            overflow-y: auto;
        }

        .voice-sidebar.open {
            transform: translateX(0);
        }

        .voice-list-item {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }

        .voice-list-item:hover {
            background-color: #f7f7f7;
        }

        .voice-list-item img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .voice-list-item .voice-info {
            flex-grow: 1;
        }

        .voice-list-item .voice-info h6 {
            margin: 0;
            font-weight: bold;
            color: #003E78;
        }

        .voice-list-item .voice-info small {
            color: #6c757d;
        }

        .voice-list-item .voice-play-icon {
            color: #003E78;
            font-size: 1.2rem;
            margin-right: 10px;
        }

        /* Custom Styles for Input/Select Height and Select Down Icon */
        .form-control,
        select.form-control {
            min-height: 40px;
            /* Increased height for better look */
            padding: .375rem .75rem;
            /* Standard Bootstrap padding */
        }

        .input-group>.form-control {
            border-right: none;
        }

        /* Styling for the custom select dropdown icon */
        .custom-select-wrapper {
            position: relative;
        }

        .custom-select-wrapper select.form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 2.5rem;
            /* Make space for the icon */
            background-image: none;
            /* Remove default browser arrow */
        }

        .custom-select-wrapper .select-icon {
            position: absolute;
            top: 65%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
            /* Make sure clicks go to the select element */
            color: #495057;
            /* Icon color */
        }
    </style>

    <div class="voice-sidebar-overlay" id="voice-sidebar-overlay"></div>

    <div class="voice-sidebar" id="voice-sidebar">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Select Voice</h4>
            <button type="button" class="close btn btn-link" id="close-voice-sidebar" aria-label="Close"
                style="font-size: 1.5rem; text-decoration: none; color: #333;">
                &times;
            </button>
        </div>

        <div class="mb-3">
            <input type="search" class="form-control" placeholder="Search Voices...">
        </div>

        <div class="form-group mb-3 custom-select-wrapper">
            <label for="best-voices">Best Voices for V3</label>
            <select id="best-voices" class="form-control form-control-sm">
                <option selected>V3</option>
                <option>V4</option>
            </select>
            <i class="fa-solid fa-caret-down select-icon"></i>
        </div>

        <div class="voice-list">
            <div class="voice-list-item">
                <img src="{{ asset('assets/images/profile.png') }}" alt="Voice Avatar">
                <div class="voice-info">
                    <h6>James - Husky & Engaging</h6>
                    <small>A slightly husky and bassy voice with a...</small>
                </div>
                <i class="fa-solid fa-play voice-play-icon"></i>
                <i class="fa-solid fa-bars mr-3"></i>
            </div>
            <div class="voice-list-item">
                <img src="{{ asset('assets/images/profile.png') }}" alt="Voice Avatar">
                <div class="voice-info">
                    <h6>James - Husky & Engaging</h6>
                    <small>A slightly husky and bassy voice with a...</small>
                </div>
                <i class="fa-solid fa-play voice-play-icon"></i>
                <i class="fa-solid fa-bars mr-3"></i>

            </div>
            <div class="voice-list-item">
                <img src="{{ asset('assets/images/profile.png') }}" alt="Voice Avatar">
                <div class="voice-info">
                    <h6>James - Husky & Engaging</h6>
                    <small>A slightly husky and bassy voice with a...</small>
                </div>
                <i class="fa-solid fa-play voice-play-icon"></i>
                <i class="fa-solid fa-bars mr-3"></i>

            </div>
        </div>
    </div>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 mb-4">
                <div class="card shadow-sm p-4" style="border-radius:10px; border:2px solid rgba(231, 234, 233, 1);">
                    <textarea name="user_text" id="user_text" cols="90" rows="20" class="form-control mb-3">Loreum Ipsum</textarea>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div id="text-info">
                            <span id="char-count">0</span> Characters, <span id="word-count">0</span> Words
                        </div>
                        <button class="btn  btn-sm text-white" id="upload-audio"
                            style="background: rgba(0, 62, 120, 1); border-radius: 20px; padding: 0.5rem 1rem;">
                            <i class="fa-solid fa-upload mr-2"></i> Upload File
                        </button>
                    </div>

                    <div id="audio-container"></div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card shadow-sm p-4" style="border-radius:12px; border:2px solid rgba(231, 234, 233, 1);">
                    <div class="mb-4">
                        <h5 class="d-flex align-items-center mb-3">
                            <i class="fa-solid fa-sliders" style="color: #003E78;"></i>
                            <span style="padding-left: 8px;">Voice Model Selection</span>
                        </h5>
                        <!-- Normal Voice -->
                        <div class="form-group mb-3">
                            <label>Voice*</label>
                            <div class="input-group">
                                <input type="text" class="form-control voice-input" data-type="normal"
                                    value="Select Voice" readonly style="cursor: pointer;">
                                <button class="btn btn-outline-secondary voice-trigger" data-type="normal" type="button">
                                    <i class="fa-solid fa-caret-down"></i>
                                </button>
                            </div>
                            <input type="hidden" name="voice_name" class="voice-name">
                            <input type="hidden" name="voice_id" class="voice-id" value="">
                            {{-- <input type="hidden" class="voice-id" value=""> --}}
                        </div>

                        <!-- Clone Voice -->
                        @php
                            $userVoices = \App\Models\VoiceClone::where('user_id', Auth::id())->get();
                        @endphp

                        @if ($userVoices->count() > 0)
                            <div class="form-group mb-3">
                                <label>Clone Voices*</label>
                                <div class="input-group">
                                    <input type="text" class="form-control voice-input" data-type="clone"
                                        value="Select Clone Voice" readonly style="cursor: pointer;">
                                    <button class="btn btn-outline-secondary voice-trigger" data-type="clone"
                                        type="button">
                                        <i class="fa-solid fa-caret-down"></i>
                                    </button>
                                </div>
                                <input type="hidden" class="voice-name" value="">
                                <input type="hidden" class="voice-id" value="">
                            </div>
                        @endif


                        <div class="form-group mb-3 custom-select-wrapper">
                            <label for="model">Model*</label>
                            <select id="model" class="form-control" name="model">
                                <option value="Multilingual v2">Multilingual v2</option>
                                <option value="Turbo v2.5">Turbo v2.5</option>
                                <option value="Flash v2.5">Flash v2.5</option>
                                <option value="v3 (alpha - unstable)">v3 (alpha - unstable)</option>
                            </select>
                            <i class="fa-solid fa-caret-down select-icon"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="d-flex mb-3">
                            <i class="fa-solid fa-sliders mr-3" style="color: #003E78;"></i>
                            <span style="padding-left: 8px;"> Voice Settings</span>
                        </h5>

                        <div class="form-group mb-3">
                            <label for="speed">Speed: <span id="speed-value">1x</span></label>
                            <input type="range" class="form-control-range slider-short" id="speed" min="0.5"
                                max="2" step="0.1" value="1" class="slider-short">
                        </div>

                        <div class="form-group mb-3">
                            <label for="style">Style: <span id="style-value">50</span></label>
                            <input type="range" class="form-control-range slider-short" id="style" min="0"
                                max="100" step="1" value="50">
                        </div>

                        <div class="form-group mb-3">
                            <label for="similarity">Similarity: <span id="similarity-value">70</span></label>
                            <input type="range" class="form-control-range slider-short" id="similarity" min="0"
                                max="100" step="1" value="70">
                        </div>

                        <div class="form-group mb-3">
                            <label for="stability">Stability: <span id="stability-value">80</span></label>
                            <input type="range" class="form-control-range slider-short" id="stability" min="0"
                                max="100" step="1" value="80">
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="boost-audio-switch">Speaker Boost
                            {{-- <label class="form-check-label" for="boost-audio-switch"></label> --}}
                        </div>

                        <div class="text-end mt-4">
                            <button class="btn btn-sm text-white" id="generate-audio"
                                style="background: rgba(0, 62, 120, 1); border-radius: 15px; padding: 0.4rem 0.8rem;">
                                <i class="fa-solid fa-microphone me-2"></i> Generate Audio
                            </button>

                            <button class="btn btn-sm text-white" id="download-audio"
                                style="background: #28a745; border-radius: 15px; padding: 0.4rem 0.8rem;">
                                <i class="fa-solid fa-download me-2"></i> Download Audio
                            </button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const voiceId = urlParams.get("voice_id");
    const voiceName = urlParams.get("voice_name");

    if (voiceId && voiceName) {
        // Find the correct form group
        const formGroup = $(".voice-input[data-type='normal']").closest('.form-group');

        // Update visible input
        formGroup.find(".voice-input[data-type='normal']").val(voiceName).addClass("active");

        // Update hidden fields
        formGroup.find(".voice-id").val(voiceId);
        formGroup.find(".voice-name").val(voiceName);
    }
});

</script>


    {{-- Fatch Voices --}}
    <img id="default-voice-avatar" src="{{ asset('assets/images/profile.png') }}" style="display:none;"
        alt="default avatar">

    <script>
        (() => {
            const overlay = document.getElementById('voice-sidebar-overlay');
            const sidebar = document.getElementById('voice-sidebar');
            const voiceList = document.querySelector('.voice-list');
            const defaultAvatarEl = document.getElementById('default-voice-avatar');
            const DEFAULT_AVATAR = defaultAvatarEl?.src || '/assets/images/profile.png';

            let voicesCache = null;
            let cloneVoicesCache = null;
            let isLoading = false;
            let currentAudio = null;
            let activeInput = null;
            let activeType = 'normal'; // 'normal' or 'clone'

            function openSidebar() {
                overlay.style.display = 'block';
                sidebar.classList.add('open');
            }

            function closeSidebar() {
                sidebar.classList.remove('open');
                setTimeout(() => {
                    overlay.style.display = 'none';
                }, 300);
            }

            function setLoadingState(state) {
                isLoading = state;
            }

            function showMessage(html) {
                voiceList.innerHTML = `<p style="padding:1rem;margin:0;text-align:center;">${html}</p>`;
            }

            function createVoiceItem(voice) {
                const item = document.createElement('div');
                item.className = 'voice-list-item';

                const avatar = voice.avatar_url || DEFAULT_AVATAR;
                const name = escapeHtml(voice.name || 'Unknown Voice');
                const category = escapeHtml(voice.category || 'General Voice');
                const preview = voice.preview_url || '';

                item.innerHTML = `
      <img src="${avatar}" alt="Voice Avatar" onerror="this.src='${DEFAULT_AVATAR}'">
      <div class="voice-info">
        <h6>${name}</h6>
        <small>${category}</small>
      </div>
      <div class="voice-actions">
        <i class="fa-solid fa-play voice-play-icon" data-preview="${preview}" title="Play Preview"></i>
      </div>
    `;

                // Select voice
                item.addEventListener('click', (e) => {
                    if (e.target.closest('.voice-play-icon')) return;
                    if (!activeInput) return;

                    const wrapper = activeInput.closest('.form-group');
                    const formControl = wrapper.querySelector('.form-control');
                    const voiceIdInput = wrapper.querySelector('.voice-id');

                    if (formControl) {
                        formControl.value = voice.name;
                        document.querySelectorAll('.voice-input').forEach(i => i.classList.remove(
                            'active')); // remove previous
                        formControl.classList.add('active'); // mark selected as active
                    }
                    if (voiceIdInput) voiceIdInput.value = voice.voice_id || voice.id || '';

                    closeSidebar();

                });

                // Play preview
                const playIcon = item.querySelector('.voice-play-icon');
                playIcon.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const previewUrl = playIcon.dataset.preview;
                    if (!previewUrl) {
                        console.log('No preview URL available for this voice');
                        return;
                    }

                    // Toggle play/pause
                    if (currentAudio && !currentAudio.paused) {
                        currentAudio.pause();
                        playIcon.className = 'fa-solid fa-play voice-play-icon';
                    } else {
                        if (currentAudio) currentAudio.pause();

                        // Reset all play icons
                        document.querySelectorAll('.voice-play-icon').forEach(icon => {
                            icon.className = 'fa-solid fa-play voice-play-icon';
                        });

                        currentAudio = new Audio(previewUrl);
                        currentAudio.play()
                            .then(() => {
                                playIcon.className = 'fa-solid fa-pause voice-play-icon';
                            })
                            .catch(err => {
                                console.warn('Preview failed to play:', err);
                                playIcon.className = 'fa-solid fa-play voice-play-icon';
                            });

                        currentAudio.onended = () => {
                            playIcon.className = 'fa-solid fa-play voice-play-icon';
                        };
                    }
                });

                return item;
            }

            async function fetchVoices(type) {
                let cache = type === 'clone' ? cloneVoicesCache : voicesCache;
                if (cache) {
                    console.log(`Using cached ${type} voices:`, cache);
                    return cache;
                }

                const endpoint = type === 'clone' ? '/clone-voices' : '/voices-genai';
                console.log(`Fetching ${type} voices from:`, endpoint);

                setLoadingState(true);
                showMessage('Loading voices...');

                try {
                    const controller = new AbortController();
                    const timeout = setTimeout(() => controller.abort(), 10000);
                    const res = await fetch(endpoint, {
                        signal: controller.signal
                    });
                    clearTimeout(timeout);

                    console.log(`Response status for ${type}:`, res.status);

                    if (!res.ok) throw new Error(`HTTP ${res.status}`);
                    const data = await res.json();

                    console.log(`Raw API response for ${type}:`, data);

                    let voices = [];
                    if (Array.isArray(data)) {
                        voices = data;
                    } else if (data.voices && Array.isArray(data.voices)) {
                        voices = data.voices;
                    } else if (data.data && Array.isArray(data.data)) {
                        voices = data.data;
                    } else {
                        // If no array found, try to extract any potential voice data
                        voices = Object.values(data).find(val => Array.isArray(val)) || [];
                    }

                    console.log(`Processed voices for ${type}:`, voices);

                    if (type === 'clone') {
                        cloneVoicesCache = voices;
                    } else {
                        voicesCache = voices;
                    }

                    return voices;
                } catch (err) {
                    console.error(`Error fetching ${type} voices:`, err);
                    throw err;
                } finally {
                    setLoadingState(false);
                }
            }

            async function openAndLoadVoices(inputEl, type) {
                if (isLoading) {
                    console.log('Already loading voices, please wait...');
                    return;
                }

                activeInput = inputEl;
                activeType = type;
                console.log(`Opening sidebar for ${type} voices, activeInput:`, activeInput);

                openSidebar();

                let cache = type === 'clone' ? cloneVoicesCache : voicesCache;
                if (cache && cache.length > 0) {
                    console.log(`Rendering cached ${type} voices:`, cache);
                    renderVoiceList(cache);
                    return;
                }

                try {
                    const voices = await fetchVoices(type);
                    console.log(`Fetched ${voices?.length} ${type} voices:`, voices);

                    if (!voices || voices.length === 0) {
                        showMessage('No voices found. Please check if your account has access to voice cloning.');
                        return;
                    }
                    renderVoiceList(voices);
                } catch (err) {
                    console.error(`Failed to load ${type} voices:`, err);
                    showMessage(`Error loading ${type} voices. Please check the console for details.`);
                }
            }

            function renderVoiceList(voices) {
                voiceList.innerHTML = '';

                if (!voices || voices.length === 0) {
                    showMessage('No voices available.');
                    return;
                }

                const fragment = document.createDocumentFragment();
                voices.forEach((v, index) => {
                    const voiceItem = createVoiceItem(v);
                    fragment.appendChild(voiceItem);
                });
                voiceList.appendChild(fragment);

                console.log(`Rendered ${voices.length} voice items`);
            }

            function escapeHtml(str) {
                if (str === null || str === undefined) return '';
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            // ✅ FIXED: Better event listener attachment
            function initializeEventListeners() {
                // For voice input fields
                document.querySelectorAll('.voice-input').forEach(el => {
                    el.addEventListener('click', (e) => {
                        const type = el.dataset.type || 'normal';
                        console.log('Voice input clicked, type:', type);
                        openAndLoadVoices(el, type);
                    });
                });

                // For voice trigger buttons
                document.querySelectorAll('.voice-trigger').forEach(el => {
                    el.addEventListener('click', (e) => {
                        const type = el.dataset.type || 'normal';
                        console.log('Voice trigger clicked, type:', type);

                        // Find the corresponding input field in the same form-group
                        const formGroup = el.closest('.form-group');
                        const inputField = formGroup?.querySelector('.voice-input');

                        if (inputField) {
                            openAndLoadVoices(inputField, type);
                        } else {
                            console.error('Could not find corresponding voice input field');
                        }
                    });
                });

                // Close sidebar events
                const closeBtn = document.getElementById('close-voice-sidebar');
                if (closeBtn) {
                    closeBtn.addEventListener('click', closeSidebar);
                } else {
                    console.error('Close voice sidebar button not found');
                }

                if (overlay) {
                    overlay.addEventListener('click', closeSidebar);
                }
            }

            // Initialize when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initializeEventListeners);
            } else {
                initializeEventListeners();
            }

            // Clean up audio on page unload
            window.addEventListener('beforeunload', () => {
                if (currentAudio) {
                    currentAudio.pause();
                    currentAudio = null;
                }
            });

            // Make functions available globally for debugging
            window.voiceManager = {
                clearCache: () => {
                    voicesCache = null;
                    cloneVoicesCache = null;
                    console.log('Voice caches cleared');
                },
                getCache: () => ({
                    normal: voicesCache,
                    clone: cloneVoicesCache
                })
            };
        })();


        // ✅ Filter voices by search input
        const searchInput = document.querySelector('#voice-sidebar input[type="search"]');
        if (searchInput) {
            searchInput.addEventListener('input', () => {
                const query = searchInput.value.toLowerCase();

                document.querySelectorAll('.voice-list-item').forEach(item => {
                    const name = item.querySelector('.voice-info h6')?.textContent.toLowerCase() || '';
                    const category = item.querySelector('.voice-info small')?.textContent.toLowerCase() || '';

                    if (name.includes(query) || category.includes(query)) {
                        item.style.display = ''; // show
                    } else {
                        item.style.display = 'none'; // hide
                    }
                });
            });
        }

    </script>





    {{-- Generate voices  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll("input[type=range]").forEach(slider => {
            function updateTrack() {
                let value = (slider.value - slider.min) / (slider.max - slider.min) * 100;
                slider.style.setProperty('--value', value + '%');
            }
            slider.addEventListener('input', updateTrack);
            updateTrack();
        });

        const speed = document.getElementById('speed');
        const style = document.getElementById('style');
        const similarity = document.getElementById('similarity');
        const stability = document.getElementById('stability');

        const speedValue = document.getElementById('speed-value');
        const styleValue = document.getElementById('style-value');
        const similarityValue = document.getElementById('similarity-value');
        const stabilityValue = document.getElementById('stability-value');

        speedValue.textContent = speed.value + 'x';
        styleValue.textContent = style.value;
        similarityValue.textContent = similarity.value;
        stabilityValue.textContent = stability.value;

        speed.addEventListener('input', () => speedValue.textContent = speed.value + 'x');
        style.addEventListener('input', () => styleValue.textContent = style.value);
        similarity.addEventListener('input', () => similarityValue.textContent = similarity.value);
        stability.addEventListener('input', () => stabilityValue.textContent = stability.value);
    </script>
    <div id="audio-container"></div>

    <script>
$(document).ready(function() {
    let currentAudioUrl = null;

    // 🎚 Slider style update
    $("input[type=range]").each(function() {
        let slider = $(this);

        function updateTrack() {
            let value = (slider.val() - slider.attr("min")) / (slider.attr("max") - slider.attr("min")) * 100;
            slider.css("background", `linear-gradient(to right, #003E78 ${value}%, #E7EAE9 ${value}%)`);
        }

        slider.on("input", updateTrack);
        updateTrack();
    });

    // 🎚 Display slider values
    function updateLabels() {
        $("#speed-value").text($("#speed").val() + 'x');
        $("#style-value").text($("#style").val());
        $("#similarity-value").text($("#similarity").val());
        $("#stability-value").text($("#stability").val());
    }

    $("input[type=range]").on("input", updateLabels);
    updateLabels();

    // 🎯 Update text info (char/word count)
    function updateTextInfo() {
        let text = $("#user_text").val();
        let charCount = text.length;
        let wordCount = text.trim() === "" ? 0 : text.trim().split(/\s+/).length;
        $("#char-count").text(charCount);
        $("#word-count").text(wordCount);
    }

    $("#user_text").on("input", updateTextInfo);
    updateTextInfo();

    // 🎤 Handle Generate Audio
    $("#generate-audio").on("click", function(e) {
        e.preventDefault();

        let text = $("#user_text").val().trim();
        if (!text) {
            alert("Please enter text before generating.");
            return;
        }

        // ✅ Determine which voice input to use
        let activeInput = $(".voice-input.active");
        if (!activeInput.length) {
            // fallback: clone if selected, otherwise normal
            if ($(".voice-input[data-type='clone']").val() !== "Select Clone Voice") {
                activeInput = $(".voice-input[data-type='clone']");
            } else {
                activeInput = $(".voice-input[data-type='normal']");
            }
        }

        let wrapper = activeInput.closest('.form-group');
        let voiceId = wrapper.find('.voice-id').val() || '';
        let voiceName = wrapper.find('.voice-name').val() || '';

        let stability = parseFloat($("#stability").val()) / 100;
        let similarity = parseFloat($("#similarity").val()) / 100;
        let style = parseFloat($("#style").val()) / 100;
        let speed = parseFloat($("#speed").val());

        $.ajax({
            url: "{{ route('generateAudioVoice') }}",
            type: "POST",
            dataType: "json",
            data: {
                text: text,
                voice_id: voiceId,
                voice_name: voiceName,
                model: $("#model").val(),
                best_voice: $("#best-voices").val(),
                stability: stability,
                similarity: similarity,
                style: style,
                speed: speed,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $("#generate-audio").prop("disabled", true).text("Generating...");
                Swal.fire({
                    title: 'Generating Voice...',
                    text: 'Please wait a moment while we process your request.',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            success: function(data) {
                $("#generate-audio").prop("disabled", false).text("Generate Audio");
                Swal.close();

                if (data.success) {
                    currentAudioUrl = data.audio_url;

                    const audioHtml = `
                        <audio controls class="w-100 mt-3">
                            <source src="${data.audio_url}" type="audio/mpeg">
                        </audio>
                    `;
                    $("#audio-container").html(audioHtml);

                    // Play programmatically
                    const audioElement = $("#audio-container audio")[0];
                    audioElement.load();
                    audioElement.play().catch(e => {
                        console.error("Autoplay blocked", e);
                        Swal.fire({
                            icon: 'info',
                            title: 'Click Play',
                            text: 'Browser blocked autoplay. Click the play button to listen.'
                        });
                    });

                    Swal.fire({
                        icon: 'success',
                        title: 'Voice Generated!',
                        text: 'Your audio is ready 🎉'
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Generation Failed',
                        text: data.message || 'Unknown error'
                    });
                }
            },
            error: function(xhr) {
                $("#generate-audio").prop("disabled", false).text("Generate Audio");
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'Something went wrong. Check console for details.'
                });
                console.error("AJAX Error:", xhr.responseText);
            }
        });
    });

    // 🎵 Download audio
    $("#download-audio").on("click", function(e) {
        e.preventDefault();

        if (!currentAudioUrl) {
            Swal.fire({
                icon: 'warning',
                title: 'No Audio',
                text: 'Please generate a voice first before downloading.'
            });
            return;
        }

        const link = document.createElement('a');
        link.href = currentAudioUrl;
        link.download = 'generated_voice.mp3';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
});
</script>



    {{-- upload-audio file --}}
    <script>
        document.getElementById('upload-audio').addEventListener('click', () => {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = '.txt,.docx';
            fileInput.click();

            fileInput.onchange = () => {
                const file = fileInput.files[0];
                if (file) {
                    const fileName = file.name;
                    const fileExtension = fileName.split('.').pop().toLowerCase();

                    if (fileExtension === 'txt' || fileExtension === 'docx') {

                        const audioContainer = document.getElementById('audio-container'); // ✅ define it
                        audioContainer.innerHTML = '';

                        const wrapper = document.createElement('div');
                        wrapper.classList.add('alert', 'alert-success', 'mt-3');
                        wrapper.innerHTML = `
                    <i class="fa-solid fa-file-alt mr-2"></i> File uploaded: <strong>${fileName}</strong>. Please click 'Generate Audio' to process the text.
                `;
                        audioContainer.appendChild(wrapper);

                        // For txt files, read content and put in textarea
                        if (fileExtension === 'txt') {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('user_text').value = e.target.result;
                                document.getElementById('user_text').dispatchEvent(new Event(
                                    'input')); // update char/word count
                            }
                            reader.readAsText(file);
                        }

                    } else {
                        alert('Invalid file type. Please upload a .txt or .docx file.');
                    }
                }
            }
        });
    </script>


    <script>
        function createVoiceItem(voice) {
            const item = document.createElement('div');
            item.className = 'voice-list-item voice-item';

            // Add data attributes for later use
            item.dataset.name = voice.name || voice.display_name || 'Unnamed Voice';
            item.dataset.id = voice.voice_id || voice.id || '';
            item.dataset.category = voice.category || 'General Voice';

            const avatar = voice.avatar_url || DEFAULT_AVATAR;
            const name = escapeHtml(voice.name || voice.display_name || 'Unnamed Voice');
            const category = escapeHtml(voice.category || 'General Voice');
            const preview = voice.preview_url || '';

            item.innerHTML = `
    <img src="${avatar}" alt="Voice Avatar" onerror="this.src='${DEFAULT_AVATAR}'">
    <div class="voice-info">
      <h6>${name}</h6>
      <small>${category}</small>
    </div>
    <div class="voice-actions">
      <i class="fa-solid fa-play voice-play-icon" data-preview="${preview}" title="Play Preview"></i>
    </div>
  `;

            // ✅ Click: Select voice
            // item.addEventListener('click', (e) => {
            //     if (e.target.closest('.voice-play-icon')) return;
            //     if (!activeInput) return;

            //     const wrapper = activeInput.closest('.form-group');
            //     const formControl = wrapper.querySelector('.form-control');
            //     const voiceIdInput = wrapper.querySelector('.voice-id');
            //     const voiceNameInput = wrapper.querySelector('.voice-name');

            //     const selectedName = item.dataset.name;
            //     const selectedId = item.dataset.id;

            //     // Update visible & hidden fields
            //     if (formControl) formControl.value = selectedName;
            //     if (voiceIdInput) voiceIdInput.value = selectedId;
            //     if (voiceNameInput) voiceNameInput.value = selectedName;

            //     // Add 'active' class to mark current selection
            //     document.querySelectorAll('.voice-input').forEach(el => el.classList.remove('active'));
            //     activeInput.classList.add('active');

            //     closeSidebar();
            // });

            item.addEventListener('click', (e) => {
                if (e.target.closest('.voice-play-icon')) return; // ignore click on play
                if (!activeInput) return;

                const wrapper = activeInput.closest('.form-group');
                const formControl = wrapper.querySelector('.form-control'); // visible input
                const voiceIdInput = wrapper.querySelector('.voice-id');    // hidden input for ID
                const voiceNameInput = wrapper.querySelector('.voice-name'); // hidden input for name

                // Update visible input and hidden inputs
                if (formControl) formControl.value = item.dataset.name;
                if (voiceIdInput) voiceIdInput.value = item.dataset.id;
                if (voiceNameInput) voiceNameInput.value = item.dataset.name;

                // Add 'active' class to current input
                document.querySelectorAll('.voice-input').forEach(el => el.classList.remove('active'));
                formControl.classList.add('active');

                closeSidebar();
            });



            // ✅ Click: Play preview
            const playIcon = item.querySelector('.voice-play-icon');
            playIcon.addEventListener('click', (e) => {
                e.stopPropagation();
                const previewUrl = playIcon.dataset.preview;
                if (!previewUrl) {
                    console.log('No preview URL available for this voice');
                    return;
                }

                if (currentAudio && !currentAudio.paused) {
                    currentAudio.pause();
                    playIcon.className = 'fa-solid fa-play voice-play-icon';
                } else {
                    if (currentAudio) currentAudio.pause();
                    document.querySelectorAll('.voice-play-icon').forEach(icon => {
                        icon.className = 'fa-solid fa-play voice-play-icon';
                    });

                    currentAudio = new Audio(previewUrl);
                    currentAudio.play()
                        .then(() => {
                            playIcon.className = 'fa-solid fa-pause voice-play-icon';
                        })
                        .catch(err => {
                            console.warn('Preview failed to play:', err);
                            playIcon.className = 'fa-solid fa-play voice-play-icon';
                        });

                    currentAudio.onended = () => {
                        playIcon.className = 'fa-solid fa-play voice-play-icon';
                    };
                }
            });

            return item;
        }
    </script>
@endsection
