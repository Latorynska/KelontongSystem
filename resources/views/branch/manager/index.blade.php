<x-app-layout>
    <div class="py-12 flex" x-data="{ selectedBranch: {} }">

        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between p-2 text-lg font-bold">
                        <span>{{ "Branches List" }}</span>
                    </div>
                    <x-table :data="$branches" :filterFields="'[\'name\', \'location\']'">
                        <x-slot name="newData">
                            {{-- <x-button-link :href="route('branch.create')" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:ring focus:border-green-800 dark:bg-green-700 dark:hover:bg-green-900 dark:focus:outline-none dark:focus:ring dark:focus:border-green-800">
                                Add Data
                            </x-button-link> --}}
                        </x-slot>
                        <!-- Table Header -->
                        <x-slot name="header">
                            <tr>
                                <th scope="col" class="px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400">No</th>
                                <th scope="col" class="px-1 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Branch Name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Location</th>
                                <th scope="col" class="px-0 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400 w-fit">Action</th>
                            </tr>
                        </x-slot>

                        <!-- Table Body -->
                        <x-slot name="body">
                            <tr x-show="paginatedData.length === 0">
                                <td colspan="7" class="text-center py-4">No data available</td>
                            </tr>
                            <template x-for="(branch, index) in paginatedData" :key="index">
                                <tr class="even:bg-white odd:bg-gray-100 hover:bg-gray-100 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:hover:bg-gray-700">
                                    <td x-text="branch.number" class="px-1 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="branch.name" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
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
                                                    x-data="{ branchRoute: '{{ route('branchstaff.branch', ['id' => ':id']) }}' }"
                                                    x-bind:href="branchRoute.replace(':id', branch.id)"
                                                >
                                                    Manage Staff
                                                </x-button-link>
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

        <!-- Right Side Card to Display Selected Branch Details -->
        <div class="w-1/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold mb-6" x-text="selectedBranch.name ? selectedBranch.name + '\'s Details' : 'Select any branch to show the details'"></h2>
                    <div x-show="selectedBranch.id">
                        {{-- <pre x-text="JSON.stringify(selectedBranch, null, 2)"></pre> --}}
                        <p class="text-gray-500 dark:text-gray-400 mb-4"><strong>Location:</strong> <span x-text="selectedBranch?.location"></span></p>
                        <p class="text-gray-500 dark:text-gray-400 mb-4"><strong>Branch Staff Count :</strong> <span x-text="selectedBranch?.staff_count"></span></p>
                        <!-- Add other details as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
