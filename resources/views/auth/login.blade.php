<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NpontuLMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .checkbox-custom {
            width: 12px;
            height: 12px;
            background-image: url('/images/sign_in_sign_up/u12.svg');
        }
        .checkbox-custom:checked {
            background-image: url('/images/sign_in_sign_up/u12_selected.svg');
        }
        .checkbox-custom:hover:not(:checked) {
            background-image: url('/images/sign_in_sign_up/u12_mouseOver.svg');
        }
        .checkbox-custom:disabled {
            background-image: url('/images/sign_in_sign_up/u12_disabled.svg');
        }
        .close-btn {
            background-image: url('/images/sign_in_sign_up/u44.svg');
            width: 23px;
            height: 23px;
        }
        .logo {
            background-image: url('/images/sign_in_sign_up/logo_u45.svg');
            width: 216px;
            height: 70px;
            background-size: contain;
            background-repeat: no-repeat;
        }
        /* Custom select styling */
        .select-wrapper {
            position: relative;
        }
        .select-wrapper::after {
            content: '';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #6B7280;
            pointer-events: none;
        }
        .custom-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: white;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <div class="flex justify-between items-center mb-6">
                <div class="logo"></div>
                <button class="close-btn"></button>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-6">Sign In</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

    

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" 
                           class="checkbox-custom">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>

                <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Sign In
                </button>
            </form>

            <p class="mt-4 text-center text-sm text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Sign up
                </a>
            </p>
        </div>
    </div>
</body>
</html>
