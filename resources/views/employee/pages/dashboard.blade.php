@extends('employee.layouts.app')
@section('header')
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
@endsection
@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4">
          <div class="flex justify-between items-center">
            <div class="px-4 sm:px-0">
              <h3 class="text-base font-semibold text-xl text-gray-900">Information</h3>
              <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details and company.</p>
            </div>
            <a
              style="height: fit-content"
              class="inline-flex h-auto items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3"
              href="{{ route('admin.invitation.create') }}">Update</a>
          </div>
          <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="px-4 text-sm font-medium leading-6 text-gray-900">Full name</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employee->getName() }}</dd>
              </div>
              <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="px-4 text-sm font-medium leading-6 text-gray-900">Address</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employee->getAddress() }}</dd>
              </div>
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="px-4 text-sm font-medium leading-6 text-gray-900">Phone</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employee->getPhone() }}</dd>
              </div>
              <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="px-4 text-sm font-medium leading-6 text-gray-900">Birthdate</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employee->getBirthdate() }}</dd>
              </div>
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="px-4 text-sm font-medium leading-6 text-gray-900">Company name</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employee->getCompany()->getName() }}</dd>
              </div>
              <div class="bg-gray-50 px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="px-4 text-sm font-medium leading-6 text-gray-900">Company address</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employee->getCompany()->getAddress() }}</dd>
              </div>
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="px-4 text-sm font-medium leading-6 text-gray-900">Company capital</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $employee->getCompany()->getCapital() }}</dd>
              </div>
            </dl>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
