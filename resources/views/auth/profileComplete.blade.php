<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('complete-profile') }}">
            @csrf

             <!-- Full Name -->
            <div class="mt-4">
                <x-label for="full_name" value="{{ __('Full Name') }}" />
                <x-input id="full_name" class="block mt-1 w-full" type="text" name="full_name"
                    value="{{ old('full_name') }}" required />
            </div>

            <!-- Phone Number -->
            <div class="block">
                <x-label for="phone" value="{{ __('Phone Number') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" value="{{ old('phone') }}"
                    required autofocus />
            </div>

            <!-- Date of Birth -->
            <div class="mt-4">
                <x-label for="dob" value="{{ __('Date of Birth') }}" />
                <x-input id="dob" class="block mt-1 w-full" type="date" name="dob"
                    value="{{ old('dob') }}" required />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>

    </x-authentication-card>
</x-guest-layout>
