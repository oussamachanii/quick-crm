<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
  <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
  <tr>
    @foreach($ths as $th)
      <th scope="col" class="px-6 py-3">{{ $th }}</th>
    @endforeach
  </tr>
  </thead>
  <tbody>
  {{ $slot }}
  </tbody>
</table>
