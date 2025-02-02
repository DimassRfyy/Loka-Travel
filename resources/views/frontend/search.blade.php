<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('output.css') }}" rel="stylesheet">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
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
        
        <div class="flex flex-col items-center px-4 mt-6">
            <form action="{{ route('search.result') }}" method="GET" class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg flex flex-col gap-4">
                <div>
                    <label for="search-name" class="block text-sm font-medium text-gray-700 mb-2">Search Package Tour</label>
                    <input type="text" id="search-name" name="name" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter package name">
                </div>
                
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select id="category" name="category" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                    <select id="city" name="city" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select City</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="bg-[#4D73FF] p-[16px_24px] w-full text-white rounded-full font-semibold hover:bg-[#06C755] transition-all duration-300">Search</button>
            </form>
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