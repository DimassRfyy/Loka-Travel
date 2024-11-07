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
          <a href="{{ url()->previous() }}">
            <img src="{{ asset('assets/icons/back.png') }}" alt="back">
          </a>
          </a>
          <p class="text-center m-auto font-semibold">Schedule</p>
          <div class="w-12"></div>
        </nav>
        <div class="flex flex-col gap-3 px-4">
          <p class="font-semibold">My Packages</p>
          @forelse ($bookings as $item)

          <a href="{{ route('dashboard.booking.details',$item->id) }}" class="card">
            <div class="bg-white p-4 rounded-[26px] flex items-center gap-4">
            <p class="text-center text-sm leading-[22px] tracking-035"><span class="font-semibold text-2xl">{{ \Carbon\Carbon::parse($item->startdate)->format('d') }}</span> <br> {{ \Carbon\Carbon::parse($item->startdate)->format('M') }} <br> {{ \Carbon\Carbon::parse($item->startdate)->format('Y') }}</p>
              <div class="flex items-center gap-4">
                <div class="w-[92px] h-[92px] flex shrink-0 rounded-xl overflow-hidden">
                  <img src="{{ Storage::url($item->tour->thumbnail) }}" class="w-full h-full object-cover object-center" alt="thumbnail">
                </div>
                <div class="flex flex-col gap-1">
                    <p class="font-semibold text-sm tracking-035 leading-[22px]">{{ $item->tour->name }}</p>
                    <p class="text-sm leading-[22px] tracking-035 text-darkGrey">{{ $item->tour->days }} days | {{ $item->quantity }} packs</p>
                    @if ($item->ispaid == 0)
                        <div class="process-badge w-fit border border-[#FCD34D] p-[4px_8px] rounded-lg bg-[#FFFBEA] flex items-center justify-center">
                            <span class="text-xs leading-[22px] tracking-035 text-[#F59E0B]">Process Paid</span>
                        </div>
                    @elseif ($item->ispaid == 1)
                        <div class="success-badge w-fit border border-[#60A5FA] p-[4px_8px] rounded-lg bg-[#EFF6FF] flex items-center justify-center">
                            <span class="text-xs leading-[22px] tracking-035 text-[#2563EB]">Success Paid</span>
                        </div>
                    @endif
                </div>
              </div>
            </div>
          </a>
          @empty
              Belum memiliki jadwal
          @endforelse

        </div>
        <div class="navigation-bar fixed bottom-0 z-50 max-w-[640px] w-full h-[85px] bg-white rounded-t-[25px] flex items-center justify-evenly py-[45px]">
          <a href="{{ route('home') }}" class="menu opacity-25">
            <div class="flex flex-col justify-center w-fit gap-1">
              <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                <img src="{{ asset('assets/icons/home.svg') }}" alt="icon">
              </div>
              <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Home</p>
            </div>
          </a>
          <a href="" class="menu opacity-25">
            <div class="flex flex-col justify-center w-fit gap-1">
              <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                <img src="{{ asset('assets/icons/search.svg') }}" alt="icon">
              </div>
              <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Search</p>
            </div>
          </a>
          <a href="{{ route('dashboard.bookings') }}" class="menu">
            <div class="flex flex-col justify-center w-fit gap-1">
              <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                <img src="{{ asset('assets/icons/calendar-blue.svg') }}" alt="icon">
              </div>
              <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Schedule</p>
            </div>
          </a>
          <a href="{{ route('profile.edit') }}" class="menu opacity-25">
            <div class="flex flex-col justify-center w-fit gap-1">
              <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                <img src="{{ asset('assets/icons/user-flat.svg') }}" alt="icon">
              </div>
              <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Profile</p>
            </div>
          </a>
        </div>
    </section>
</body>
</html>
