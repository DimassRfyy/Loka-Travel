<x-app-layout>
    <x-slot name="header">
        <div class="justify-between flex">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Bank') }}
            </h2>
            <a href="{{ route('admin.package_banks.create') }}" class="px-4 py-2 rounded-lg bg-blue-800 text-end text-white">Add Data</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm p-10 flex flex-col gap-y-5">

                {{-- form create --}}
                <form action="{{ route('admin.package_banks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col gap-y-5">

                        <div class="flex flex-col gap-y-2">
                            <label for="bankname" class="text-lg">Bank Name</label>
                            <input type="text" name="bankname" id="bankname" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('name') }}">
                            {{-- if error --}}
                            @error('bankname')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-y-2">
                            <label for="bankaccountnumber" class="text-lg">Bank Account Number</label>
                            <input type="number" name="bankaccountnumber" id="bankaccountnumber" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('name') }}">
                            {{-- if error --}}
                            @error('bankaccountnumber')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-y-2">
                            <label for="bankaccountname" class="text-lg">Bank Account Name</label>
                            <input type="text" name="bankaccountname" id="bankaccountname" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('name') }}">
                            {{-- if error --}}
                            @error('bankaccountname')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-y-2">
                            <label for="logo" class="text-lg">Logo</label>
                            <input type="file" name="logo" id="logo" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500">
                            {{-- if error --}}
                            @error('logo')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <button type="submit" class="px-4 py-2 rounded-lg bg-blue-800 text-white">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
