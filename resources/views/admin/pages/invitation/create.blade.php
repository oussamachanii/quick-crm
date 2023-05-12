@extends('admin.layouts.app')
@section('header')
  <div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Invitation</h2>
  </div>
@endsection
@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <form class="p-6" action="{{ route('admin.invitation.store') }}" method="POST">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
              <div class="grid gap-2">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Name" required>
              </div>
              <div class="grid gap-2">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email" required>
              </div>
              <div class="grid gap-2">
                <label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
                <select name="company_id" id="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  @foreach($companies as $company)
                    <option value="{{ $company->getId() }}" @selected($company->getId() === old('company_id'))>{{ $company->getName() }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="actions">
              <div class="inner-actions flex justify-end gap-4">
                <x-primary-button type="submit">Create</x-primary-button>
                <a
                  href="{{ route('admin.invitation.index') }}"
                  class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                  <span>Cancel</span>
                </a>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
@endsection
