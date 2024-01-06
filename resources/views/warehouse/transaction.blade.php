<x-app-layout>
    <div x-data="{ 
        transactionDetails: [], 
        totalPrice: 0,
        calculateSubtotal: function(index) {
            const item = this.transactionDetails[index];
            {{-- console.log(item.quantity);
            console.log(item.price_at); --}}
            item.subTotal = item.quantity * item.price_at;
            this.updateTotalPrice();
        },
        updateTotalPrice: function() {
            this.totalPrice = this.transactionDetails.reduce((total, item) => total + item.subTotal, 0);
        }
    }">
    

        <div class="py-6 flex">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-white">
                            Restock Item
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-6 flex">
            {{-- left card --}}
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form method="post" action="{{ route('warehouse.transaction.store') }}">
                            @csrf
                            <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                            <p class="text-white">
                                Tanggal Transaksi
                            </p>
                            {{-- tanggal transaksi --}}
                            <div class="relative w-10/12 my-4">
                                <input 
                                    name="tanggal"
                                    type="datetime-local" 
                                    id="hs-floating-gray-input-tanggal" 
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
                                    for="hs-floating-gray-input-tanggal" 
                                    class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                    peer-focus:text-xs
                                    peer-focus:-translate-y-1.5
                                    peer-focus:text-gray-100
                                    peer-[:not(:placeholder-shown)]:text-xs
                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                    peer-[:not(:placeholder-shown)]:text-gray-100"
                                >
                                    Tanggal
                                </label>
                                @error('tanggal')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- end tanggal transaksi --}}

                            {{-- detail transaksi --}}
                            <p class="text-white">
                                Detail Transaksi
                            </p>
                            <template x-for="(item, index) in transactionDetails" :key="index">
                                {{-- <pre x-text="JSON.stringify(item, null, 2)"></pre> --}}
                                <div class="">
                                    <input type="hidden" :name="'item_id['+index+']'" x-model="item.id">
                                    <div class="w-10/12 flex">
                                        <!-- kode barang -->
                                        <div class="relative w-full my-4 px-1">
                                            <input 
                                                :name="'kode_barang['+index+']'"
                                                type="text" 
                                                id="'hs-floating-gray-input-kode-barang-' + index" 
                                                class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                                focus:pt-6
                                                focus:pb-2
                                                [&:not(:placeholder-shown)]:pt-7
                                                [&:not(:placeholder-shown)]:pb-2
                                                autofill:pt-6
                                                autofill:pb-2" 
                                                placeholder="input new code here"
                                                x-model="item.kode_barang"
                                                readonly
                                            >
                                            <label 
                                                :for="'hs-floating-gray-input-kode-barang-' + index" 
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
                                        <div class="relative w-full my-4 px-1">
                                            <input 
                                                :name="'name[' + index + ']'"
                                                type="text" 
                                                id="'hs-floating-gray-input-name-' + index" 
                                                class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                                focus:pt-6
                                                focus:pb-2
                                                [&:not(:placeholder-shown)]:pt-7
                                                [&:not(:placeholder-shown)]:pb-2
                                                autofill:pt-6
                                                autofill:pb-2" 
                                                placeholder="input new staff name here"
                                                x-model="item.name"
                                                readonly
                                            >
                                            <label 
                                                :for="'hs-floating-gray-input-name-' + index" 
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
                                    </div>
                                    <!-- quantity -->
                                    <div class="relative w-10/12 mb-2">
                                        <input
                                            :name="'quantity[' + index + ']'"
                                            type="number"
                                            pattern="[0-9]*"
                                            :id="'hs-floating-gray-input-quantity-' + index"
                                            class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                            focus:pt-6
                                            focus:pb-2
                                            [&:not(:placeholder-shown)]:pt-7
                                            [&:not(:placeholder-shown)]:pb-2
                                            autofill:pt-6
                                            autofill:pb-2"
                                            placeholder="Enter quantity"
                                            x-model="item.quantity"
                                            style="-moz-appearance: textfield;"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            @input="calculateSubtotal(index); console.log('item.subTotal:', item.subTotal);"
                                            required
                                            min="1"
                                            >
                                        <label
                                            :for="'hs-floating-gray-input-quantity-' + index"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                            peer-focus:text-xs
                                            peer-focus:-translate-y-1.5
                                            peer-focus:text-gray-100
                                            peer-[:not(:placeholder-shown)]:text-xs
                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                            peer-[:not(:placeholder-shown)]:text-gray-100"
                                        >
                                            Quantity
                                        </label>
                                        @error('quantity')
                                            <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <!-- End quantity -->
                                    <!-- price -->
                                    <div class="relative w-10/12 my-4">
                                        <input
                                            :name="'price_at[' + index + ']'"
                                            type="number"
                                            pattern="[0-9]*"
                                            :id="'hs-floating-gray-input-price-' + index"
                                            class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                            focus:pt-6
                                            focus:pb-2
                                            [&:not(:placeholder-shown)]:pt-7
                                            [&:not(:placeholder-shown)]:pb-2
                                            autofill:pt-6
                                            autofill:pb-2"
                                            placeholder="Enter price"
                                            x-model="item.price_at"
                                            style="-moz-appearance: textfield;"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            @input="calculateSubtotal(index); console.log('item.subTotal:', item.subTotal);"
                                            required
                                            min="1"
                                            >
                                        <label
                                            :for="'hs-floating-gray-input-price-' + index"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                            peer-focus:text-xs
                                            peer-focus:-translate-y-1.5
                                            peer-focus:text-gray-100
                                            peer-[:not(:placeholder-shown)]:text-xs
                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                            peer-[:not(:placeholder-shown)]:text-gray-100"
                                        >
                                            Price per item
                                        </label>
                                        @error('price')
                                            <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <!-- End price -->
                                    <!-- sub total -->
                                    <div class="relative w-10/12 my-4">
                                        <input
                                        :name="'subTotal[' + index + ']'"
                                        type="number"
                                        pattern="[0-9]*"
                                        :id="'hs-floating-gray-input-subTotal-' + index"
                                        class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                        focus:pt-6
                                        focus:pb-2
                                        [&:not(:placeholder-shown)]:pt-7
                                        [&:not(:placeholder-shown)]:pb-2
                                        autofill:pt-6
                                        autofill:pb-2"
                                        placeholder="Enter subTotal"
                                        x-model="item.subTotal"
                                        style="-moz-appearance: textfield;"
                                        disabled
                                        >
                                        <label
                                        :for="'hs-floating-gray-input-subTotal-' + index"
                                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                        peer-focus:text-xs
                                        peer-focus:-translate-y-1.5
                                        peer-focus:text-gray-100
                                        peer-[:not(:placeholder-shown)]:text-xs
                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                        peer-[:not(:placeholder-shown)]:text-gray-100"
                                        >
                                        Sub Total
                                    </label>
                                    @error('subTotal')
                                    <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- End sub total -->
                                {{-- button remove --}}
                                <div class="relative w-10/12 my-4">
                                    <div class="w-full">
                                        <button 
                                            type="button" 
                                            class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                            x-on:click.prevent="transactionDetails.splice(index, 1); updateTotalPrice();"
                                        >
                                            Remove item
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        {{-- end detail transaksi --}}
                            <div class="w-full flex justify-between items-center">
                                <p class="text-white">
                                    Total Price: Rp.<span x-text="totalPrice"></span>
                                </p>
                                <button 
                                    type="submit" 
                                    class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:ring focus:border-green-800 dark:bg-green-700 dark:hover:bg-green-900 dark:focus:outline-none dark:focus:ring dark:focus:border-green-800"
                                >
                                    Save Data
                                </button>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
            {{-- right card --}}
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <x-table :data="$items" :filterFields="'[\'kode_barang\',\'name\', \'stock\', \'price\', \'discount\']'">
                            <x-slot name="newData">
                                <x-button-link :href="route('warehouse.item.create')" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:ring focus:border-green-800 dark:bg-green-700 dark:hover:bg-green-900 dark:focus:outline-none dark:focus:ring dark:focus:border-green-800">
                                    Add Data
                                </x-button-link>
                            </x-slot>
                            <!-- Table Header -->
                            <x-slot name="header">
                                <tr>
                                    <th scope="col" class="px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400">No</th>
                                    <th scope="col" class="px-1 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Kode Barang</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Name</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Stock</th>
                                    <th scope="col" class="px-0 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400 w-fit">Action</th>
                                </tr>
                            </x-slot>
    
                            <!-- Table Body -->
                            <x-slot name="body">
                                <tr x-show="paginatedData.length === 0">
                                    <td colspan="7" class="text-center py-4">No data available</td>
                                </tr>
                                <template x-for="(item, index) in paginatedData" :key="index">
                                    <tr class="even:bg-white odd:bg-gray-100 hover:bg-gray-100 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:hover:bg-gray-700">
                                        <td x-text="item.number" class="px-1 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                        <td x-text="item.kode_barang" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                        <td x-text="item.name" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                        <td x-text="item.stock" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                        <td class="px-0 py-2 whitespace-nowrap text-center text-sm font-medium w-fit">
                                            <button 
                                                type="button" 
                                                class="py-1 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                                x-on:click.prevent="transactionDetails.push({...item, 'price_at':0, 'quantity':0})"
                                                >
                                                Add
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </x-slot>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
