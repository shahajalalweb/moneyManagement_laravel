@extends('layout')

@section('content')
    @if (request()->routeIs('editProfile'))
        <div class="w-full mx-auto mt-1 bg-white p-6 rounded-lg shadow">
            <form method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data">
                @csrf

                <!-- Profile Image Upload -->
                <div class="flex flex-col items-center mb-6">
                    <div class="relative mb-4">
                        <img id="profileImagePreview" class="w-32 h-32 rounded-full object-cover border-2 border-gray-200"
                            src="{{ Auth::user()->profile->profile_picture ? asset('storage/' . Auth::user()->profile->profile_picture) : 'https://a0.anyrgb.com/pngimg/1784/296/client-icon-login-avatar-user-light-service-orange-business-icons-circle.png' }}"
                            alt="Profile Image">

                        <label for="avatar"
                            class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-md cursor-pointer hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <input type="file" id="avatar" name="profile_picture" class="hidden" accept="image/*">
                        </label>
                    </div>
                    <p class="text-sm text-gray-500">Click the camera icon to change photo</p>
                    @error('avatar')
                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                    @enderror
                </div>
                {{-- //NAME FILED --}}
                <div class="mb-4">
                    <label for="name" class="block text-gray-600 font-medium mb-2">Full Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('name', Auth::user()->name) }}" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label class="block text-gray-600 font-medium mb-2">Email</label>
                    <div class="w-full px-4 py-2 border rounded-lg bg-gray-100">
                        {{ Auth::user()->email }}
                    </div>
                    <p class="text-sm text-gray-500 mt-1">You can't change Email</p>
                </div>

                <!-- Phone Field -->
                <div class="mb-4">
                    <label for="phone" class="block text-gray-600 font-medium mb-2">Phone Number</label>
                    <input type="tel" id="phone" name="phone"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('phone', optional(Auth::user()->profile)->phone) }}"
                        placeholder="Enter your phone number">
                    @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address Field -->
                <div class="mb-4">
                    <label for="address" class="block text-gray-600 font-medium mb-2">Address</label>
                    <textarea id="address" name="address" rows="3"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your full address">{{ old('address', optional(Auth::user()->profile)->address) }}</textarea>
                    @error('address')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Bio Field -->
                <div class="mb-4">
                    <label for="bio" class="block text-gray-600 font-medium mb-2">Bio</label>
                    <textarea id="bio" name="bio" rows="3"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('bio', optional(Auth::user()->profile)->bio) }}</textarea>
                    @error('bio')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Update Profile
                    </button>
                </div>

            </form>
        </div>

        <script>
            // Preview uploaded image - corrected version
            document.getElementById('avatar').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        document.getElementById('profileImagePreview').src = event.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @else
        <div class="w-full mx-auto p-6 bg-white shadow-md rounded-xl">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Change Password
                </h2>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <form class="space-y-6" action="{{ route('changePass') }}" method="POST">
                        @csrf
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">
                                Current Password
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input id="current_password" name="current_password" type="password" required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Enter your current password">
                            </div>
                        </div>

                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700">
                                New Password
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input id="new_password" name="new_password" type="password" required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Enter your new password">
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                Must be at least 8 characters long.
                            </p>
                        </div>

                        <div>
                            <label for="confirm_password" class="block text-sm font-medium text-gray-700">
                                Confirm New Password
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input id="confirm_password" name="new_password_confirmation" type="password" required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="Confirm your new password">
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
