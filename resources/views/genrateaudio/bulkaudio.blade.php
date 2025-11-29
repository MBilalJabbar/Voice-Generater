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

        .form-control,
        select.form-control {
            min-height: 40px;
            padding: .375rem .75rem;
        }

        .custom-select-wrapper {
            position: relative;
        }

        .custom-select-wrapper select.form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 2.5rem;
            background-image: none;
        }

        .custom-select-wrapper .select-icon {
            position: absolute;
            top: 50%;
            right: 18px;
            transform: translateY(-50%);
            pointer-events: none;
            color: #495057;
            font-size: 1rem;
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
                <div id="card-list" class="row">
                    {{--
                        **FIX APPLIED HERE:**
                        1. Removed the old `.d-flex.justify-content-between.align-items-center.mb-3` block.
                        2. Combined the Text Info Block and the Buttons into a single flex container below the textarea.
                    --}}
                    <div class="col-12 text-card-col" data-card-id="1">
                        <div class="card shadow-sm p-4 mb-4"
                            style="border-radius:10px; border:2px solid rgba(231, 234, 233, 1);">
                            <textarea name="user_text" id="user_text" cols="90" rows="10" class="form-control mb-3 text-input">Loreum Ipsum</textarea>



                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-info-block">
                                    <span class="char-count">0</span> Characters, <span class="word-count">0</span> Words
                                </div>
                                <div class="d-flex align-items-center button-group">
                                    <button class="btn btn-sm text-white upload-btn me-2"
                                        style="background: rgba(0, 62, 120, 1); border-radius: 20px; padding: 0.5rem 1rem;">
                                        <i class="fa-solid fa-upload me-2"></i> Upload File
                                    </button>
                                    <button class="btn btn-sm text-white me-2 add-card-btn"
                                        style="background: green; border-radius: 20px; padding: 0.5rem 1rem;">
                                        <i class="fa-solid fa-plus me-2"></i>Add
                                    </button>
                                    <button class="btn btn-sm text-white delete-card-btn" data-card-id="1"
                                        style="background: red; border-radius: 20px; padding: 0.5rem 1rem; display: none;">
                                        <i class="fa-solid fa-trash me-2"></i>Delete
                                    </button>
                                </div>
                            </div>

                            <div class="audio-message mt-2"></div>
                            <div class="audio-container" style="display:none;">
                                {{-- <div id="audio-container" style="display: none"></div> --}}
                                <div class="audio-wrapper" width="79px"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card shadow-sm p-4" style="border-radius:12px; border:2px solid rgba(231, 234, 233, 1);">
                    <div class="mb-4">
                        <h5 class="d-flex align-items-center mb-3">
                            <i class="fa-solid fa-sliders" style="color: #003E78;"></i>
                            <span style="padding-left: 8px;">Voice Model Selection</span>
                        </h5>

                        {{-- <div class="form-group mb-3">
                            <label for="voice-trigger">Voice*</label>
                            <div class="input-group">
                                <input type="text" id="selected-voice-name" class="form-control" value="Zara" readonly
                                    style="cursor: pointer;">
                                <button class="btn btn-outline-secondary" type="button" id="voice-trigger-button"
                                    style="border-left: 1px solid #ced4da;">
                                    <i class="fa-solid fa-caret-down"></i>
                                </button>
                            </div>
                            <input type="hidden" id="voice-id" value="zara_id">
                        </div> --}}

                        <div class="form-group mb-3">
                            <label for="voice-trigger">Voice*</label>
                            <div class="input-group">
                                <input type="text" id="selected-voice-name-main" class="form-control voice-input" value="Zara" readonly
                                    style="cursor: pointer;">
                                <button class="btn btn-outline-secondary voice-trigger" type="button">
                                    <i class="fa-solid fa-caret-down"></i>
                                </button>
                            </div>
                            <input type="hidden" class="voice-id" value="zara_id">
                        </div>


                        <div class="form-group mb-3 custom-select-wrapper">
                            <label for="model">Model*</label>
                            <select id="model" class="form-control">
                                <option>Multilingual v2</option>
                                <option>Turbo v2.5</option>
                                <option>Flash v2.5</option>
                                <option>v3 (alpha - unstable)</option>
                            </select>
                            <i class="fa-solid fa-caret-down select-icon"></i>
                        </div>
                    </div>

                    <div>
                        <h5 class="d-flex mb-3">
                            <i class="fa-solid fa-sliders me-3" style="color: #003E78;"></i>
                            <span style="padding-left: 8px;"> Voice Settings</span>
                        </h5>

                        <div class="form-group mb-3">
                            <label for="speed">Speed: <span id="speed-value">1x</span></label>
                            <input type="range" class="form-control-range slider-short" id="speed" min="0.5"
                                max="2" step="0.1" value="1">
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
                            <button class="btn btn-sm text-white generate-audio"
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
let nextCardId = 2;
let currentAudio = null;

// -------------------- SLIDERS --------------------
function updateSliderTrack(slider) {
    let value = (slider.value - slider.min) / (slider.max - slider.min) * 100;
    slider.style.setProperty('--value', value + '%');
}

function initSliders() {
    document.querySelectorAll("input[type=range]").forEach(slider => {
        slider.addEventListener('input', () => updateSliderTrack(slider));
        updateSliderTrack(slider);
    });
}

// -------------------- WORD COUNTER --------------------
function initWordCounter(textarea) {
    const card = textarea.closest('.card');
    const charCountSpan = card.querySelector('.char-count');
    const wordCountSpan = card.querySelector('.word-count');

    const updateCount = () => {
        const text = textarea.value;
        charCountSpan.textContent = text.length;
        wordCountSpan.textContent = text.trim() === '' ? 0 : text.trim().split(/\s+/).length;
    };

    textarea.addEventListener('input', updateCount);
    updateCount();
}

// -------------------- UPLOAD LOGIC --------------------

function initUploadLogic(uploadBtn) {
    uploadBtn.addEventListener('click', () => {
        const card = uploadBtn.closest('.card');
        const textarea = card.querySelector('.text-input');
        const audioContainer = card.querySelector('.audio-container');

        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = '.txt';
        fileInput.click();

        fileInput.onchange = () => {
            const file = fileInput.files[0];
            if (!file) return;

            const fileName = file.name;
            const fileExtension = fileName.split('.').pop().toLowerCase();

            if (fileExtension !== 'txt') {
                audioContainer.style.display = 'block';
                audioContainer.innerHTML =
                    `<div class="alert alert-warning mt-3">
                        <i class="fa-solid fa-exclamation-circle me-2"></i> Invalid file type. Please upload a .txt file.
                    </div>`;
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                textarea.value = e.target.result;
                textarea.dispatchEvent(new Event('input'));

                // Clear previous audio container
                audioContainer.show();
                audioContainer.querySelector('.audio-wrapper').innerHTML = "";

                // Optional: show a small notice
                audioContainer.innerHTML = `<div class="alert alert-success mt-3">
                    <i class="fa-solid fa-file-alt me-2"></i> File loaded: <strong>${fileName}</strong>.
                </div>`;
            };
            const messageDiv = card.querySelector('.audio-message');
            messageDiv.innerHTML = `<div class="alert alert-success mt-3">File loaded: <strong>${fileName}</strong></div>`;

            reader.readAsText(file);
        };
    });
}

// -------------------- CREATE NEW CARD --------------------
function createNewCard() {
    const newId = nextCardId++;
    const cardList = document.getElementById('card-list');

    const newCardHtml = `
        <div class="col-12 text-card-col" data-card-id="${newId}">
            <div class="card shadow-sm p-4 mb-4" style="border-radius:10px; border:2px solid rgba(231, 234, 233, 1);">
                <textarea name="user_text_${newId}" id="user_text_${newId}" cols="90" rows="10" class="form-control mb-3 text-input"></textarea>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-info-block">
                        <span class="char-count">0</span> Characters, <span class="word-count">0</span> Words
                    </div>
                    <div class="d-flex align-items-center button-group">
                        <button class="btn btn-sm text-white upload-btn me-2"
                            style="background: rgba(0, 62, 120, 1); border-radius: 20px; padding: 0.5rem 1rem;">
                            <i class="fa-solid fa-upload me-2"></i> Upload File
                        </button>
                        <button class="btn btn-sm text-white me-2 add-card-btn"
                            style="background: green; border-radius: 20px; padding: 0.5rem 1rem;">
                            <i class="fa-solid fa-plus me-2"></i> Add
                        </button>
                        <button class="btn btn-sm text-white delete-card-btn"
                            style="background: red; border-radius: 20px; padding: 0.5rem 1rem;">
                            <i class="fa-solid fa-trash me-2"></i> Delete
                        </button>
                    </div>
                </div>
                <div class="audio-message mt-2"></div>
                <div class="audio-container">
                    <div class="audio-wrapper" width="79px"></div>
                </div>

            </div>
        </div>
    `;

    cardList.insertAdjacentHTML('beforeend', newCardHtml);

    // Initialize new card functionalities
    const newCard = cardList.lastElementChild;
    const textarea = newCard.querySelector('.text-input');
    const uploadBtn = newCard.querySelector('.upload-btn');
    const addBtn = newCard.querySelector('.add-card-btn');
    const deleteBtn = newCard.querySelector('.delete-card-btn');

    initWordCounter(textarea);
    initUploadLogic(uploadBtn);

    addBtn.addEventListener('click', createNewCard);
    deleteBtn.addEventListener('click', deleteCard);
}

// -------------------- DELETE CARD --------------------
function deleteCard(event) {
    const cardCol = event.currentTarget.closest('.text-card-col');
    const cardId = cardCol.getAttribute('data-card-id');
    if (cardId === '1') return; // Prevent deleting first card
    cardCol.remove();
}

// -------------------- INITIALIZATION --------------------
document.addEventListener('DOMContentLoaded', () => {
    initSliders();

    const initialCard = document.querySelector('.text-card-col[data-card-id="1"]');
    const initialTextarea = initialCard.querySelector('.text-input');
    const initialUploadBtn = initialCard.querySelector('.upload-btn');
    const initialAddBtn = initialCard.querySelector('.add-card-btn');
    const initialDeleteBtn = initialCard.querySelector('.delete-card-btn');

    initWordCounter(initialTextarea);
    initUploadLogic(initialUploadBtn);
    initialAddBtn.addEventListener('click', createNewCard);
    initialDeleteBtn.addEventListener('click', deleteCard);

    // Slider displays
    const sliders = ['speed', 'style', 'similarity', 'stability'];
    sliders.forEach(id => {
        const slider = document.getElementById(id);
        const display = document.getElementById(id + '-value');
        display.textContent = slider.value + (id === 'speed' ? 'x' : '');
        slider.addEventListener('input', () => {
            display.textContent = slider.value + (id === 'speed' ? 'x' : '');
        });
    });
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
            const formControl = wrapper.querySelector('.voice-input');
            const voiceIdInput = wrapper.querySelector('.voice-id');

            if (formControl) {
                formControl.value = voice.name;
                formControl.classList.add('active');
            }
            if (voiceIdInput) voiceIdInput.value = voice.voice_id || voice.id || '';

            closeSidebar();
        });

        // Play preview
        const playIcon = item.querySelector('.voice-play-icon');
        playIcon.addEventListener('click', (e) => {
            e.stopPropagation();
            const previewUrl = playIcon.dataset.preview;
            if (!previewUrl) return;

            if (currentAudio && !currentAudio.paused) {
                currentAudio.pause();
                playIcon.className = 'fa-solid fa-play voice-play-icon';
            } else {
                if (currentAudio) currentAudio.pause();
                document.querySelectorAll('.voice-play-icon').forEach(icon => icon.className = 'fa-solid fa-play voice-play-icon');

                currentAudio = new Audio(previewUrl);
                currentAudio.play()
                    .then(() => playIcon.className = 'fa-solid fa-pause voice-play-icon')
                    .catch(() => playIcon.className = 'fa-solid fa-play voice-play-icon');

                currentAudio.onended = () => {
                    playIcon.className = 'fa-solid fa-play voice-play-icon';
                };
            }
        });

        return item;
    }

    async function fetchVoices(type) {
        let cache = type === 'clone' ? cloneVoicesCache : voicesCache;
        if (cache) return cache;

        const endpoint = type === 'clone' ? '/clone-voices' : '/fetchGenAIBulkVoices';
        setLoadingState(true);
        showMessage('Loading voices...');

        try {
            const controller = new AbortController();
            const timeout = setTimeout(() => controller.abort(), 10000);
            const res = await fetch(endpoint, { signal: controller.signal });
            clearTimeout(timeout);

            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            const data = await res.json();

            let voices = Array.isArray(data) ? data :
                         Array.isArray(data.voices) ? data.voices :
                         Array.isArray(data.data) ? data.data : [];

            if (type === 'clone') cloneVoicesCache = voices;
            else voicesCache = voices;

            return voices;
        } catch (err) {
            console.error(`Error fetching ${type} voices:`, err);
            showMessage(`Error loading ${type} voices.`);
            return [];
        } finally {
            setLoadingState(false);
        }
    }

    async function openAndLoadVoices(inputEl, type) {
        if (isLoading) return;

        activeInput = inputEl;
        activeType = type;
        openSidebar();

        let cache = type === 'clone' ? cloneVoicesCache : voicesCache;
        if (cache?.length) return renderVoiceList(cache);

        const voices = await fetchVoices(type);
        if (!voices.length) showMessage('No voices available.');
        else renderVoiceList(voices);
    }

    function renderVoiceList(voices) {
        voiceList.innerHTML = '';
        const fragment = document.createDocumentFragment();
        voices.forEach(v => fragment.appendChild(createVoiceItem(v)));
        voiceList.appendChild(fragment);
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Initialize event listeners for both existing and future voice-input elements
    function initializeEventListeners() {
        document.addEventListener('click', (e) => {
            // Voice input click
            if (e.target.classList.contains('voice-input')) {
                const type = e.target.dataset.type || 'normal';
                openAndLoadVoices(e.target, type);
            }

            // Voice trigger button click
            if (e.target.closest('.voice-trigger')) {
                const trigger = e.target.closest('.voice-trigger');
                const formGroup = trigger.closest('.form-group');
                const inputField = formGroup?.querySelector('.voice-input');
                if (inputField) openAndLoadVoices(inputField, inputField.dataset.type || 'normal');
            }
        });

        // Close sidebar
        document.getElementById('close-voice-sidebar')?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeEventListeners);
    } else {
        initializeEventListeners();
    }

    window.addEventListener('beforeunload', () => {
        if (currentAudio) {
            currentAudio.pause();
            currentAudio = null;
        }
    });

    window.voiceManager = {
        clearCache: () => { voicesCache = null; cloneVoicesCache = null; },
        getCache: () => ({ normal: voicesCache, clone: cloneVoicesCache })
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




{{-- Generate Bulk Voics Section --}}
<script>
    $(document).ready(function() {
        let allAudioUrls = [];
    // Slider visuals
    $("input[type=range]").each(function() {
        const slider = $(this);
        function updateTrack() {
            let value = (slider.val() - slider.attr("min")) / (slider.attr("max") - slider.attr("min")) * 100;
            slider.css("background", `linear-gradient(to right, #003E78 ${value}%, #E7EAE9 ${value}%)`);
        }
        slider.on("input", updateTrack);
        updateTrack();
    });

    function updateLabels() {
        $("#speed-value").text($("#speed").val() + 'x');
        $("#style-value").text($("#style").val());
        $("#similarity-value").text($("#similarity").val());
        $("#stability-value").text($("#stability").val());
    }
    $("input[type=range]").on("input", updateLabels);
    updateLabels();

    // Word/char counter for all textareas
    $(".text-input").on("input", function() {
        const text = $(this).val() || "";
        const card = $(this).closest(".card");
        card.find(".char-count").text(text.length);
        card.find(".word-count").text(text.trim() === "" ? 0 : text.trim().split(/\s+/).length);
    }).trigger("input");

    // Generate Audio Button
    $(".generate-audio").on("click", function(e) {
        e.preventDefault();

        // Collect all lines from all textareas
        let texts = [];
        $(".text-input").each(function() {
            const text = $(this).val().trim();
            if (text) {
                const lines = text.split("\n").map(l => l.trim()).filter(l => l !== "");
                texts.push(...lines);
            }
        });

        if (texts.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'No text found',
                text: 'Please type text or upload a .txt file before generating.'
            });
            return;
        }

        const voiceId = $(".voice-id").val();
        const voiceName = $(".voice-input").val() || "Generated Voice";
        const model = $("#model").val();
        const speed = parseFloat($("#speed").val());
        const style = parseFloat($("#style").val()) / 100;
        const similarity = parseFloat($("#similarity").val()) / 100;
        const stability = parseFloat($("#stability").val()) / 100;
        const boost = $("#boost-audio-switch").is(":checked");

        $.ajax({
            url: "{{ route('generateAudioVoices') }}",
            type: "POST",
            dataType: "json",
            data: {
                texts: texts,
                voice_id: voiceId,
                voice_name: voiceName,
                model: model,
                speed: speed,
                style: style,
                similarity: similarity,
                stability: stability,
                boost: boost,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $(".generate-audio").prop("disabled", true).text("Generating...");
                Swal.fire({
                    title: 'Generating Voice...',
                    text: 'Please wait a moment while we process your request.',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            success: function(data) {
                $(".generate-audio").prop("disabled", false).text("Generate Audio");
            Swal.close();

            // FIX: If backend returned an error object instead of array
            if (!Array.isArray(data)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Unknown error occurred'
                });
                return;
            }

            // Now data is safe ARRAY, so .some() will not break
            let hasError = data.some(item => item.success === false);

            if (hasError) {
                let errorItem = data.find(item => item.success === false);

                Swal.fire({
                    icon: 'error',
                    title: 'Insufficient Credits',
                    text: errorItem.message
                });

                return;
            }

                let index = 0;
                $(".text-input").each(function() {
                    const card = $(this).closest(".card");
                    const container = card.find(".audio-container");
                    const wrapper = card.find(".audio-wrapper");

                    const lines = $(this).val().trim().split("\n").map(l => l.trim()).filter(l => l !== "");
                    wrapper.html(""); // clear previous audio
                    container.show();

                    lines.forEach(() => {
                        const item = data[index];
                        index++;

                        if (item && item.success) {
                            allAudioUrls.push(item.audio_url);
                            wrapper.append(`
                                <div class="mb-2">
                                    <audio controls class="w-100 mt-2">
                                        <source src="${item.audio_url}" type="audio/mpeg">
                                    </audio>
                                    <button class="btn btn-sm btn-outline-primary mt-2 download-single" data-url="${item.audio_url}">
                                        <i class="fa-solid fa-download me-1"></i> Download This
                                    </button>
                                </div>
                            `);
                            //  <p>${item.text}</p>
                        } else {
                            wrapper.append(`<p style="color:red;">Failed: ${item ? item.message : 'Unknown error'}</p>`);
                        }
                    });
                });

                Swal.fire({
                    icon: 'success',
                    title: 'Voice Generated!',
                    text: 'Your audio files are ready 🎉'
                });
            },
            error: function(xhr) {
                $(".generate-audio").prop("disabled", false).text("Generate Audio");
                Swal.close();
                Swal.fire({ icon: 'error', title: 'Server Error', text: 'Check console for details.' });
                console.error("AJAX Error:", xhr.responseText);
            }
        });
    });
        // 🎧 Download single voice
    $(document).on("click", ".download-single", function(e) {
        e.preventDefault();
        const url = $(this).data("url");
        const link = document.createElement('a');
        link.href = url;
        link.download = 'voice_' + Date.now() + '.mp3';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    // 🎧 Download all voices
    $("#download-audio").on("click", function(e) {
        e.preventDefault();

        if (allAudioUrls.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No Audio',
                text: 'Please generate a voice first before downloading.'
            });
            return;
        }

        Swal.fire({
            icon: 'info',
            title: 'Downloading...',
            text: 'All generated voices will be downloaded now.'
        });

        allAudioUrls.forEach((url, i) => {
            const link = document.createElement('a');
            link.href = url;
            link.download = `voice_${i + 1}.mp3`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });
});

</script>


@endsection
