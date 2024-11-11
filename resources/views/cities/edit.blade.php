<x-app-layout>
    <x-slot name="header">
        <div class="justify-between flex">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('City') }}
            </h2>
            <a href="{{ route('admin.cities.index') }}" class="px-4 py-2 rounded-lg bg-blue-800 text-end text-white">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm p-10 flex flex-col gap-y-5">
                {{-- form create --}}
                <form action="{{ route('admin.cities.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col gap-y-5">
                        <div class="flex flex-col gap-y-2">
                            <label for="name" class="text-lg">Name</label>
                            <input type="text" name="name" id="name" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ $data->name }}">
                            {{-- if error --}}
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col gap-y-2">
                            <label for="image" class="text-lg">image</label>
                            <input type="file" name="image" id="image" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500">
                            {{-- if error --}}
                            @error('image')
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
