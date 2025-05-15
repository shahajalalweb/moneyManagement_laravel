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
            <div class="flex flex-col justify-between gap-12 w-full">
                {{-- Form 1 --}}
                <form action="{{ route('cost-category.create')}}" method="POST" class="space-y-2 w-full">
                    <h1 class="text-2xl font-bold text-gray-800"> Cost Category </h1>
                    @csrf
                    <input type="text" name="name" placeholder="Enter category"
                        class="border p-2 rounded w-full mb-2 required">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-5">Submit</button>
                </form>

                {{-- Table 1 --}}
                <div class="w-full">
                    <h2 class="text-lg font-semibold mb-2">Category List </h2>
                    <table class="w-full border text-sm mb-8">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">category</th>
                                <th class="border p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($costCategories as $category)
                                <tr>
                                    <td class="border p-2">{{ $category->name }}</td>
                                    <td class="border p-2 flex items-center justify-center">
                                        <a onclick="return confirm('আপনি কি নিশ্চিতভাবে ডিলিট করতে চান?');"
                                            class="text-red-400" href="{{ route('cost-category.delete', $category->id) }}">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    @endsection
