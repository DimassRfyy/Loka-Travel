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
          <p class="text-center m-auto font-semibold">{{ $city->name }}</p>
          <div class="w-12"></div>
        </nav>
        <div class="flex flex-col gap-3 px-4">
        
         @forelse ($packageTours as $tour)
         <a href="{{ route('details',$tour->slug) }}" class="card">
            <div class="bg-white p-4 rounded-[26px] flex flex-col gap-3">
              <div class="flex items-center gap-4">
                <div class="w-[92px] h-[92px] flex shrink-0 rounded-xl overflow-hidden">
                  <img src="{{ Storage::url($tour->thumbnail) }}" class="w-full h-full object-cover object-center" alt="thumbnail">
                </div>
                <div class="flex flex-col gap-1">
                  <p class="font-semibold two-lines">{{ $tour->name }}</p>
                  <div class="flex items-center gap-1">
                    <div class="w-4 h-4 flex shrink-0">
                      <img src="/assets/icons/location-map.svg" alt="icon">
                    </div>
                    <span class="text-sm text-darkGrey tracking-035">{{ $tour->city->name }}, Indonesia</span>
                  </div>
                </div>
              </div>
              <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                  <span class="font-semibold text-sm leading-[22px] tracking-[0.35px]">4.8</span>
                  <div class="flex items-center gap-1">
                    <img src="/assets/icons/Star.svg" alt="Star">
                    <img src="/assets/icons/Star.svg" alt="Star">
                    <img src="/assets/icons/Star.svg" alt="Star">
                    <img src="/assets/icons/Star.svg" alt="Star">
                    <img src="/assets/icons/Star-gray.svg" alt="Star">
                  </div>
                </div>
                <p class="text-sm leading-[22px] tracking-035">
                  <span class="font-semibold text-[#4D73FF] text-nowrap">Rp {{ number_format($tour->price, 0, ',', '.') }}                </span><span class="text-darkGrey">/{{ $tour->days }}days</span>
                </p>
              </div>
            </div>
          </a>
          @empty
          <p>Belum ada data</p>
         @endforelse 
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