<x-app-layout>
    <div x-data="{ selectedManager: null }">
        <div class="py-12 flex">
            <div class="w-8/12 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-center justify-between p-2 text-lg font-bold">
                            <span>Add new item for {{ $branch->name }} branch</span>
                        </div>
                        <form method="post" action="{{ route('warehouse.item.store') }}">
                            @csrf
                            <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                            <!-- kode barang -->
                            <div class="relative w-10/12 my-4">
                                <input 
                                    name="kode_barang"
                                    type="text" 
                                    id="hs-floating-gray-input-name" 
                                    class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                    focus:pt-6
                                    focus:pb-2
                                    [&:not(:placeholder-shown)]:pt-7
                                    [&:not(:placeholder-shown)]:pb-2
                                    autofill:pt-6
                                    autofill:pb-2" 
                                    placeholder="input new code here"
                                    value="{{ old('kode_barang')}}"
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
                                    Kode Barang
                                </label>
                                @error('kode_barang')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End kode barang -->
                            <!-- item name -->
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
                                    Item Name
                                </label>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End item name -->
                            <!-- stock -->
                            {{-- <div class="relative w-10/12 my-4">
                                <input
                                    name="stock"
                                    type="number"
                                    pattern="[0-9]*"
                                    id="hs-floating-gray-input-stock"
                                    class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                    focus:pt-6
                                    focus:pb-2
                                    [&:not(:placeholder-shown)]:pt-7
                                    [&:not(:placeholder-shown)]:pb-2
                                    autofill:pt-6
                                    autofill:pb-2"
                                    placeholder="Enter stock"
                                    value="{{ old('stock', 1) }}"
                                    style="-moz-appearance: textfield;"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                >
                                <label
                                    for="hs-floating-gray-input-stock"
                                    class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                    peer-focus:text-xs
                                    peer-focus:-translate-y-1.5
                                    peer-focus:text-gray-100
                                    peer-[:not(:placeholder-shown)]:text-xs
                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                    peer-[:not(:placeholder-shown)]:text-gray-100"
                                >
                                    Stock
                                </label>
                                @error('stock')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div> --}}
                            <!-- End stock -->
                            <!-- price -->
                            <div class="relative w-10/12 my-4">
                                <input
                                    name="price"
                                    type="number"
                                    pattern="[0-9]*"
                                    id="hs-floating-gray-input-price"
                                    class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                    focus:pt-6
                                    focus:pb-2
                                    [&:not(:placeholder-shown)]:pt-7
                                    [&:not(:placeholder-shown)]:pb-2
                                    autofill:pt-6
                                    autofill:pb-2"
                                    placeholder="Enter price"
                                    value="{{ old('price', 0) }}"
                                    style="-moz-appearance: textfield;"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                >
                                <label
                                    for="hs-floating-gray-input-price"
                                    class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                    peer-focus:text-xs
                                    peer-focus:-translate-y-1.5
                                    peer-focus:text-gray-100
                                    peer-[:not(:placeholder-shown)]:text-xs
                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                    peer-[:not(:placeholder-shown)]:text-gray-100"
                                >
                                    Price
                                </label>
                                @error('price')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End price -->
                            <!-- discount -->
                            <div class="relative w-10/12 my-4">
                                <input
                                    name="discount"
                                    type="number"
                                    pattern="[0-9]*"
                                    id="hs-floating-gray-input-discount"
                                    class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                    focus:pt-6
                                    focus:pb-2
                                    [&:not(:placeholder-shown)]:pt-7
                                    [&:not(:placeholder-shown)]:pb-2
                                    autofill:pt-6
                                    autofill:pb-2"
                                    placeholder="Enter discount"
                                    value="{{ old('discount', 0) }}"
                                    style="-moz-appearance: textfield;"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                >
                                <label
                                    for="hs-floating-gray-input-discount"
                                    class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                    peer-focus:text-xs
                                    peer-focus:-translate-y-1.5
                                    peer-focus:text-gray-100
                                    peer-[:not(:placeholder-shown)]:text-xs
                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                    peer-[:not(:placeholder-shown)]:text-gray-100"
                                >
                                    Discount (%)
                                </label>
                                @error('discount')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- End discount -->
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
