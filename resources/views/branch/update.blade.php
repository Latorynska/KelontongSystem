<x-app-layout>
    <div x-data="{ selectedManager: null }">
        <div class="py-12 flex">
            <div class="w-8/12 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between p-2 text-lg font-bold">
                            <span>Branch Information</span>
                        </div>
                        <form method="post" action="{{ route('branch.create') }}">
                            @csrf
                            <!-- branch name -->
                            <div class="relative w-10/12 my-4">
                                <input 
                                    name="name"
                                    type="text" 
                                    id="hs-floating-gray-input-email" 
                                    class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                    focus:pt-6
                                    focus:pb-2
                                    [&:not(:placeholder-shown)]:pt-7
                                    [&:not(:placeholder-shown)]:pb-2
                                    autofill:pt-6
                                    autofill:pb-2" 
                                    placeholder="input new branch name here"
                                    value="{{ old('name')}}"
                                >
                                <label 
                                    for="hs-floating-gray-input-email" 
                                    class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                    peer-focus:text-xs
                                    peer-focus:-translate-y-1.5
                                    peer-focus:text-gray-100
                                    peer-[:not(:placeholder-shown)]:text-xs
                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                    peer-[:not(:placeholder-shown)]:text-gray-100"
                                >
                                    Branch Name
                                </label>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End branch name -->
                            <!-- branch location -->
                            <div class="relative w-10/12 my-4">
                                <input 
                                    name="location"
                                    type="text" 
                                    id="hs-floating-gray-input-email" 
                                    class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                    focus:pt-6
                                    focus:pb-2
                                    [&:not(:placeholder-shown)]:pt-7
                                    [&:not(:placeholder-shown)]:pb-2
                                    autofill:pt-6
                                    autofill:pb-2" 
                                    placeholder="input new branch location here"
                                    value="{{ old('location')}}"
                                >
                                <label 
                                    for="hs-floating-gray-input-email" 
                                    class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                    peer-focus:text-xs
                                    peer-focus:-translate-y-1.5
                                    peer-focus:text-gray-100
                                    peer-[:not(:placeholder-shown)]:text-xs
                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                    peer-[:not(:placeholder-shown)]:text-gray-100"
                                >
                                    Branch Location
                                </label>
                                @error('location')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End branch location -->
                            {{-- manager information --}}
                            <div class="flex items-center justify-between p-2 text-lg font-bold">
                                <span>Manager Information</span>
                            </div>
                            <div class="w-10/12">
                                <div class="flex justify-between">
                                    <input 
                                        type="hidden" 
                                        name="manager_id"
                                        x-bind:value="selectedManager ? selectedManager.id : ''" 
                                        value="{{ old('manager_id')}}"
                                    >
                                    <input 
                                        type="hidden" 
                                        name="owner_id"
                                        value="{{ Auth::user()->id }}"
                                        value="{{ old('owner_id')}}"
                                    >
                                    {{-- manager text --}}
                                    <div class="relative w-10/12">
                                        <input 
                                            type="text" 
                                            class="peer py-3 px-4 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Branch Manager" readonly
                                            x-bind:value="selectedManager ? selectedManager.name : ''" 
                                            x-on:click.prevent="$dispatch('open-modal', 'browseManagerModal')"
                                        >
                                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                            <svg class="flex-shrink-0 w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                        </div>
                                    </div>
                                    {{-- end manager text --}}
                                    {{-- search manager button --}}
                                    <div class="my-auto">
                                        <button  
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'browseManagerModal')"
                                        type="button"
                                        class="py-2 px-4 inline-flex items-center text-base font-semibold rounded-lg border border-transparent bg-gray-500 text-white hover:bg-gray-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                        Browse
                                    </button>
                                </div>
                                {{-- end search manager button --}}
                            </div>
                            <div class="">
                                @error('manager_id')
                                    <p class="text-red-500 text-xs mt-1 ms-1">You need to select a manager.</p>
                                @enderror
                            </div>
                            </div>
                            <div class="w-full">
                                <div class=" float-end py-2">
                                    <button 
                                        type="submit" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:ring focus:border-green-800 dark:bg-green-700 dark:hover:bg-green-900 dark:focus:outline-none dark:focus:ring dark:focus:border-green-800"
                                    >
                                        Save Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="w-4/12">

            </div>
        </div>
        <x-modal name="browseManagerModal" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <div class="p-6">
                <pre x-text="selectedManager?.name"></pre>
                <div class="flex items-center justify-between p-2 text-lg font-bold text-white">
                    <span>
                        Select manager for this branch
                    </span>
                </div>
                <x-table :data="$managers">
                    <x-slot name="newData">
                        <x-button-link :href="route('brand')" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:ring focus:border-green-800 dark:bg-green-700 dark:hover:bg-green-900 dark:focus:outline-none dark:focus:ring dark:focus:border-green-800">
                            Add Data
                        </x-button-link>
                    </x-slot>
                    <x-slot name="header">
                        <tr>
                            <th scope="col" class="px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400">No</th>
                            <th scope="col" class="px-1 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Manager Name</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Manager email</th>
                            <th scope="col" class="px-0 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400 w-fit">Action</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        <template x-for="(manager, index) in paginatedData" :key="index">
                            <tr 
                                class="even:bg-white odd:bg-gray-100 hover:bg-gray-100 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:hover:bg-gray-700"
                                x-on:click.prevent="
                                    selectedManager = manager;
                                    $dispatch('close', 'browseManagerModal');
                                "
                            >
                                <td x-text="index + 1 + (currentPage - 1) * itemsPerPage" class="px-1 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                <td x-text="manager.name" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                <td x-text="manager.email" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                <td class="px-0 py-2 whitespace-nowrap text-center text-sm font-medium w-fit">
                                    <button 
                                        type="button" 
                                        class="py-1 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                        x-on:click.prevent="
                                            selectedManager = manager;
                                            $dispatch('close', 'browseManagerModal');
                                        "
                                    >
                                        Select
                                    </button>
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
    </div>
</x-app-layout>
