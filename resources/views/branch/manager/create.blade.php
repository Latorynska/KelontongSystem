<x-app-layout>
    <div x-data="{ selectedManager: null }">
        <div class="py-12 flex">
            <div class="w-8/12 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between p-2 text-lg font-bold">
                            <span>Add new Staff for {{ $branch->name }} branch</span>
                        </div>
                        <form method="post" action="{{ route('branchstaff.store') }}">
                            @csrf
                            <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                            <!-- staff name -->
                            <div class="relative w-10/12 my-4">
                                <input 
                                    name="name"
                                    type="text" 
                                    id="hs-floating-gray-input-name" 
                                    class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                    focus:pt-6
                                    focus:pb-2
                                    [&:not(:placeholder-shown)]:pt-7
                                    [&:not(:placeholder-shown)]:pb-2
                                    autofill:pt-6
                                    autofill:pb-2" 
                                    placeholder="input new staff name here"
                                    value="{{ old('name')}}"
                                >
                                <label 
                                    for="hs-floating-gray-input-name" 
                                    class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                    peer-focus:text-xs
                                    peer-focus:-translate-y-1.5
                                    peer-focus:text-gray-100
                                    peer-[:not(:placeholder-shown)]:text-xs
                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                    peer-[:not(:placeholder-shown)]:text-gray-100"
                                >
                                    Staff Name
                                </label>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End staff name -->
                            <!-- staff email -->
                            <div class="relative w-10/12 my-4">
                                <input 
                                    name="email"
                                    type="text" 
                                    id="hs-floating-gray-input-email" 
                                    class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                    focus:pt-6
                                    focus:pb-2
                                    [&:not(:placeholder-shown)]:pt-7
                                    [&:not(:placeholder-shown)]:pb-2
                                    autofill:pt-6
                                    autofill:pb-2" 
                                    placeholder="input new staff email here"
                                    value="{{ old('email')}}"
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
                                    Staff email
                                </label>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End staff email -->
                            <!-- staff role -->
                            <div class="relative w-10/12 my-4">
                                <div class="relative">
                                    <select data-hs-select='{
                                            "placeholder": "Staff Role",
                                            "toggleTag": "<button type=\"button\"></button>",
                                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600",
                                            "dropdownClasses": "mt-2 z-50 w-full max-h-[125px] p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto dark:bg-slate-900 dark:border-gray-700",
                                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-gray-200 dark:focus:bg-slate-800",
                                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500\" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>"
                                        }'
                                        name="role"
                                    >
                                        <option value="">choose</option>
                                        @foreach ($roles as $role)  
                                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute top-1/2 end-2.5 -translate-y-1/2">
                                        <svg class="flex-shrink-0 w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7 15 5 5 5-5"/><path d="m7 9 5-5 5 5"/></svg>
                                    </div>
                                </div>
                                @error('role')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End staff role -->

                            <!-- password -->
                            <div class="relative w-10/12 my-4">
                                <div class="relative">
                                    <input 
                                        name="password"
                                        id="hs-toggle-password" 
                                        type="password" 
                                        class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                        focus:pt-6
                                        focus:pb-2
                                        [&:not(:placeholder-shown)]:pt-7
                                        [&:not(:placeholder-shown)]:pb-2
                                        autofill:pt-6
                                        autofill:pb-2" 
                                        placeholder="Enter password"
                                        value="{{ old('password')}}"
                                    >
                                    <label 
                                        for="hs-toggle-password" 
                                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                        peer-focus:text-xs
                                        peer-focus:-translate-y-1.5
                                        peer-focus:text-gray-100
                                        peer-[:not(:placeholder-shown)]:text-xs
                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                        peer-[:not(:placeholder-shown)]:text-gray-100"
                                    >
                                        Password
                                    </label>
                                    <button 
                                        type="button" 
                                        data-hs-toggle-password='{
                                            "target": "#hs-toggle-password"
                                        }' 
                                        class="absolute top-1/2 end-2.5 -translate-y-1/2"
                                    >
                                        <svg class="flex-shrink-0 w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                            <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                            <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                            <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"/>
                                            <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                            <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"/>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- end password -->
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
    </div>
</x-app-layout>
