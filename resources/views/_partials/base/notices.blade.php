@if(session()->has('success'))
  <div id="sticky-banner" tabindex="-1" style="background: #dcfce7;"
       class="top-0 left-0 z-50 bg-red-600 flex justify-between w-full p-4 border-b border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
    <div class="flex items-center mx-auto">
      <p class="flex items-center text-sm font-normal text-gray-500 dark:text-gray-400">
        <span class="text-sm font-semibold text-red-600 space-y-1'" style="color: #065f46;">{{ session()->get('success') }}</span>
      </p>
    </div>
  </div>
@elseif(!$errors->isEmpty())
  <div id="sticky-banner" tabindex="-1" style="background: #fecaca;"
       class="top-0 left-0 z-50 bg-red-600 flex justify-between w-full p-4 border-b border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
    <div class="flex items-center mx-auto">
      <p class="flex items-center text-sm font-normal text-gray-500 dark:text-gray-400">
        <span class="text-sm font-semibold text-red-600 space-y-1'">{{ $errors->first() }}</span>
      </p>
    </div>
  </div>
@endif