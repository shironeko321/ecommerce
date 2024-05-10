<x-guest-layout>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="pt-4 pb-2">
      <h5 class="text-center pb-0 text-2xl text-blue-900 font-bold">Login to Your Account</h5>
      <p class="text-center">Enter your username & password to login</p>
    </div>

    <!-- Email Address -->
    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
        :value="old('email')" required autofocus autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
        required autocomplete="current-password" />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
      <label for="remember_me" class="inline-flex items-center">
        <input id="remember_me" type="checkbox"
          class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 "
          name="remember">
        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
      </label>
    </div>

    <div class="flex items-center justify-end mt-4">
      <x-primary-button class="w-full justify-center">
        {{ __('Log in') }}
      </x-primary-button>
    </div>

    @if (Route::has('password.request'))
      <p class="mb-0 text-center">
        <a class="underline text-sm text-blue-600  hover:text-blue-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 "
          href="{{ route('password.request') }}">
          {{ __('Forgot your password?') }}
        </a>
      </p>
    @endif
    <p class="mb-0 text-center">Don't have account? <a href="{{ route('register') }}"
        class="underline text-sm text-blue-600  hover:text-blue-900 rounded-md focus:outline-none  focus:ring-indigo-500 ">Create
        an
        account</a>
    </p>

  </form>
</x-guest-layout>
