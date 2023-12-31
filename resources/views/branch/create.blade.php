<x-app-layout>
    <div class="py-12 flex" x-data="{ selectedManager: null, isModalOpen: false }">

        <div class="w-8/12 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between p-2 text-lg font-bold">
                        <span>New Branch Form</span>
                    </div>
                    <form method="post" action="#">
                        @csrf
                        <!-- branch name -->
                        <div class="relative w-10/12 my-4">
                            <input type="text" id="hs-floating-gray-input-email" class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                            focus:pt-6
                            focus:pb-2
                            [&:not(:placeholder-shown)]:pt-7
                            [&:not(:placeholder-shown)]:pb-2
                            autofill:pt-6
                            autofill:pb-2" placeholder="input new branch name here">
                            <label for="hs-floating-gray-input-email" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                            peer-focus:text-xs
                            peer-focus:-translate-y-1.5
                            peer-focus:text-gray-100
                            peer-[:not(:placeholder-shown)]:text-xs
                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                            peer-[:not(:placeholder-shown)]:text-gray-100">Branch Name</label>
                        </div>
                        <!-- End branch name -->
                        <!-- branch location -->
                        <div class="relative w-10/12 my-4">
                            <input type="text" id="hs-floating-gray-input-email" class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                            focus:pt-6
                            focus:pb-2
                            [&:not(:placeholder-shown)]:pt-7
                            [&:not(:placeholder-shown)]:pb-2
                            autofill:pt-6
                            autofill:pb-2" placeholder="input new branch location here">
                            <label for="hs-floating-gray-input-email" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                            peer-focus:text-xs
                            peer-focus:-translate-y-1.5
                            peer-focus:text-gray-100
                            peer-[:not(:placeholder-shown)]:text-xs
                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                            peer-[:not(:placeholder-shown)]:text-gray-100">Branch Location</label>
                        </div>
                        <!-- End branch location -->
                        <div class="w-10/12">
                            <div class="flex justify-between">
                                {{-- manager text --}}
                                <div class="relative w-10/12">
                                    <input type="text" x-model="selectedManager" class="peer py-3 px-4 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Branch Manager" readonly>
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
            <div class="flex items-center justify-between p-2 text-lg font-bold text-white">
                <span>
                    Select manager for this branch
                </span>
            </div>
            @php
                foreach ($managers as $manager) {
                    dump($manager->user);
                }
            @endphp

            <x-table :data="$managers">
                <x-slot name="newData">
                </x-slot>
                <x-slot name="header">
                </x-slot>
                <x-slot name="body">
                </x-slot>
            </x-table>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
            </div>
        </div>
    </x-modal>
</x-app-layout>
