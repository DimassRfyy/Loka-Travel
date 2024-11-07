<x-app-layout>
    <x-slot name="header">
        <div class="justify-between flex">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Bank') }}
            </h2>
            <a href="{{ route('admin.package_banks.create') }}" class="px-4 py-2 rounded-lg bg-blue-800 text-end text-white">Add Data</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm p-10 flex flex-col gap-y-5">
                <table class="table w-full">
                    <thead class="table-header-group ">
                        <tr class="table-row">
                            <th class="table-cell text-left">Logo</th>
                            <th class="table-cell text-left">Bank Name</th>
                            <th class="table-cell text-left">Bank Acount Number</th>
                            <th class="table-cell text-left">Bank Account Name</th>
                            <th class="table-cell text-left">Option</th>
                        </tr>
                    </thead>
                    @forelse($data as $bank)
                    <tbody class="table-row-group">
                        <tr class="table-row">
                            <td class="table-cell">
                                <img src="{{ Storage::url($bank->logo) }}" alt="" class="rounded2xl object-cover w-[90px] h-[90px]" 90px="">
                            </td>
                            <td class="table-cell">{{ $bank->bankname }}</td>
                            <td class="table-cell">{{ $bank->bankaccountnumber }}</td>
                            <td class="table-cell">{{ $bank->bankaccountname }}</td>
                            <td class="table-cell">
                                <a href="{{ route('admin.package_banks.edit',$bank->id) }}" class="px-4 py-2 rounded-lg bg-blue-800 text-white">Edit</a>
                                {{-- form delete --}}
                                <form action="{{ route('admin.package_banks.destroy',$bank->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-800 text-white">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @empty
                    <tbody class="table-row-group">
                        <tr class="table-row">
                            <td class="table-cell text-center" colspan="4">No data</td>
                        </tr>
                    </tbody>
                    @endforelse
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
