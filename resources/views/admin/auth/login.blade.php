<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin Yayasan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .input-field:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-800 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div
                class="w-20 h-20 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                <i class="fas fa-building text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-white">Admin Yayasan</h1>
            <p class="text-indigo-200 mt-2">Silakan login untuk melanjutkan</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="input-field w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('email') border-red-500 @enderror"
                            placeholder="admin@yayasan.com" required>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center">
                            <i class="fas fa-lock text-gray-400"></i>
                        </span>
                        <input type="password" name="password"
                            class="input-field w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none @error('password') border-red-500 @enderror"
                            placeholder="••••••••" required>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary w-full py-3 rounded-lg text-white font-semibold text-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-6 p-4 bg-indigo-50 rounded-lg border border-indigo-100">
                <p class="text-xs text-indigo-800 font-medium mb-2">🔑 Demo Credentials:</p>
                <p class="text-xs text-indigo-700">Email: <code class="bg-white px-1 rounded">admin@yayasan.com</code>
                </p>
                <p class="text-xs text-indigo-700">Password: <code class="bg-white px-1 rounded">password123</code></p>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-indigo-300 text-sm mt-8">
            &copy; {{ date('Y') }} Yayasan Management System. All rights reserved.
        </p>
    </div>

</body>

</html>
