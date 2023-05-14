@extends('admin.layouts.app')
@section('header')
  <div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admins</h2>
    <a
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3"
            href="{{ route('admin.create') }}">Create</a>
  </div>
@endsection
@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          @if($admins->isEmpty())
            <h1 class="text-center text-gray-900 text-xl p-4">No admins is currently available</h1>
          @else
            <x-table :ths="['Email', 'Name']">
              @foreach($admins as $admin)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td class="px-6 py-4">
                    {{ $admin->getEmail() }}
                  </td>
                  <td class="px-6 py-4">
                    {{ $admin->getName() }}
                  </td>
                </tr>
              @endforeach
            </x-table>
          @endif
        </div>
      </div>
      <div class="pagination py-4">
        {{ $admins->withQueryString()->links() }}
      </div>
    </div>
  </div>
@endsection
