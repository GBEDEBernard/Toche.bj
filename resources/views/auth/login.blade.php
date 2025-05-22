<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Se connecter - Toché.bj</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-indigo-900 flex min-h-screen items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
        <h2 class="text-center mb-6">
            <img src="{{ asset('image/logo3.jpg') }}" alt="Toché" class="mx-auto rounded-full w-24 h-24 p-2" />
            <span class="block text-2xl font-bold text-gray-700 mt-4">Se connecter</span>
        </h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-600 text-sm font-semibold mb-1">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror" />
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-600 text-sm font-semibold mb-1">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror" />
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="text-blue-500 focus:ring-blue-400" />
                    <span class="ml-2 text-gray-600 text-sm">Remember Me</span>
                </label>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Forgot Password?</a>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-200">
                Login
            </button>
        </form>
    </div>
</body>
</html>
