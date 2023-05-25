<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="px-6 pt-6 mb-5 md:w-1/2 2xl:w-1/3">
                    @if (request('search'))
                        <h2 class="pb-3 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                            Search result for : {{ request('search') }}
                        </h2>
                    @endif
                    <form class="flex items-center gap-2">
                        <x-text-input id="search" name="search" type="text" class="w-full"
                            placeholder="Search by name or email ..." value="{{ request('search') }}" autofocus />
                        <x-primary-button type="submit">
                            {{ 'Search' }}
                        </x-primary-button>
                    </form>
                </div>
                <div class="px-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div></div>

                        <div>
                            @if (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="pb-3 text-sm text-green-600 dark:text-green-400">{{ session('success') }}
                                </p>
                            @endif
                            @if (session('danger'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="pb-3 text-sm text-red-600 dark:text-red-400">{{ session('danger') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div> --}}

                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col sm:flex-row items-center justify-between">
                        <div class="w-full sm:w-1/2 2xl:w-1/3">
                            @if (request('search'))
                                <h2 class="pb-3 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                                    Search results for : {{ request('search') }}
                                </h2>
                            @endif
                            <form class="flex items-center gap-2">
                                <x-text-input id="search" name="search" type="text" class="w-full"
                                    placeholder="Search by name or email ..." value="{{ request('search') }}"
                                    autofocus />
                                <x-primary-button type="submit">
                                    {{ __('Search') }}
                                </x-primary-button>
                            </form>
                        </div>
                        <div>
                            @if (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-green-600 dark:text-green-400 mt-5 sm:mt-0">
                                    {{ session('success') }}
                                </p>
                            @endif
                            @if (session('danger'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-red-600 dark:text-red-400 mt-5 sm:mt-0">{{ session('danger') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="hidden px-6 py-3 md:block">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Todo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p>{{ $user->id }}</p>
                                    </td>
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 md:whitespace-nowrap dark:text-white">
                                        <p>{{ $user->name }}</p>
                                    </td>
                                    <td class="hidden px-6 py-4 md:block">
                                        <p>{{ $user->email }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p>{{ $user->todos->count() }}
                                            <span>
                                                <span
                                                    class="text-green-600 dark:text-green-400">({{ $user->todos->where('is_complete', true)->count() }}</span>/
                                                <span
                                                    class="text-blue-600 dark:text-blue-400">{{ $user->todos->where('is_conplete', false)->count() }})</span>
                                            </span>
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            {{-- Action here --}}
                                            @if ($user->is_admin)
                                                <form action="{{ route('user.removeadmin', $user) }}" method="Post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="text-blue-600 dark:text-blue-400 whitespace-nowrap">
                                                        Remove Admin
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('user.makeadmin', $user) }}" method="Post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="text-red-600 dark:text-red-400 whitespace-nowrap">
                                                        Make Admin
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('user.destroy', $user) }}" method="Post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="text-red-600 dark:text-red-400 whitespace-nowrap">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        Empty
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($users->hasPages())
                    <div class="p-6">
                        {{ $users->Links() }}
                        {{-- {{ $users->links('vendor.pagination.simple-tailwind') }} --}}
                        {{-- {{ $users->links('vendor.pagination.custom-tailwind') }} --}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
