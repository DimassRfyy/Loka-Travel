<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-black">
    <section id="content" class="max-w-[640px] w-full mx-auto bg-[#F9F2EF] min-h-screen flex flex-col gap-8 pb-[120px]">
        <nav class="mt-8 px-4 w-full flex items-center justify-between">
          <a href="{{ route('home') }}">
            <img src="/assets/icons/back.png" alt="back">
          </a>
          <p class="text-center m-auto font-semibold">Search Package Tour</p>
          <div class="w-12"></div>
        </nav>
        <div class="flex flex-col gap-3 px-4">
        
        
        </div>
        <div class="navigation-bar fixed bottom-0 z-50 max-w-[640px] w-full h-[85px] bg-white rounded-t-[25px] flex items-center justify-evenly py-[45px]">
            <a href="{{ route('home') }}" class="menu {{ in_array(Route::currentRouteName(), ['home', 'categories']) ? '' : 'opacity-25' }}">
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
    </section>

    <script src="{{ asset('js/two-lines-text.js') }}"></script>
</body>
</html>