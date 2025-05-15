@extends('layout')

@section('content')
<div class="w-full mx-auto p-6 bg-white shadow-md rounded-xl">
    <!-- Profile Card -->
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow">

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

        <div class="flex items-center justify-center space-x-4">
            <div class="mr-4">
                @if (!empty(Auth::user()->profile->profile_picture))
                    <img class="w-16 h-16 rounded-full object-cover"
                        src="{{ asset('storage/' . Auth::user()->profile->profile_picture) }}"
                        alt="Profile Image">
                @else
                    <img class="w-16 h-16 rounded-full object-cover"
                        src="https://a0.anyrgb.com/pngimg/1784/296/client-icon-login-avatar-user-light-service-orange-business-icons-circle.png"
                        alt="Profile Image">
                @endif
            </div>
            <div class="flex items-center justify-center flex-col">
                <h2 class="text-xl font-semibold text-gray-800 pt-2 uppercase">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500">
                    @if (!empty(Auth::user()->profile->bio))
                        {{ Auth::user()->profile->bio }}
                    @endif
                </p>
            </div>
        </div>

        <div class="mt-6 space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-600 font-medium">Email:</span>
                <span class="text-gray-800">{{ Auth::user()->email }}</span>
            </div>

            {{-- //show phone number if it is not empty --}}
            <div class="flex justify-between">
                <span class="text-gray-600 font-medium">Phone:</span>
                <span class="text-gray-800">
                    @if (!empty(Auth::user()->profile->phone))
                        {{ Auth::user()->profile->phone }}
                    @endif
                </span>
            </div>

            {{-- //show address if it is not empty --}}
            <div class="flex justify-between">
                <span class="text-gray-600 font-medium">Location:</span>
                <span class="text-gray-800">
                    @if (!empty(Auth::user()->profile->address))
                        {{ Auth::user()->profile->address }}
                    @endif
                </span>
            </div>

            {{-- //show created at if it is not empty --}}
            <div class="flex justify-between">
                <span class="text-gray-600 font-medium">Member Since:</span>
                <span class="text-gray-800">{{ Auth::user()->created_at }}</span>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-10 flex justify-center space-x-4">
        <a href="{{ route('changePassword')}}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-blue-500 text-blue-500 font-medium rounded-lg hover:bg-blue-50 transition-colors duration-300">
            Change Password
        </a>
        <a href="{{ route('editProfile')}}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-purple-500 text-purple-500 font-medium rounded-lg hover:bg-purple-50 transition-colors duration-300">
            Edit Profile
        </a>
    </div>
</div>
@endsection
