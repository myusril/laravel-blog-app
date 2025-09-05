<x-auth-layout :title="$title">
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
                    alt="logo">
                Flowbite
            </a>
            <div class="w-full bg-white rounded-lg shadow sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Create an account
                    </h1>

                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form class="space-y-4 md:space-y-6" action="" method="POST">
                        @csrf
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                autocomplete="off" required>
                            <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500">Minimum 8 characters, 1
                                uppercase letter, and 1 special character.</p>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-900">Confirm
                                password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                autocomplete="off" required>
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-600"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create
                            an account</button>
                        <p class="text-sm font-light text-gray-500">
                            Already have an account? <a href="/login"
                                class="font-medium text-blue-600 hover:underline">Login
                                here</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </section>
</x-auth-layout>
