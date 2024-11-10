<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mb-20">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
        @if (Auth::user()->hasRole('customer'))
        <div class="navigation-bar fixed bottom-0 z-50 max-w-[640px] w-full h-[85px] bg-white rounded-t-[25px] flex items-center justify-evenly py-[45px]">
            <a href="{{ route('home') }}" class="menu {{ Route::currentRouteName() == 'home' ? '' : 'opacity-25' }}">
                <div class="flex flex-col justify-center w-fit gap-1">
                    <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                        <img src="{{ asset('assets/icons/home-active.svg') }}" alt="icon">
                    </div>
                    <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Home</p>
                </div>
            </a>
      
            <a href="{{ route('search') }}" class="menu {{ Route::currentRouteName() == 'search' ? '' : 'opacity-25' }}">
                <div class="flex flex-col justify-center w-fit gap-1">
                    <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                        <img src="{{ asset('assets/icons/search.svg') }}" alt="icon">
                    </div>
                    <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Search</p>
                </div>
            </a>
        
            <a href="{{ route('dashboard.bookings') }}" class="menu {{ Route::currentRouteName() == 'dashboard.bookings' ? '' : 'opacity-25' }}">
                <div class="flex flex-col justify-center w-fit gap-1">
                    <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                        <img src="{{ asset('assets/icons/calendar-blue.svg') }}" alt="icon">
                    </div>
                    <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Schedule</p>
                </div>
            </a>
        
            <a href="{{ route('profile.edit') }}" class="menu {{ Route::currentRouteName() == 'profile.edit' ? '' : 'opacity-25' }}">
                <div class="flex flex-col justify-center w-fit gap-1">
                    <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                        <img src="{{ asset('assets/icons/user-flat.svg') }}" alt="icon">
                    </div>
                    <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Profile</p>
                </div>
            </a>
        </div>
        @endif
    </div>
</x-app-layout>
