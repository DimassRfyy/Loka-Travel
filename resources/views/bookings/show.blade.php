<x-app-layout>
    <x-slot name="header">
        <div class="justify-between flex">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Bookings') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm p-10 flex flex-col gap-y-5">
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <h3 class="text-lg font-semibold">Package Image</h3>
                        <img src="{{ Storage::url($PackageBooking->tour->thumbnail) }}" alt="" class="rounded2xl object-cover w-[400px] h-[400px]" 90px="">
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Proof Image</h3>
                        <img src="{{ Storage::url($PackageBooking->proof) }}" alt="" class="rounded2xl object-cover w-[400px] h-[400px]" 90px="">
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Package Details</h3>
                        <p>Package Name: {{ $PackageBooking->tour->name }}</p>
                        <p>Package Price: {{ $PackageBooking->tour->price }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Customer Details</h3>
                        <p>Customer Name: {{ $PackageBooking->customer->name }}</p>
                        <p>Customer Email: {{ $PackageBooking->customer->email }}</p>
                        <p>Customer Phone: {{ $PackageBooking->customer->phonenumber }}</p>
                    </div>
                </div>
                @if ($PackageBooking->ispaid == 0)
                <div class="flex justify-end">
                    <form action="{{ route('admin.package_bookings.update', $PackageBooking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="ispaid" value="2">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Approve</button>
                    </form>
                </div> 
                @endif
                @if ($PackageBooking->ispaid == 1)
                <div class="flex justify-end">
                    <form action="{{ route('admin.package_bookings.update', $PackageBooking->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="ispaid" value="2">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Approve</button>
                    </form>
                </div> 
                @else
                
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
