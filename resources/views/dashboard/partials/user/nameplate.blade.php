<div
    class="w-auto max-w-sm rounded-lg bg-white p-3 drop-shadow-xl divide-y divide-gray-200"
  >
    <div aria-label="header" class="flex space-x-4 items-center p-4">
      <div aria-label="avatar" class="flex mr-auto items-center space-x-4">
        <img
          src="{{auth()->user()->image ?? ""}}"
          class="w-16 h-16 shrink-0 rounded-full"
        />
        <div class="space-y-2 flex flex-col flex-1 truncate">
          <div class="font-medium relative text-xl leading-tight text-gray-900">
            <span class="flex">
              <span class="truncate relative pr-8">
                   {{ auth()->user()->name }} {{auth()->user()->hasRole('admin') ? '(admin)' : ""}}
              </span>
            </span>
          </div>
          <p class="font-normal text-base leading-tight text-gray-500 truncate">
            {{ auth()->user()->email }}
          </p>
        </div>
      </div>
    </div>
