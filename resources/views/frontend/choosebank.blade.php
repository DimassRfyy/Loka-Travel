<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-black">
    <section id="content" class="max-w-[640px] w-full mx-auto bg-[#F9F2EF] min-h-screen flex flex-col gap-8 pb-8">
      <nav class="mt-8 px-4 w-full flex items-center justify-between">
        <a href="{{ route('booking',$packageBooking->tour->slug) }}">
          <img src="{{ asset('assets/icons/back.png')}}" alt="back">
        </a>
        </a>
        <p class="text-center m-auto font-semibold">Checkout</p>
        <div class="w-12"></div>
      </nav>
      <div class="flex flex-1 flex-col h-full justify-center px-4 gap-8">
        <div class="px-[35px] w-full flex shrink-0">
          <img src="{{ asset('assets/backgrounds/Bank-Account-Illustration.png')}}" class="object-contain" alt="background">
        </div>
        <form action="{{ route('choose.bank.store',$packageBooking->id) }}" method="POST" class="flex flex-col gap-8">
        @csrf
        @method('PATCH')
          <div class="flex flex-col gap-3">
            <p class="font-semibold">Payment Method</p>

            @foreach ($banks as $item)
            <div class="bg-white p-[16px_24px] rounded-[26px]">
                <label for="bca" class="flex items-center justify-between">
                  <div class="flex items-center gap-3">
                    <div class="w-[35px] h-[25px] flex shrink-0 overflow-hidden">
                      <img src="{{ Storage::url($item->logo) }}" class="w-full h-full object-contain object-center" alt="logo">
                    </div>
                    <span class="text-sm tracking-035 leading-[22px]">{{ $item->bankname }} Transfer</span>
                  </div>
                  <input type="radio" name="bankname" id="bca" value="{{ $item->id }}" {{ $item->id === $packageBooking->packagebanksfk ? 'checked' : '' }}  class="w-5 h-5 appearance-none checked:border-[3px] checked:border-solid checked:border-white rounded-full checked:bg-[#6E5DE7] ring-2 ring-[#6E5DE7]">
                </label>
              </div>
            @endforeach

          </div>
          <button type="submit" class="p-[16px_24px] rounded-xl bg-blue w-full text-white text-center hover:bg-[#06C755] transition-all duration-300">Checkout</button>
        </form>
      </div>
    </section>
</body>
</html>
