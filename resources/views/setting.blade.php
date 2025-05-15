@extends('layout')

@section('content')
    <div class="w-full mx-auto p-6 bg-white shadow-md rounded-xl">
        {{-- Success or alert message here --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-5" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            {{-- Error message here --}}
        @elseif (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="p-6 space-y-10">
            {{-- Top Form Row --}}
            <div class="flex flex-row justify-between gap-12 w-full">
                {{-- Form 1 --}}
                <form action="{{ route('settingsStore') }}" method="POST"
                    class="space-y-2 w-full flex justify-center items-center flex-col">
                    @csrf
                    {{-- title input  --}}
                    <div class="w-full mb-5">
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">Title</h1>
                        <input type="text" name="title"
                            placeholder="{{ !empty($settingsData->title) ? '' : 'Input title' }}"
                            value="{{ $settingsData->title ?? '' }}" class="border p-2 rounded w-full">

                    </div>
                    {{-- footer input  --}}
                    <div class="w-full mt-5 mb-10">
                        <h1 class="text-2xl font-bold text-gray-800 mb-2 mt-5">Footer</h1>
                        <input type="text" name="footer"
                            placeholder="{{ !empty($settingsData->footer) ? '' : 'Input footer' }}"
                            value="{{ $settingsData->footer ?? '' }}" class="border p-2 rounded w-full mb-10">

                    </div>
                    {{-- Submit button  --}}
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Submit</button>
                </form>
            </div>

        </div>

    </div>
@endsection
