@extends('layouts.app')

@section('title')
    Speechly Studio - Plans
@endsection

@section('body')
    <div class="container py-5" style="background:#fff;" id="pricing-section">
        <div class="row g-4">

            @foreach ($plans as $webplans)
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-5">
                    <div class="p-4 shadow-sm h-100 d-flex flex-column justify-content-between"
                        style="border-radius:25px; border:1px solid #eee;">
                        <div class="" style="color:#231D4F;">
                            <h2 class="fw-bold mb-2" style="font-size:26px; font-weight:800">{{ $webplans->name }}</h2>
                            <h3 class="fw-bold mb-2" style="font-size:22px; font-weight:700">
                                {{ $webplans->currency }}
                                {{ rtrim(rtrim(number_format($webplans->price, 2, '.', ''), '0'), '.') }} /
                                <small style="font-size:16px; font-weight:600;">{{ $webplans->duration }} Days</small>
                            </h3>
                            {{-- <h4 style="font-size:18px; color:#231D4F;font-weight:600">{{ $webplans->price }}</h4> --}}
                        </div>
                        @php
                            $features = [
                                // 'Characters' => $webplans->characters,
                                // 'Minutes' => $webplans->minutes,
                                'Text to Speech' => $webplans->text_to_speech,
                                'Bulk Voice Generation' => $webplans->bulk_voice_generation,
                                'Voice Effects (Pitch, Speed, Emotion)' => $webplans->voice_effects,
                                'Ultra HD Audio (320 kbps)' => $webplans->ultra_hd_audio,
                                'All ElevenLabs voices & models' => $webplans->all_voices_models,
                                'Voice Cloning & Change' => $webplans->voice_cloning,
                            ];

                        @endphp

                        <ul class="list-unstyled text-start mt-3 mb-4"
                            style="color:rgba(132,129,153,1); font-size:16.96px; line-height:29.4px;">
                            <li class="mt-2">
                                @if (!empty($webplans->characters))
                                    <i class="fas fa-check me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                    {{ $webplans->characters }} Characters
                                @else
                                    <i class="fas fa-times me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                    {{ $webplans->characters }} Characters
                                @endif
                            </li>
                            <li class="mt-2">
                                @if (!empty($webplans->minutes))
                                    <i class="fas fa-check me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                    {{ $webplans->minutes }} Minutes
                                @else
                                    <i class="fas fa-times me-2"
                                        style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                    {{ $webplans->minutes }} Minutes
                                @endif
                            </li>


                            @foreach ($features as $label => $value)
                                <li class="mt-2">
                                    @if (!empty($value))
                                        <i class="fas fa-check me-2"
                                            style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        {{ $label }}
                                    @else
                                        <i class="fas fa-times me-2"
                                            style="background:rgba(82,67,194,0.1);padding:6px;border-radius:50%;color:#003E78;"></i>
                                        {{ $label }} {{-- {{ $value }} --}}
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        @if ($webplans->name == 'Free')
                            <a href="{{ url('FreePlanActive', base64_encode($webplans->id)) }}">
                                <button class="btn text-white w-100 mt-auto"
                                    style="background:rgba(0,62,120,1); height:50px; border-radius:27px; font-weight:500;">Choose
                                    Plan
                                    {{-- {{ $plan['btn'] }} --}}
                                </button>
                            </a>
                        @else
                            <a href="{{ url('viewCheckout', base64_encode($webplans->id)) }}">
                                <button class="btn text-white w-100 mt-auto"
                                    style="background:rgba(0,62,120,1); height:50px; border-radius:27px; font-weight:500;">Choose
                                    Plan
                                    {{-- {{ $plan['btn'] }} --}}
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>


     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
            });
        @endif
    </script>
@endsection
