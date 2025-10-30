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
                            <textarea name="user_text_1" id="user_text_1" cols="90" rows="10" class="form-control mb-3 text-input">Loreum Ipsum</textarea>

                            <div class="audio-container" style="display:none;">
                                <div id="audio-container" style="display: none"></div>
                                <div class="audio-wrapper" width="79px"></div>
                            </div>

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

                        <div class="form-group mb-3">
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
                        </div>

                        <div class="form-group mb-3 custom-select-wrapper">
                            <label for="model">Model*</label>
                            <select id="model" class="form-control">
                                <option>Standard</option>
                                <option>Professional</option>
                                <option>Casual</option>
                                <option>Expressive</option>
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
        let nextCardId = 2;

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

        function initUploadLogic(uploadBtn) {
            uploadBtn.addEventListener('click', () => {
                const card = uploadBtn.closest('.card');
                const textarea = card.querySelector('.text-input'); // Get the textarea for the current card
                const audioContainer = card.querySelector('.audio-container');

                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.accept = '.txt'; // Restricting to .txt for simple text reading
                fileInput.click();

                fileInput.onchange = () => {
                    const file = fileInput.files[0];
                    if (file) {
                        const fileName = file.name;
                        const fileExtension = fileName.split('.').pop().toLowerCase();

                        if (fileExtension === 'txt') {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                // Populate the textarea with the file content
                                textarea.value = e.target.result;
                                // Manually trigger 'input' to update word/char count
                                textarea.dispatchEvent(new Event('input'));

                                audioContainer.style.display = 'block';
                                audioContainer.innerHTML =
                                    `<div class="alert alert-success mt-3"><i class="fa-solid fa-file-alt me-2"></i> File loaded: <strong>${fileName}</strong>. Text imported successfully!</div>`;
                            };

                            reader.onerror = function() {
                                console.error('Error reading file.');
                                // Use a custom message box instead of alert
                                audioContainer.style.display = 'block';
                                audioContainer.innerHTML =
                                    `<div class="alert alert-danger mt-3"><i class="fa-solid fa-exclamation-triangle me-2"></i> Error reading file.</div>`;
                            };

                            reader.readAsText(file); // Read the file as plain text
                        } else {
                            // Use a custom message box instead of alert
                            audioContainer.style.display = 'block';
                            audioContainer.innerHTML =
                                `<div class="alert alert-warning mt-3"><i class="fa-solid fa-exclamation-circle me-2"></i> Invalid file type. Please upload a .txt file.</div>`;
                        }
                    }
                };
            });
        }

        function createNewCard(event) {
            const newId = nextCardId++;
            const cardList = document.getElementById('card-list');
            const newCardHtml = `
            <div class="col-12 text-card-col" data-card-id="${newId}">
                <div class="card shadow-sm p-4 mb-4" style="border-radius:10px; border:2px solid rgba(231, 234, 233, 1);">
                    <textarea name="user_text_${newId}" id="user_text_${newId}" cols="90" rows="10" class="form-control mb-3 text-input"></textarea>
                    
                    <div class="audio-container" style="display:none;">
                        <div class="audio-wrapper" width="79px"></div>
                    </div>

                    {{-- **FIXED BUTTON CONTAINER HTML HERE** to match the first card's new clean structure --}}
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
                            <button class="btn btn-sm text-white delete-card-btn" data-card-id="${newId}" style="background: red; border-radius: 20px; padding: 0.5rem 1rem;">
                                <i class="fa-solid fa-trash me-2"></i>Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
            cardList.insertAdjacentHTML('beforeend', newCardHtml);

            // Re-initialize all handlers for the new card
            const newCardElement = cardList.lastElementChild;
            const newTextarea = newCardElement.querySelector('.text-input');
            const newUploadBtn = newCardElement.querySelector('.upload-btn');
            const deleteBtn = newCardElement.querySelector('.delete-card-btn');
            const addBtn = newCardElement.querySelector('.add-card-btn');

            initWordCounter(newTextarea);
            initUploadLogic(newUploadBtn);
            deleteBtn.addEventListener('click', deleteCard);
            addBtn.addEventListener('click', createNewCard);

            // Ensure the delete button is visible for the new card
            // It will be visible by default as we removed the 'display: none' from the HTML, 
            // but explicitly setting it just in case.
            deleteBtn.style.display = 'inline-block';
        }

        function deleteCard(event) {
            const cardCol = event.currentTarget.closest('.text-card-col');
            const cardId = cardCol.getAttribute('data-card-id');
            // Prevent deletion of the first card (ID 1)
            if (cardId === '1') return;
            cardCol.remove();
        }

        function setupSidebar() {
            const voiceTriggerButton = document.getElementById('voice-trigger-button');
            const voiceSidebar = document.getElementById('voice-sidebar');
            const voiceSidebarOverlay = document.getElementById('voice-sidebar-overlay');
            const closeSidebarButton = document.getElementById('close-voice-sidebar');
            const selectedVoiceInput = document.getElementById('selected-voice-name');
            const voiceListItems = document.querySelectorAll('.voice-list-item');
            const voiceIdInput = document.getElementById('voice-id');

            function openVoiceSidebar() {
                voiceSidebarOverlay.style.display = 'block';
                setTimeout(() => {
                    voiceSidebar.classList.add('open');
                }, 10);
            }

            function closeVoiceSidebar() {
                voiceSidebar.classList.remove('open');
                setTimeout(() => {
                    voiceSidebarOverlay.style.display = 'none';
                }, 300);
            }

            voiceTriggerButton.addEventListener('click', openVoiceSidebar);
            selectedVoiceInput.addEventListener('click', openVoiceSidebar);

            closeSidebarButton.addEventListener('click', closeVoiceSidebar);
            voiceSidebarOverlay.addEventListener('click', closeVoiceSidebar);

            voiceListItems.forEach(item => {
                // Note: You must add data-voice-name and data-voice-id attributes to your voice-list-item HTML elements
                // to make voice selection work.
                item.addEventListener('click', function() {
                    const voiceName = this.querySelector('.voice-info h6').textContent.split(' - ')[
                        0]; // Basic parsing
                    const voiceId = voiceName.toLowerCase() + '_id'; // Placeholder ID generation
                    selectedVoiceInput.value = voiceName;
                    voiceIdInput.value = voiceId;
                    closeVoiceSidebar();
                });
            });
        }

        // INITIALIZATION

        initSliders();
        setupSidebar();

        // 1. Initialize the first card's components
        const initialCardCol = document.querySelector('.text-card-col[data-card-id="1"]');
        const initialCard = initialCardCol.querySelector('.card');
        const initialTextarea = initialCard.querySelector('.text-input');
        const initialUploadBtn = initialCard.querySelector('.upload-btn');
        const initialAddBtn = initialCard.querySelector('.add-card-btn');
        const initialDeleteBtn = initialCard.querySelector('.delete-card-btn');

        initWordCounter(initialTextarea);
        initUploadLogic(initialUploadBtn);
        initialAddBtn.addEventListener('click', createNewCard);

        // 2. Initialize slider value displays
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
@endsection
