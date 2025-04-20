<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
    rel="stylesheet" />
  <!-- CSS -->
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>

<body class="font-poppins text-black">
  <section id="content" class="max-w-[640px] w-full mx-auto bg-[#F9F2EF] min-h-screen flex flex-col gap-8 pb-[120px]">
    <nav class="mt-8 px-4 w-full flex items-center justify-between">
      @guest
      <img src="{{ asset('assets/logos/logo.png') }}" width="170" height="75" class="" alt="photo">
    @endguest
      <div class="flex items-center gap-3">
        @auth
      <div
        class="w-12 h-12 border-4 border-white rounded-full overflow-hidden flex shrink-0 shadow-[6px_8px_20px_0_#00000008]">
        @if (str_contains(Auth::user()->avatar, 'http'))
      <img src="{{ Auth::user()->avatar }}" class="w-full h-full object-cover object-center" alt="photo">
    @else
    <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover object-center"
    alt="photo">
  @endif
      @endauth
        </div>
        @auth
      <div class="flex flex-col gap-1">
        <p class="text-xs tracking-035">Welcome!</p>
        <p class="font-semibold">{{ Auth::user()->name }}</p>
      @endauth
        </div>
      </div>
      <a href="">
        <div
          class="w-12 h-12 rounded-full bg-white overflow-hidden flex shrink-0 items-center justify-center shadow-[6px_8px_20px_0_#00000008]">
          <img src="{{ asset('assets/icons/bell.svg') }}" alt="icon">
        </div>
      </a>
    </nav>
    <h1 class="font-semibold text-2xl leading-[36px] text-center">Explore New<br>Experience with Us</h1>
    <div id="categories" class="flex flex-col gap-3">
      <h2 class="font-semibold px-4">Categories</h2>
      <div class="main-carousel buttons-container">
        @foreach ($categories as $category)

      <a href="{{ route('categories', $category->slug) }}" class="group px-2 first-of-type:pl-4 last-of-type:pr-4">
        <div
        class="p-3 flex items-center gap-2 rounded-[10px] border border-[#4D73FF] group-hover:bg-[#4D73FF] transition-all duration-300">
        <div class="w-6 h-6 flex shrink-0">
          <img src="{{ Storage::url($category->icon) }}" alt="icon">
        </div>
        <span
          class="text-sm tracking-[0.35px] text-[#4D73FF] group-hover:text-white transition-all duration-300">{{ $category->name }}</span>
        </div>
      </a>
    @endforeach
      </div>
    </div>
    @if($recommendedTours->isNotEmpty())
    <div id="recommendations" class="flex flex-col gap-3">
      <h2 class="font-semibold px-4">Rekomendasi Untuk Kamu</h2>
      <div class="main-carousel card-container">
      @foreach($recommendedTours as $tour)
      <a href="{{ route('details', $tour->slug) }}" class="group px-2 first-of-type:pl-4 last-of-type:pr-4">
      <div class="w-[288px] p-4 flex flex-col gap-3 rounded-[26px] bg-white shadow-[6px_8px_20px_0_#00000008]">
      <div class="w-full h-[330px] rounded-xl flex shrink-0 overflow-hidden">
        <img src="{{ Storage::url($tour->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnails">
      </div>
      <div class="flex justify-between gap-2">
        <div class="flex flex-col gap-1">
        <p class="font-semibold two-lines">{{ $tour->name }}</p>
        <div class="flex items-center gap-1">
        <div class="w-4 h-4 flex shrink-0">
        <img src="{{ asset('assets/icons/location-map.svg') }}" alt="icon">
        </div>
        <span class="text-xs text-darkGrey tracking-035">{{ $tour->city->name }}, Indonesia</span>
        </div>
        </div>
        <div class="flex flex-col gap-1 text-right">
        <p class="text-sm leading-[21px]">
        <span class="font-semibold text-[#4D73FF] text-nowrap">Rp {{ number_format($tour->price) }}</span><br>
        <span class="text-darkGrey">/{{ $tour->days }}days</span>
        </p>
        <div class="flex items-center gap-1 justify-end">
        <div class="w-4 h-4 flex shrink-0">
        <img src="{{ asset('assets/icons/Star.svg') }}" alt="icon">
        </div>
        <span class="font-semibold text-sm leading-[21px]">4.8</span>
        </div>
        </div>
      </div>
      </div>
      </a>
    @endforeach
      </div>
    </div>
  @endif

    <div id="discover" class="px-4">
      <div class="w-full h-[130px] flex flex-col gap-[10px] rounded-[22px] items-center overflow-hidden relative">
        <img src="{{ asset('assets/backgrounds/Banner.png') }}" class="w-full h-full object-cover object-center"
          alt="background">
        <div class="absolute z-10 flex flex-col gap-[10px] transform -translate-y-1/2 top-1/2 left-4">
          <p class="text-white font-semibold">Discover the<br>Beauty of Japan</p>
          <a href=""
            class="bg-[#4D73FF] p-[8px_24px] rounded-[10px] text-white font-semibold text-xs w-fit">Discover</a>
        </div>
      </div>
    </div>

    <div id="categories" class="flex flex-col gap-3">
      <h2 class="font-semibold px-4">Choose your favorite city</h2>
      <div class="main-carousel buttons-container">
        @foreach ($cities as $city)

      <a href="{{ route('cities', $city->slug) }}" class="group px-2 first-of-type:pl-4 last-of-type:pr-4">
        <div
        class="p-3 flex items-center gap-2 rounded-[10px] border border-[#4D73FF] group-hover:bg-[#4D73FF] transition-all duration-300">
        <div class="w-6 h-6 flex shrink-0">
          <img src="{{ Storage::url($city->image) }}" class="rounded-full" alt="icon">
        </div>
        <span
          class="text-sm tracking-[0.35px] text-[#4D73FF] group-hover:text-white transition-all duration-300">{{ $city->name }}</span>
        </div>
      </a>
    @endforeach
      </div>
    </div>
    <div id="explore" class="flex flex-col px-4 gap-3">
      <h2 class="font-semibold">More to Explore</h2>
      @foreach ($tours as $tour)
      <a href="{{ route('details', $tour->slug) }}" class="card">
      <div class="bg-white p-4 flex flex-col gap-3 rounded-[26px] shadow-[6px_8px_20px_0_#00000008]">
        <div class="w-full h-full aspect-[311/150] rounded-xl overflow-hidden">
        <img src="{{ Storage::url($tour->thumbnail) }}" class="w-full h-full object-cover object-center"
          alt="thumbnail">
        </div>
        <div class="flex justify-between gap-2">
        <div class="flex flex-col gap-1">
          <p class="font-semibold two-lines">{{ $tour->name }}</p>
          <div class="flex items-center gap-1">
          <div class="w-4 h-4 flex shrink-0">
            <img src="assets/icons/location-map.svg" alt="icon">
          </div>
          <span class="text-xs text-darkGrey tracking-035">{{ $tour->city->name }}, Indonesia</span>
          </div>
        </div>
        <div class="flex flex-col gap-1 text-right">
          <p class="text-sm leading-[21px]">
          <span class="font-semibold text-[#4D73FF] text-nowrap">Rp {{ number_format($tour->price) }}</span><br>
          <span class="text-darkGrey">/{{ $tour->days }}days</span>
          </p>
          <div class="flex items-center gap-1 justify-end">
          <div class="w-4 h-4 flex shrink-0">
            <img src="assets/icons/Star.svg" alt="icon">
          </div>
          <span class="font-semibold text-sm leading-[21px]">4.8</span>
          </div>
        </div>
        </div>
      </div>
      </a>
    @endforeach
    </div>
    <div
      class="navigation-bar fixed bottom-0 z-50 max-w-[640px] w-full h-[85px] bg-white rounded-t-[25px] flex items-center justify-evenly py-[45px]">
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

      <a href="{{ route('dashboard.bookings') }}"
        class="menu {{ Route::currentRouteName() == 'dashboard.bookings' ? '' : 'opacity-25' }}">
        <div class="flex flex-col justify-center w-fit gap-1">
          <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
            <img src="{{ asset('assets/icons/calendar-blue.svg') }}" alt="icon">
          </div>
          <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Schedule</p>
        </div>
      </a>

      <a href="{{ route('profile.edit') }}"
        class="menu {{ Route::currentRouteName() == 'profile.edit' ? '' : 'opacity-25' }}">
        <div class="flex flex-col justify-center w-fit gap-1">
          <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
            <img src="{{ asset('assets/icons/user-flat.svg') }}" alt="icon">
          </div>
          <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Profile</p>
        </div>
      </a>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- JavaScript -->
  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  <script src="{{ asset('js/flickity-slider.js') }}"></script>
  <script src="{{ asset('js/two-lines-text.js') }}"></script>

</body>

</html>