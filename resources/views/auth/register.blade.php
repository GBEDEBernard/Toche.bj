<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>S'inscrire - Toché.bj</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-indigo-900 dark:bg-gray-900 flex min-h-screen items-center justify-center">
  <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h2 class="text-center mb-6">
      <img src="{{ asset('image/logo3.jpg') }}" alt="Toché" class="mx-auto rounded-full w-24 h-24 p-2" />
      <span class="block text-2xl font-bold text-gray-700 dark:text-gray-200 mt-4">Register</span>
    </h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="mb-4">
        <label for="name" class="block text-gray-600 dark:text-gray-300 text-sm font-semibold mb-1">Name</label>
        <div class="relative">
          <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
            class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('name') border-red-500 @enderror" />
          <span class="absolute left-3 top-3 text-gray-400">🧑</span>
        </div>
        @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="email" class="block text-gray-600 dark:text-gray-300 text-sm font-semibold mb-1">Email Address</label>
        <div class="relative">
          <input id="email" name="email" type="email" value="{{ old('email') }}" required
            class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('email') border-red-500 @enderror" />
          <span class="absolute left-3 top-3 text-gray-400">📧</span>
        </div>
        @error('email')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="password" class="block text-gray-600 dark:text-gray-300 text-sm font-semibold mb-1">Password</label>
        <div class="relative">
          <input id="password" name="password" type="password" required
            class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white dark:border-gray-600 @error('password') border-red-500 @enderror" />
          <span class="absolute left-3 top-3 text-gray-400">🔒</span>
        </div>
        @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="password-confirm" class="block text-gray-600 dark:text-gray-300 text-sm font-semibold mb-1">Confirm Password</label>
        <div class="relative">
          <input id="password-confirm" name="password_confirmation" type="password" required
            class="w-full px-4 py-2 pl-10 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:text-white dark:border-gray-600" />
          <span class="absolute left-3 top-3 text-gray-400">🔄</span>
        </div>
      </div>

      <button type="submit"
        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-200">
        Register
      </button>
    </form>
  </div>

  <script>
    const password = document.getElementById('password');
    const confirm = document.getElementById('password-confirm');

    confirm.addEventListener('input', () => {
      if (password.value !== confirm.value) {
        confirm.classList.add('border-red-500');
      } else {
        confirm.classList.remove('border-red-500');
      }
    });
  </script>
</body>
</html>
