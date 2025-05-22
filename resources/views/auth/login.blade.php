
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toché.bj</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="flex min-h-screen items-center justify-center bg-indigo-900">
    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">
        <h2 class="text-center text-2xl font-bold text-gray-700 mb-6">     
        <img class="w-24 h-24 p-2 ml-[150px] rounded-full" src="{{ asset('image/logo3.jpg')}}" alt="Toché">  
        Login
        </h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="block text-gray-600 text-sm font-semibold mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-600 text-sm font-semibold mb-1">Password</label>
                <input id="password" type="password" name="password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="text-blue-500 focus:ring-blue-400">
                    <span class="ml-2 text-gray-600 text-sm">Remember Me</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Forgot Password?</a>
                @endif
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-200">
                Login
            </button>
        </form>
    </div>
</div>
</body>
