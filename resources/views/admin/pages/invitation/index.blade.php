@extends('admin.layouts.app')
@section('header')
  <div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invitations</h2>
    <a
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-3"
            href="#">Create</a>
  </div>
@endsection
@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form
              class="my-3 py-2 flex flex-end w-full"
              action="{{ route('admin.invitation.index') }}">
        <x-text-input type="text" placeholder="Search / Press enter" value="{{ $query ?? null }}" name="search" class="auto w-54"></x-text-input>
      </form>
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <x-table :ths="['Email', 'Name', 'Admin', 'Company', 'State', 'Actions']">
            @foreach($invitations as $invitation)
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">
                  {{ $invitation->getEmail() }}
                </td>
                <td class="px-6 py-4">
                  {{ $invitation->getName() }}
                </td>
                <td class="px-6 py-4">
                  {{ $invitation->getAdmin()?->getName() }}
                </td>
                <td class="px-6 py-4">
                  {{ $invitation->getCompany()?->getName() }}
                </td>
                <td
                @class(['px-6 py-4', 'text-green-600' => $invitation->isAccepted(), 'text-blue-600' => !$invitation->isAccepted()])>
                  {{ $invitation->isAccepted() ? 'Accepted' : 'Pending' }}
                </td>
                <td class="px-6 py-4 text-right flex space-x-8 gap-2">
                  @if($invitation->isAccepted() && $invitation->getEmployee()->isInactive())
                    <a href="#">Validate</a>
                  @elseif(!$invitation->isAccepted() && ($invitation->getEmployee()?->isInactive() ?? true) === true)
                    <form action="#" method="POST">
                      @csrf
                      @method('DELETE')
                      <button onclick="return confirm('do you want to delete this company')"
                              type="submit"
                              class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete
                      </button>
                    </form>
                  @endif
                </td>
              </tr>
            @endforeach
          </x-table>
        </div>
      </div>
      <div class="pagination py-4">
{{--        {{ $invitation->withQueryString()->links() }}--}}
      </div>
    </div>
  </div>
@endsection
