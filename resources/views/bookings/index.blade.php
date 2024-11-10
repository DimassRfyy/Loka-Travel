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
                    {{-- <div class="item-card flex flex-row justify-betwen items-center">
                        <div class="flex flex-row item-center gap-x-3">
                            <img src="" alt="" class="rounded2xl object-cover w-[90px] h-[90px]" 90px="">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 text-xl font-bold">
                                    Cate Name
                                </h3>
                            </div>
                        </div>

                        <div class="hidden md:flex flex-col ">
                            <p class="text-slate-500"> Date </p>
                            <h3 class="text-indigo-900 text-xl font-bold"> Date </h3>
                        </div>
                    </div> --}}

                    <table class="table w-full">
                        <thead class="table-header-group ">
                            <tr class="table-row">
                                <th class="table-cell text-left">Thumbnail</th>
                                <th class="table-cell text-left">Name</th>
                                <th class="table-cell text-left">Payment</th>
                                <th class="table-cell text-left">Total Price</th>
                                <th class="table-cell text-left">Tanggal</th>
                                <th class="table-cell text-left">Customer</th>
                                <th class="table-cell text-left">Option</th>
                            </tr>
                        </thead>
                        @forelse($PackageBookings as $item)
                        <tbody class="table-row-group">
                            <tr class="table-row">
                                <td class="table-cell">
                                    <img src="{{ Storage::url($item->tour->thumbnail) }}" alt="" class="rounded2xl object-cover w-[90px] h-[90px]" 90px="">
                                </td>
                                <td class="table-cell">{{ $item->tour->name }}</td>
                                <td class="table-cell">
                                    @if($item->ispaid == 0)
                                        <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 font-medium text-red-600 ring-1 ring-inset ring-red-500/10">Unpaid</span>
                                    @elseif($item->ispaid == 1)
                                        <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 font-medium text-yellow-600 ring-1 ring-inset ring-yellow-500/10">Process</span>
                                    @elseif($item->ispaid == 2)
                                        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 font-medium text-green-600 ring-1 ring-inset ring-green-500/10">Success</span>
                                    @endif
                                </td>
                                <td class="table-cell"> {{ number_format($item->totalamount) }} </td>
                                <td class="table-cell"> {{ \Carbon\Carbon::parse($item->startdate)->locale('id')->isoFormat('D MMMM Y') }} - {{ \Carbon\Carbon::parse($item->enddate)->locale('id')->isoFormat('D MMMM Y') }} </td>
                                <td class="table-cell"> {{ $item->customer->name }} </td>

                                <td class="table-cell">
                                    <a href="{{ route('admin.package_bookings.show',$item->id) }}" class="px-4 py-2 rounded-lg bg-blue-800 text-white">Show Details</a>
                                    {{-- form delete --}}
                                    {{-- <form action="{{ route('admin.categories.destroy',$item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 rounded-lg bg-red-800 text-white">Delete</button>
                                    </form> --}}
                                </td>
                            </tr>
                        </tbody>
                        @empty
                        <tbody class="table-row-group">
                            <tr class="table-row">
                                <td class="table-cell text-center" colspan="3">No data</td>
                            </tr>
                        </tbody>
                        @endforelse
                    </table>
            </div>
        </div>
    </div>

</x-app-layout>
