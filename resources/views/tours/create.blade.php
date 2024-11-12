<x-app-layout>
    <x-slot name="header">
        <div class="justify-between flex">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Tour') }}
            </h2>
            <a href="{{ route('admin.package_tours.create') }}" class="px-4 py-2 rounded-lg bg-blue-800 text-end text-white">Add Data</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm p-10 flex flex-col gap-y-5">

                {{-- form create --}}
                <form action="{{ route('admin.package_tours.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col gap-y-5">
                        {{-- category --}}
                        <div class="flex flex-col gap-y-2">
                            <label for="categoriesfk" class="text-lg">Category</label>
                            <select name="categoriesfk" id="categoriesfk" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500">
                                <option hidden>Select Category</option>
                                @foreach ($categories as $category)
                                    <option class="py-4" value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            {{-- if error --}}
                            @error('categoriesfk')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-y-2">
                            <label for="citiesfk" class="text-lg">City</label>
                            <select name="citiesfk" id="citiesfk" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500">
                                <option hidden>Select City</option>
                                @foreach ($cities as $city)
                                    <option class="py-4" value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            {{-- if error --}}
                            @error('citiesfk')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-y-2">
                            <label for="name" class="text-lg">Name</label>
                            <input type="text" name="name" id="name" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('name') }}">
                            {{-- if error --}}
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-y-2">
                            <label for="price" class="text-lg">Price</label>
                            <input type="number" name="price" id="price" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('price') }}">
                            {{-- if error --}}
                            @error('price')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-y-2">
                            <label for="days" class="text-lg">Days</label>
                            <input type="number" name="days" id="days" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('days') }}">
                            {{-- if error --}}
                            @error('days')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-y-2">
                            <label for="about" class="text-lg">About</label>
                            <textarea type="text" name="about" id="about" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500" value="{{ old('about') }}"></textarea>
                            {{-- if error --}}
                            @error('about')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-y-2">
                            <label for="thumbnail" class="text-lg">Thumbnail</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500">
                            {{-- if error --}}
                            @error('thumbnail')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        @for ($i = 0; $i < 3; $i++)
                            <div class="flex flex-col gap-y-2">
                                <label for="photos[]" class="text-lg">Photos</label>
                                <input type="file" name="photos[]" id="photos[]" class="rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-blue-500">
                                {{-- if error --}}
                                @error('photos[]')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @endfor

                        <div class="flex flex-col gap-y-2">
                            <button type="submit" class="px-4 py-2 rounded-lg bg-blue-800 text-white">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
