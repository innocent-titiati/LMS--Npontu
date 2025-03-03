<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NpontuLMS</title>
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
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <div class="flex justify-between items-center mb-6">
                <div class="logo"></div>
                <button class="close-btn"></button>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 mb-6">Create Account</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="first_name" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                               value="{{ old('first_name') }}">
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="last_name" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                               value="{{ old('last_name') }}">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm"
                           value="{{ old('email') }}">
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role" id="role" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                   bg-white focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                        <option value="hr" {{ old('role') == 'hr' ? 'selected' : '' }}>HR</option>
                        <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                    </select>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                </div>

                @if ($errors->any())
                    <div class="text-red-500 text-sm mt-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex items-center">
                    <input type="checkbox" name="terms" id="terms" required 
                           class="checkbox-custom">
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        I agree to the Terms of Service and Privacy Policy
                    </label>
                </div>

                <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    Create Account
                </button>
            </form>

            <p class="mt-4 text-center text-sm text-gray-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Sign in
                </a>
            </p>
        </div>
    </div>
</body>
</html>
