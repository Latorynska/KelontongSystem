<x-app-layout>
    <div class="py-12 flex" x-data="{ selectedStaff: {} }">

        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between p-2 text-lg font-bold">
                        <span>{{ $brand->name."'s Branches" }}</span>
                    </div>
                    <x-table :data="$brandStaff" :filterFields="'[\'user.name\', \'user.roles\', \'user.branches\']'">
                        <x-slot name="newData">
                            <x-button-link :href="route('staff.create')" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:ring focus:border-green-800 dark:bg-green-700 dark:hover:bg-green-900 dark:focus:outline-none dark:focus:ring dark:focus:border-green-800">
                                Add Data
                            </x-button-link>
                        </x-slot>
                        <!-- Table Header -->
                        <x-slot name="header">
                            <tr>
                                <th scope="col" class="px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400">No</th>
                                <th scope="col" class="px-1 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Position</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Staff At</th>
                                <th scope="col" class="px-0 py-3 pe-12 text-right text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Action</th>
                            </tr>
                        </x-slot>

                        <!-- Table Body -->
                        <x-slot name="body">
                            <template x-for="(staff, index) in paginatedData" :key="index">
                                <tr class="even:bg-white odd:bg-gray-100 hover:bg-gray-100 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:hover:bg-gray-700">
                                    <td x-text="index + 1 + (currentPage - 1) * itemsPerPage" class="px-1 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="staff.user.name" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td>
                                        <template x-for="(role, roleIndex) in staff.user.roles" :key="roleIndex">
                                            <span x-text="role.name" class="inline-block px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></span>
                                        </template>
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <template x-if="staff.user.branches.length === 1">
                                            <span x-text="staff.user.branches[0].name" class="inline-block px-1 py-4 text-sm text-gray-800 dark:text-gray-200"></span>
                                        </template>
                                        <template x-if="staff.user.branches.length > 1">
                                            <span x-text="staff.user.branches.slice(0, 1).map(branch => branch.name).join(', ') + ' and ' + (staff.user.branches.length - 1) + ' more'" class="inline-block px-1 py-4 text-sm text-gray-800 dark:text-gray-200"></span>
                                        </template>
                                        <template x-if="staff.user.branches.length === 0">
                                            <span x-text="'Not Assigned'" class="inline-block px-1 py-4 text-sm text-gray-800 dark:text-gray-200"></span>
                                        </template>
                                    </td>                                    
                                    <td class="px-0 py-2 pe-8 whitespace-nowrap text-right text-sm font-medium">
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
                                                    x-data="{ editRoute: '{{ route('staff.edit', ['id' => ':id']) }}' }"
                                                    x-bind:href="editRoute.replace(':id', staff.user.id)"
                                                >
                                                    Update
                                                </x-button-link>
                                                <button 
                                                    type="button" 
                                                    class="flex items-center py-2 px-3 w-full rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" 
                                                    x-data="{ route: '{{ route('staff.delete', ':id') }}'}"
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-staff-deletion')"
                                                    x-on:click="$dispatch('set-action', route.replace(':id', staff.user.id))"
                                                >
                                                    Delete
                                                </button>
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
        {{-- modal delete --}}
        <x-modal name="confirm-staff-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="POST" x-bind:action="action" class="p-6">
                @csrf
                @method('DELETE')
    
                <h2 class="text-lg text-center font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Apakah anda yakin ingin menghapus data staff?') }}
                </h2>
    
                <p class="mt-1 text-sm text-center text-gray-600 dark:text-gray-400">
                    {{ __('data yang dihapus tidak dapat dikembalikan kembali!') }}
                </p>
    
                <div class="mt-6 flex justify-center">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-danger-button class="ml-3">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
        <!-- Right Side Card to Display Selected Branch Details -->
        <div class="w-1/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- <h2 class="text-xl font-bold mb-6" x-text="selectedStaff.name ? selectedStaff.name + '\'s Details' : 'Select any branch to show the details'"></h2>
                    <div x-show="selectedStaff.id">
                        <p class="text-gray-500 dark:text-gray-400 mb-4"><strong>Manager:</strong> <span x-text="selectedStaff?.manager?.name"></span></p>
                        <p class="text-gray-500 dark:text-gray-400 mb-4"><strong>Location:</strong> <span x-text="selectedStaff?.location"></span></p>
                        <p class="text-gray-500 dark:text-gray-400 mb-4"><strong>Branch Staff Count :</strong> <span x-text="selectedStaff?.staff_count"></span></p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
