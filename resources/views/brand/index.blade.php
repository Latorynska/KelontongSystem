<x-app-layout>
    <div class="py-12 flex">
        {{-- left card --}}
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(isset($brand[0]))
                        <div class="mb-4 flex">
                            <div class="w-2/12">
                                <p class="text-xl font-semibold">
                                    Brand Name
                                </p>
                            </div>
                            <div class="w-7/12">
                                <p class="text-xl ml-2">
                                    {{ $brand[0]->name }}
                                </p>
                            </div>
                        </div>
                        <div class="mb-4 flex">
                            <div class="w-2/12">
                                <p class="text-gray-500 dark:text-gray-400">
                                    Owner Name
                                </p>
                            </div>
                            <div class="w-7/12">
                                <p class="text-gray-500 dark:text-gray-400 ml-2">
                                    {{ $brand[0]->user->name }}
                                </p>
                            </div>
                        </div>
                        <div class="mb-4 flex">
                            <div class="w-2/12">
                                <p class="text-gray-500 dark:text-gray-400">
                                    Branches Count
                                </p>
                            </div>
                            <div class="w-7/12">
                                <p class="text-gray-500 dark:text-gray-400 ml-2">
                                    {{ $brand[0]->branches_count }}
                                </p>
                            </div>
                        </div>
                        <div class="mb-4 flex">
                            <div class="w-2/12">
                                <p class="text-gray-500 dark:text-gray-400">
                                    Total Staff
                                </p>
                            </div>
                            <div class="w-7/12">
                                <p class="text-gray-500 dark:text-gray-400 ml-2">
                                    {{ $brand[0]->staff_count }}
                                </p>
                            </div>
                        </div>
                    @else
                        <p class="text-xl font-semibold">No brand data available.</p>
                    @endif
                </div>
                <div class="float-end px-3 pb-3">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-white text-gray-800 hover:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                        Edit Information
                    </button>
                </div>
            </div>
        </div>
        {{-- right card --}}
        <div class="w-1/3 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
