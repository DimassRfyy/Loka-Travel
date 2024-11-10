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
            <img src="{{  asset('assets/icons/back.png')  }}" alt="back">
          </a>
          <p class="text-center m-auto font-semibold">Trip Details</p>
          <div class="w-12"></div>
        </nav>
        <div class="flex flex-col gap-8">
          <div class="flex flex-col gap-3 px-4 ">
            <p class="font-semibold">Detail Trip</p>
            <div class="bg-white p-4 rounded-[26px] flex items-center gap-3">
              <div class="w-[72px] h-[72px] flex shrink-0 rounded-xl overflow-hidden">
                <img src="{{  Storage::url($packagebooking->tour->thumbnail)  }}" class="w-full h-full object-cover object-center" alt="thumbnail">
              </div>
              <div class="flex flex-col gap-1">
                <p class="font-semibold text-sm tracking-035 leading-[22px]">{{ $packagebooking->tour->name }}</p>
                <div class="flex gap-1 items-center">
                  <div class="w-4 h-4">
                    <img src="{{  asset('assets/icons/calendar-grey.svg')  }}" class="w-4 h-4" alt="icon">
                  </div>
                <span class="text-darkGrey text-sm tracking-035 leading-[22px]">{{ $packagebooking->startdate->format('d M Y') }} - {{ $packagebooking->enddate->format('d M Y') }}</span>
                </div>
                @if($packagebooking->ispaid == 2)
                <div class="success-badge w-fit border border-[#60A5FA] p-[4px_8px] rounded-lg bg-[#EFF6FF] flex items-center justify-center">
                  <span class="text-xs leading-[22px] tracking-035 text-[#2563EB]">Success Paid</span>
                </div>
                @elseif ($packagebooking->ispaid == 1)
                <div class="pending-badge w-fit border border-[#FCD34D] p-[4px_8px] rounded-lg bg-[#FFFBEA] flex items-center justify-center">
                  <span class="text-xs leading-[22px] tracking-035 text-[#F59E0B]">Confirmation Process</span>
                </div>
                @else
                <div class="pending-badge w-fit border bg-red p-[4px_8px] rounded-lg bg-[#FFFBEA] flex items-center justify-center">
                  <span class="text-xs leading-[22px] tracking-035 text-white">Not Yet Paid</span>
                </div>
                @endif
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-3 px-4 ">
            <p class="font-semibold">Contact Details</p>
            <div class="bg-white p-[16px_24px] rounded-[26px] flex flex-col gap-3">
              <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                <p>Name</p>
                <p class="font-semibold">{{ $packagebooking->customer->name }}</p>
              </div>
              <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                <p>Email</p>
                <p class="font-semibold">{{ $packagebooking->customer->email }}</p>
              </div>
              <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                <p>Phone</p>
                <p class="font-semibold">{{ $packagebooking->customer->phonenumber }}</p>
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-3 px-4 ">
            <p class="font-semibold">Payment Summary</p>
            <div class="bg-white p-[16px_24px] rounded-[26px] flex flex-col gap-3">
              <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                <p>Sub Total</p>
                <p id="subtotal" class="font-semibold text-blue">Rp {{ number_format($packagebooking->subtotal) }}</p>
              </div>
              <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                <p>Insurance <span class="text-darkGrey">x<span id="total_quantity">2</span></span></p>
                <p id="insurance" class="font-semibold text-blue">Rp {{ number_format($packagebooking->insurance) }}</p>
              </div>
              <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                <p>Tax 10%</p>
                <p id="tax" class="font-semibold text-blue">Rp {{ number_format($packagebooking->tax) }}</p>
              </div>
              <hr>
              <div class="flex justify-between items-center text-sm tracking-035 leading-[22px] h-[55px]">
                <p>Total Payment</p>
                <p id="tax" class="font-semibold text-lg tracking-[0.6px]">Rp {{ number_format($packagebooking->totalamount) }}</p>
              </div>
            </div>
          </div>

          @if ($packagebooking->ispaid == 0)
          <div class="flex gap-3 px-4 ">
            <a href="home.html" class="p-[16px_24px] rounded-xl text-sm bg-red w-full text-white text-center flex items-center justify-center gap-3 transition-all duration-300">
              <span>Cancel Payment</span>
            </a>
            <a href="home.html" class="p-[16px_24px] rounded-xl text-sm bg-blue w-full text-white text-center flex items-center justify-center gap-3  hover:bg-[#06C755] transition-all duration-300">
              <span>Continue Payment</span>
            </a>
          </div>
          @else
          <div class="flex flex-col gap-3 px-4 ">
            <a href="home.html" class="p-[16px_24px] rounded-xl bg-blue w-full text-white text-center flex items-center justify-center gap-3  hover:bg-[#06C755] transition-all duration-300">
              <div class="w-6 h-6">
                <img src="{{  asset('assets/icons/messages.svg')  }}" alt="icon">
              </div>
              <span>Contact Travel Agent</span>
            </a>
          </div>
          @endif
        </div>
    </section>
</body>
</html>
