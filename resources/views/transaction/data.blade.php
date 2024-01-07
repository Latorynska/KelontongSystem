<x-app-layout>
    <div class="py-12 flex" x-data="{ selectedBranch: {} }">

        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between p-2 text-lg font-bold">
                        <span>{{ "Select branch to view transaction" }}</span>
                    </div>
                    <x-table :data="$branches" :filterFields="'[\'name\', \'manager.name\', \'location\']'">
                        <x-slot name="newData">
                            @hasrole('owner')
                            <button 
                                type="button" 
                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-500 text-white hover:bg-gray-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                x-on:click.prevent="$dispatch('open-modal', 'export-modal')"
                            >
                                Export Data
                            </button>
                            @endhasrole
                        </x-slot>
                        <!-- Table Header -->
                        <x-slot name="header">
                            <tr>
                                <th scope="col" class="px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400">No</th>
                                <th scope="col" class="px-1 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Branch Name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Manager</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Location</th>
                                <th scope="col" class="px-0 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400 w-fit">Action</th>
                            </tr>
                        </x-slot>

                        <!-- Table Body -->
                        <x-slot name="body">
                            <template x-for="(branch, index) in paginatedData" :key="index">
                                <tr class="even:bg-white odd:bg-gray-100 hover:bg-gray-100 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:hover:bg-gray-700">
                                    <td x-text="branch.number" class="px-1 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="branch.name" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="branch.manager.name" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="branch.location" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td class="px-0 py-2 whitespace-nowrap text-center text-sm font-medium w-fit">
                                        <div class="hs-dropdown inline-flex">
                                            <button id="hs-dropdown-basic" type="button" class="hs-dropdown-toggle py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                                Actions
                                                <svg class="hs-dropdown-open:rotate-180 w-4 h-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="m6 9 6 6 6-6"/>
                                                </svg>
                                            </button>
                                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 w-min hidden z-10 mt-2 min-w-[15rem] bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700" aria-labelledby="hs-dropdown-basic">
                                                <x-button-link 
                                                    class="flex items-center py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" 
                                                    x-data="{ selectRoute: '{{ route('transaction.data.view', ['id' => ':id']) }}' }"
                                                    x-bind:href="selectRoute.replace(':id', branch.id)"
                                                >
                                                    View Transaction
                                                </x-button-link>
                                                {{-- <a class="flex items-center py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="#">
                                                    Delete
                                                </a> --}}
                                                <a x-on:click.prevent="selectedBranch = branch" class="flex items-center py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="#">
                                                    Detail
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal export --}}
    <x-modal name="export-modal" :show="$errors->userDeletion->isNotEmpty()" focusable maxWidth="5xl">
        <form method="POST" action="{{ route('transaction.print.all') }}" target="_blank" class="p-6">
            @csrf
            @method('POST')
            <h2 class="text-lg text-center font-medium text-gray-900 dark:text-gray-100">
                Download report criteria
            </h2>

            <div class="w-full flex items-center py-2">
                {{-- tanggal export --}}
                <div class="relative w-full px-1">
                    <input 
                        name="beginDate"
                        type="datetime-local" 
                        id="hs-floating-gray-input-beginDate" 
                        class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                        focus:pt-6
                        focus:pb-2
                        [&:not(:placeholder-shown)]:pt-7
                        [&:not(:placeholder-shown)]:pb-2
                        autofill:pt-6
                        autofill:pb-2" 
                        placeholder="input date here"
                        value="{{ old('tanggal', now()->firstOfMonth()->format('Y-m-d\TH:i')) }}"
                        >
                    <label 
                        for="hs-floating-gray-input-beginDate" 
                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                        peer-focus:text-xs
                        peer-focus:-translate-y-1.5
                        peer-focus:text-gray-100
                        peer-[:not(:placeholder-shown)]:text-xs
                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                        peer-[:not(:placeholder-shown)]:text-gray-100"
                    >
                        Begin Date
                    </label>
                    @error('beginDate')
                        <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative w-full px-1">
                    <input 
                        name="endDate"
                        type="datetime-local" 
                        id="hs-floating-gray-input-endDate" 
                        class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                        focus:pt-6
                        focus:pb-2
                        [&:not(:placeholder-shown)]:pt-7
                        [&:not(:placeholder-shown)]:pb-2
                        autofill:pt-6
                        autofill:pb-2" 
                        placeholder="input date here"
                        value="{{ old('tanggal', now()->format('Y-m-d\TH:i')) }}"
                        >
                    <label 
                        for="hs-floating-gray-input-endDate" 
                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                        peer-focus:text-xs
                        peer-focus:-translate-y-1.5
                        peer-focus:text-gray-100
                        peer-[:not(:placeholder-shown)]:text-xs
                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                        peer-[:not(:placeholder-shown)]:text-gray-100"
                    >
                        End Date
                    </label>
                    @error('endDate')
                        <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative w-full px-1">
                    <select 
                        name="type"
                        id="hs-floating-gray-input-type" 
                        class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                        focus:pt-6
                        focus:pb-2
                        [&:not(:placeholder-shown)]:pt-7
                        [&:not(:placeholder-shown)]:pb-2
                        autofill:pt-6
                        autofill:pb-2" 
                        placeholder="input date here"
                        >
                        <option value="all">All</option>
                        <option value="in">In</option>
                        <option value="out">Out</option>
                    </select>
                    <label 
                        for="hs-floating-gray-input-type" 
                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                        peer-focus:text-xs
                        peer-focus:-translate-y-1.5
                        peer-focus:text-gray-100
                        peer-[:not(:placeholder-shown)]:text-xs
                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                        peer-[:not(:placeholder-shown)]:text-gray-100"
                    >
                        Transaction Type
                    </label>
                </div>
                {{-- end tanggal export --}}
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <div class="ps-4">
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:ring focus:border-green-800 dark:bg-green-700 dark:hover:bg-green-900 dark:focus:outline-none dark:focus:ring dark:focus:border-green-800"
                        >
                        Download Data
                    </button>
                </div>
            </div>
        </form>
        
    </x-modal>
</x-app-layout>
