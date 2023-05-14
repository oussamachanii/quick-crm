@extends('admin.layouts.app')
@section('header')
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
@endsection
@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">Hello Admin {{ $admin->getName() }}</div>
      </div>
    </div>
    <div class="my-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          @if($histories->isEmpty())
            <h1 class="text-center text-gray-900 text-xl p-4">No histories</h1>
          @else
            <ol class="relative border-l border-gray-200 dark:border-gray-700">
              @foreach($histories as $history)
                <li class="border-b" style="margin: 1rem;">
                  <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                  <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $history->getCreatedAt() }}</time>
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $history->getUseableName() }}</h3>
                  <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $history->getMessage() }}</p>
                </li>
              @endforeach
            </ol>
          @endif
        </div>
      </div>
      <div class="pagination py-4">
        {{ $histories->withQueryString()->links() }}
      </div>
    </div>
  </div>
  <style>
    li:last-child {
      border-bottom: 0;
    }
  </style>
@endsection

