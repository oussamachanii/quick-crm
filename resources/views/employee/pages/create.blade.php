@extends('employee.layouts.guest')
@section('content')

  <h1 class="text-2xl font-bold p-4 text-center uppercase text-gray-800">Hello {{ $invitation->getName() }}</h1>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')"/>

  <form method="POST" action="{{ route('invitation.submit') }}" class="grid gap-4">
    @csrf
    <input type="hidden" value="{{ $invitation->getToken() }}" name="token">

    <!-- Email Address -->
    <div>
      <x-input-label for="email" :value="__('Email')"/>
      <x-text-input id="email"
                    class="block mt-1 w-full bg-gray-100"
                    type="email"
                    name="email"
                    value="{{ $invitation->getEmail() }}"
                    required
                    disabled
                    autofocus autocomplete="email"/>
      <x-input-error :messages="$errors->get('email')" class="mt-2"/>
    </div>
    <div>
      <x-input-label for="name" :value="__('Name')"/>
      <x-text-input id="name" class="block mt-1 w-full bg-gray-100" type="text" name="name" value="{{ $invitation->getName() }}"
                    required
                    disabled
                    autofocus autocomplete="username"/>
      <x-input-error :messages="$errors->get('Name')" class="mt-2"/>
    </div>
    <div>
      <x-input-label for="address" :value="__('Address')"/>
      <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                    required
                    autofocus autocomplete="address"/>
      <x-input-error :messages="$errors->get('address')" class="mt-2"/>
    </div>

    <div>
      <x-input-label for="phone" :value="__('phone')"/>
      <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')"
                    required
                    autofocus autocomplete="phone"/>
      <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
    </div>

    <div>
      <x-input-label for="birthdate" :value="__('birthdate')"/>
      <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')"
                    required
                    autofocus autocomplete="birthdate"/>
      <x-input-error :messages="$errors->get('birthdate')" class="mt-2"/>
    </div>

    <!-- Password -->
    <div>
      <x-input-label for="password" :value="__('Password')"/>

      <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password"/>

      <x-input-error :messages="$errors->get('password')" class="mt-2"/>
    </div>

    <div class="flex items-center justify-end mt-4">
      <x-primary-button class="ml-3">
        {{ __('Submit') }}
      </x-primary-button>
    </div>
  </form>
@endsection
