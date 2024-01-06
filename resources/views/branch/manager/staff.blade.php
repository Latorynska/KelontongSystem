<x-app-layout>
    <div class="py-12 flex" x-data="{ selectedBranch: {} }">
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between p-2 text-lg font-bold">
                        <span>{{ $branch->name."'s Staff List" }}</span>
                    </div>
                    <x-table :data="$branch->branchStaff" :filterFields="'[\'user.name\', \'user.roles[0].name\']'">
                        <x-slot name="newData">
                            <div class="hs-dropdown inline-flex">
                                <button id="hs-dropdown-basic" type="button" class="hs-dropdown-toggle py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                    Add new staff
                                    <svg class="hs-dropdown-open:rotate-180 w-4 h-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"/>
                                    </svg>
                                </button>
                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 w-min hidden z-10 mt-2 min-w-[15rem] bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700" aria-labelledby="hs-dropdown-basic">
                                    <x-button-link :href="route('branchstaff.create',['id'=>$branch->id])" class="flex items-center py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700">
                                        Add Data
                                    </x-button-link>
                                    <button 
                                        x-on:click.prevent="$dispatch('open-modal', 'browseStaffModal')"
                                        class="flex items-center w-full py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700"
                                        >
                                        Select from available Data
                                    </button>
                                </div>
                            </div>
                        </x-slot>
                        <!-- Table Header -->
                        <x-slot name="header">
                            <tr>
                                <th scope="col" class="px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400">No</th>
                                <th scope="col" class="px-1 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Staff Name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Staff Position</th>
                                <th scope="col" class="px-0 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400 w-fit">Action</th>
                            </tr>
                        </x-slot>

                        <!-- Table Body -->
                        <x-slot name="body">
                            <tr x-show="paginatedData.length === 0">
                                <td colspan="7" class="text-center py-4">No data available</td>
                            </tr>
                            <template x-for="(branchstaff, index) in paginatedData" :key="index">
                                <tr class="even:bg-white odd:bg-gray-100 hover:bg-gray-100 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:hover:bg-gray-700">
                                    <td x-text="branchstaff.number" class="px-1 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="branchstaff.user.name" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="branchstaff.user.roles[0].name" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td class="px-0 py-2 whitespace-nowrap text-center text-sm font-medium w-fit">
                                        <div class="hs-dropdown inline-flex">
                                            <button id="hs-dropdown-basic" type="button" class="hs-dropdown-toggle py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                                Actions
                                                <svg class="hs-dropdown-open:rotate-180 w-4 h-4 text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="m6 9 6 6 6-6"/>
                                                </svg>
                                            </button>
                                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 w-min hidden z-10 mt-2 min-w-[15rem] bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700" aria-labelledby="hs-dropdown-basic">
                                                <form action="">
                                                    <x-button-link 
                                                        class="flex items-center py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" 
                                                        x-data="{ editRoute: '{{ route('branchstaff.edit', ['id' => ':id']) }}' }"
                                                        x-bind:href="editRoute.replace(':id', branchstaff.user.id)"
                                                    >
                                                        Update staff data
                                                    </x-button-link>
                                                    <x-button-link 
                                                        class="flex items-center py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" 
                                                        x-data="{ route: '{{ route('branchstaff.remove', ':id') }}'}"
                                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-staff-removal')"
                                                        x-on:click="$dispatch('set-action', route.replace(':id', branchstaff.id))"
                                                        href="#"
                                                    >
                                                        Remove Staff
                                                    </x-button-link>
                                                </form>
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

        <!-- Right Side Card to Display Selected Branch Details -->
        <div class="w-1/3 mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-6" x-text="selectedBranch.name ? selectedBranch.name + '\'s Details' : 'Select any branch to show the details'"></h2>
                    <div x-show="selectedBranch.id">
                        <pre x-text="JSON.stringify(selectedBranch, null, 2)"></pre>
                        <p class="text-gray-500 dark:text-gray-400 mb-4"><strong>Location:</strong> <span x-text="selectedBranch?.location"></span></p>
                        <p class="text-gray-500 dark:text-gray-400 mb-4"><strong>Branch Staff Count :</strong> <span x-text="selectedBranch?.staff_count"></span></p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    {{-- browse staff modal --}}
    <x-modal name="browseStaffModal" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-6">
            <div class="flex items-center justify-between p-2 text-lg font-bold text-white">
                <span>
                    Select staff for {{$branch->name}} branch
                </span>
            </div>
            <x-table :data="$brandStaff" :filterFields="'[\'name\', \'roles[0].name\']'">
                <x-slot name="newData">
                    {{-- <x-button-link :href="route('brand')" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:ring focus:border-green-800 dark:bg-green-700 dark:hover:bg-green-900 dark:focus:outline-none dark:focus:ring dark:focus:border-green-800">
                        Add Data
                    </x-button-link> --}}
                </x-slot>
                <x-slot name="header">
                    <tr>
                        <th scope="col" class="px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400">No</th>
                        <th scope="col" class="px-1 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Staff Name</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Staff Position</th>
                        <th scope="col" class="px-0 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400 w-fit">Action</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    <template x-for="(staff, index) in paginatedData" :key="index">
                        <tr 
                            class="even:bg-white odd:bg-gray-100 hover:bg-gray-100 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:hover:bg-gray-700"
                        >
                            <td x-text="index + 1 + (currentPage - 1) * itemsPerPage" class="px-1 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                            <td x-text="staff.name" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                            <td x-text="staff.roles[0].name" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                            <td class="px-0 py-2 whitespace-nowrap text-center text-sm font-medium w-fit">
                                <form method="post" action="{{ route('branchstaff.assign', ['id' => $branch->id ]) }}">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="user_id" :value="staff.id">
                                    <button 
                                        type="submit" 
                                        class="py-1 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                        
                                    >
                                        Select
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </template>
                </x-slot>
            </x-table>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
            </div>
        </div>
    </x-modal>
    {{-- modal remove --}}
    <x-modal name="confirm-staff-removal" focusable maxWidth="md">
        <form method="POST" x-bind:action="action" class="p-6">
            @csrf
            @method('DELETE')

            <h2 class="text-lg text-center font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure to remove this staff?') }}
            </h2>

            <div class="mt-6 flex justify-center">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Remove Staff') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
