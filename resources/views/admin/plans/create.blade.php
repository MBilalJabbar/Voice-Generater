@extends('admin.layouts.app')

@section('title')
    Plans Create
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    {{-- <li class="breadcrumb-item"><a href="{{ route('item.index') }}">Items</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-white shadow p-4">
                    <h5 class="mb-4">Create Plan</h5>
                    {{-- Note: 'item.store' is the assumed route for saving a new item --}}
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- Basic Details --}}
                            <div class="mb-3 col-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g., Basic Plan"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-6">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" name="price" class="form-control" placeholder="e.g., 9.99"
                                    value="{{ old('price') }}" step="0.01" required>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-6">
                                <label for="duration" class="form-label">Duration</label>
                                <input type="text" name="duration" class="form-control" placeholder="e.g., 30 days"
                                    value="{{ old('duration') }}" required>
                                @error('duration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-6">
                                <label for="expires" class="form-label">Expiration Date (Optional)</label>
                                <input type="date" name="expires" class="form-control"
                                    value="{{ old('expires') }}">
                                @error('expires')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">Usage Limits</h5>
                        <div class="row">
                            <div class="mb-3 col-4">
                                <label for="characters" class="form-label">Characters Limit</label>
                                <input type="number" name="characters" class="form-control" placeholder="e.g., 100000"
                                    value="{{ old('characters') }}">
                                @error('characters')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-4">
                                <label for="minutes" class="form-label">Minutes Limit</label>
                                <input type="number" name="minutes" class="form-control" placeholder="e.g., 600"
                                    value="{{ old('minutes') }}">
                                @error('minutes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3">Feature Toggles (Select Yes/No)</h5>
                        <div class="row">
                            {{-- Feature Group 1 --}}
                            <div class="mb-3 col-4">
                                <label for="text_to_speech" class="form-label">Text to Speech</label>
                                <select name="text_to_speech" class="form-select" required>
                                    <option value="1" {{ old('text_to_speech') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('text_to_speech') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('text_to_speech')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-4">
                                <label for="bulk_voice_generation" class="form-label">Bulk Voice Generation</label>
                                <select name="bulk_voice_generation" class="form-select" required>
                                    <option value="1" {{ old('bulk_voice_generation') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('bulk_voice_generation') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('bulk_voice_generation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-4">
                                <label for="voice_cloning" class="form-label">Voice Cloning</label>
                                <select name="voice_cloning" class="form-select" required>
                                    <option value="1" {{ old('voice_cloning') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('voice_cloning') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('voice_cloning')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Feature Group 2 --}}
                            <div class="mb-3 col-4">
                                <label for="voice_effects" class="form-label">Voice Effects</label>
                                <select name="voice_effects" class="form-select" required>
                                    <option value="1" {{ old('voice_effects') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('voice_effects') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('voice_effects')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-4">
                                <label for="ultra_hd_audio" class="form-label">Ultra HD Audio</label>
                                <select name="ultra_hd_audio" class="form-select" required>
                                    <option value="1" {{ old('ultra_hd_audio') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('ultra_hd_audio') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('ultra_hd_audio')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-4">
                                <label for="all_voices_models" class="form-label">All Voices/Models Access</label>
                                <select name="all_voices_models" class="form-select" required>
                                    <option value="1" {{ old('all_voices_models') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('all_voices_models') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('all_voices_models')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Feature Group 3 --}}
                            <div class="mb-3 col-4">
                                <label for="priority_usage" class="form-label">Priority Usage</label>
                                <select name="priority_usage" class="form-select" required>
                                    <option value="1" {{ old('priority_usage') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('priority_usage') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('priority_usage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-4">
                                <label for="faster_processing" class="form-label">Faster Processing</label>
                                <select name="faster_processing" class="form-select" required>
                                    <option value="1" {{ old('faster_processing') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('faster_processing') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('faster_processing')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-4">
                                <label for="team_studio_usage" class="form-label">Team Studio Usage</label>
                                <select name="team_studio_usage" class="form-select" required>
                                    <option value="1" {{ old('team_studio_usage') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('team_studio_usage') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('team_studio_usage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Feature Group 4 (Final Row) --}}
                            <div class="mb-3 col-4">
                                <label for="premium_support" class="form-label">Premium Support</label>
                                <select name="premium_support" class="form-select" required>
                                    <option value="1" {{ old('premium_support') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('premium_support') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('premium_support')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 col-4">
                                <label for="extended_usage" class="form-label">Extended Usage/Rights</label>
                                <select name="extended_usage" class="form-select" required>
                                    <option value="1" {{ old('extended_usage') == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('extended_usage') == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('extended_usage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary mt-3">Create Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
