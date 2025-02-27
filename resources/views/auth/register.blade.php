@extends('bloglayout')

@section('contenu')
<div class="flex min-h-screen items-center justify-center bg-gray-100 dark:bg-gray-900">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h2 class="text-center text-2xl font-bold text-gray-700 dark:text-gray-200 mb-6">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-gray-600 dark:text-gray-300 text-sm font-semibold mb-1">Name</label>
                <div class="relative">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                        class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('name') border-red-500 @enderror">
                    <span class="absolute left-3 top-3 text-gray-400">🧑</span>
                </div>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-600 dark:text-gray-300 text-sm font-semibold mb-1">Email Address</label>
                <div class="relative">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                        class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('email') border-red-500 @enderror">
                    <span class="absolute left-3 top-3 text-gray-400">📧</span>
                </div>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-600 dark:text-gray-300 text-sm font-semibold mb-1">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required 
                        class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('password') border-red-500 @enderror">
                    <span class="absolute left-3 top-3 text-gray-400">🔒</span>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password-confirm" class="block text-gray-600 dark:text-gray-300 text-sm font-semibold mb-1">Confirm Password</label>
                <div class="relative">
                    <input id="password-confirm" type="password" name="password_confirmation" required 
                        class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    <span class="absolute left-3 top-3 text-gray-400">🔄</span>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-200">
                Register
            </button>
        </form>
    </div>
</div>

<script>
    document.getElementById('password-confirm').addEventListener('input', function() {
        let password = document.getElementById('password').value;
        let confirmPassword = this.value;
        if (password !== confirmPassword) {
            this.classList.add('border-red-500');
        } else {
            this.classList.remove('border-red-500');
        }
    });
</script>
@endsection
