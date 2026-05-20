{{-- resources/views/admin/messages/index.blade.php --}}

<x-layouts.app>

<div class="p-4 lg:p-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Customer Messages
            </h1>

            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Manage customer conversations and support requests
            </p>
        </div>

        {{-- SEARCH --}}
        <form method="GET" class="relative w-full md:w-80">

            <i class="ri-search-line absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search messages..."
                class="w-full h-12 pl-11 pr-4 rounded-2xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-gray-800 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500"
            >

        </form>

    </div>

    {{-- TABLE --}}
    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px]">

                {{-- TABLE HEAD --}}
                <thead class="border-b border-gray-100 dark:border-slate-800 text-sm font-semibold text-gray-500 dark:text-slate-400">

                    <tr>
                        <th class="text-left px-6 py-4">Customer</th>
                        <th class="text-left px-6 py-4">Message</th>
                        <th class="text-left px-6 py-4">Priority</th>
                        <th class="text-left px-6 py-4">Status</th>
                        <th class="text-left px-6 py-4">Date</th>
                        <th class="text-right px-6 py-4">Action</th>
                    </tr>

                </thead>

                {{-- BODY --}}
                <tbody class="divide-y divide-gray-100 dark:divide-slate-800">

                    @forelse($messages as $msg)

                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/50 transition">

                        {{-- CUSTOMER --}}
                        <td class="px-4 lg:px-6 py-5">

                            <div class="flex items-center gap-4">

                                <img
                                    src="{{ $msg->avatar ?? 'https://ui-avatars.com/api/?name='.$msg->name }}"
                                    class="w-12 h-12 rounded-2xl object-cover"
                                >

                                <div class="min-w-0">

                                    <h3 class="font-semibold text-gray-900 dark:text-white truncate">
                                        {{ $msg->name }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-slate-400 truncate">
                                        {{ $msg->email }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        {{-- MESSAGE --}}
                        <td class="px-4 lg:px-6 py-5">

                            <p class="text-sm text-gray-600 dark:text-slate-300 line-clamp-2 max-w-md">
                                {{ $msg->message }}
                            </p>

                        </td>

                        {{-- PRIORITY --}}
                        <td class="px-4 lg:px-6 py-5">

                            <span class="px-4 py-2 rounded-xl text-xs font-semibold

                                @if($msg->priority == 'High')
                                    bg-red-100 text-red-600 dark:bg-red-500/10 dark:text-red-400

                                @elseif($msg->priority == 'Medium')
                                    bg-yellow-100 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400

                                @else
                                    bg-green-100 text-green-600 dark:bg-green-500/10 dark:text-green-400
                                @endif
                            ">
                                {{ $msg->priority }}
                            </span>

                        </td>

                        {{-- STATUS --}}
                        <td class="px-4 lg:px-6 py-5">

                            <span class="px-3 py-1 rounded-xl text-xs font-medium

                                @if($msg->status == 'Unread')
                                    bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400
                                @else
                                    bg-gray-100 text-gray-600 dark:bg-slate-700 dark:text-slate-300
                                @endif
                            ">
                                {{ $msg->status }}
                            </span>

                        </td>

                        {{-- DATE --}}
                        <td class="px-4 lg:px-6 py-5">

                            <span class="text-sm text-gray-500 dark:text-slate-400">
                                {{ $msg->created_at->diffForHumans() }}
                            </span>

                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-4 lg:px-6 py-5">

                            <div class="flex justify-end gap-2">

                                {{-- VIEW --}}
                                <button class="h-10 w-10 rounded-xl border border-gray-200 dark:border-slate-700 text-gray-600 dark:text-slate-300 flex items-center justify-center hover:bg-indigo-50 dark:hover:bg-slate-800">

                                    <i class="ri-eye-line"></i>

                                </button>

                                {{-- REPLY --}}
                                <button class="h-10 w-10 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white flex items-center justify-center">

                                    <i class="ri-chat-1-line"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center py-20">

                            <div class="flex flex-col items-center">

                                <div class="h-20 w-20 rounded-3xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center mb-4">

                                    <i class="ri-message-2-line text-3xl text-gray-400"></i>

                                </div>

                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    No Messages Found
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                                    Customer messages will appear here
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="p-6 border-t border-gray-100 dark:border-slate-800">

            {{ $messages->links() }}

        </div>

    </div>

</div>

</x-layouts.app>