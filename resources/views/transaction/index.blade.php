<x-app-layout>
    <div x-data="{ 
        transactionDetails: [],
        totalPrice: 0,
        change: 0,
        paid: 0,
        calculateSubtotal: function() {
            const item = this.selectedItem;
            const disc_per_item = item.price * (item.discount / 100);
            item.price_at = item.price - disc_per_item;
            item.subTotal = (item.quantity * item.price) - (item.quantity * disc_per_item);
            this.updateTotalPrice();
        },
        updateTotalPrice: function() {
            console.log('updatetotalprice');
            this.totalPrice = this.transactionDetails.reduce((total, item) => total + item.subTotal, 0);
        },
        selectedItem: {},
        submitToCart: function() {
            if(this.selectedItem.quantity <= this.selectedItem.stock && this.selectedItem.quantity >= 1){
                this.calculateSubtotal();
                this.transactionDetails.push(this.selectedItem);
                this.updateTotalPrice();
                this.calculateChange();
                this.selectedItem = {};
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Quantity input invalid',
                    text: 'Quantity cannot be more than stock or less than 1',
                });
            }
        },
        calculateChange: function() {
            this.change = this.paid - this.totalPrice;
        }
    }"
    x-init="transactionDetails = JSON.parse({{ json_encode(old('transactionItems') ?? '[]') }});updateTotalPrice();"
    >
        <div class="py-6 flex">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p class="text-white">
                            Customer Transaction
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-6 flex">
            {{-- left card --}}
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
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Price</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Discount</th>
                                    <th scope="col" class="px-5 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400 w-fit">Action</th>
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
                                        <td x-text="item.stock" class="px-1 py-4 text-center whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                        <td x-text="item.price" class="px-1 py-4 text-center whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                        <td x-text="item.discount" class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                        <td class="px-5 py-2 whitespace-nowrap text-center text-sm font-medium w-fit">
                                            <button 
                                                type="button" 
                                                class="py-1 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                                x-on:click.prevent="selectedItem = item"
                                                >
                                                Select
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </x-slot>
                        </x-table>
                    </div>
                </div>
                {{-- item info --}}
                <div class="pt-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="">
                                <input type="hidden" name="item_id" x-model="selectedItem.id"/>
                                <div class="w-full flex">
                                    <!-- kode barang -->
                                    <div class="relative w-full my-4 px-1">
                                        <input 
                                            name="kode_barang"
                                            type="text" 
                                            id="hs-floating-gray-input-kode-barang" 
                                            class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                            focus:pt-6
                                            focus:pb-2
                                            [&:not(:placeholder-shown)]:pt-7
                                            [&:not(:placeholder-shown)]:pb-2
                                            autofill:pt-6
                                            autofill:pb-2" 
                                            x-bind:value="selectedItem.kode_barang"
                                            readonly
                                        >
                                        <label 
                                            for="hs-floating-gray-input-kode-barang" 
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
                                    </div>
                                    <!-- End kode barang -->
                                    <!-- item name -->
                                    <div class="relative w-full my-4 px-1">
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
                                            x-bind:value="selectedItem.name"
                                            readonly
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
                                </div>
                                <div class="w-full flex mb-4">
                                    <!-- price -->
                                    <div class="relative w-full px-1">
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
                                            x-model="selectedItem.price"
                                            style="-moz-appearance: textfield;"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                            readonly
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
                                            Price per item
                                        </label>
                                        @error('price')
                                            <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <!-- End price -->
                                    <!-- Discount -->
                                    <div class="relative w-full px-1">
                                        <input 
                                            name="discount"
                                            type="text" 
                                            id="hs-floating-gray-input-discount" 
                                            class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                            focus:pt-6
                                            focus:pb-2
                                            [&:not(:placeholder-shown)]:pt-7
                                            [&:not(:placeholder-shown)]:pb-2
                                            autofill:pt-6
                                            autofill:pb-2" 
                                            placeholder="input new code here"
                                            x-model="selectedItem.discount"
                                            readonly
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
                                            Discount
                                        </label>
                                        @error('kode_barang')
                                            <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <!-- End Discount -->
                                </div>
                                <!-- quantity -->
                                <div class="relative w-full mb-2">
                                    <input
                                        name="quantity"
                                        type="number"
                                        pattern="[0-9]*"
                                        id="hs-floating-gray-input-quantity"
                                        class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                        focus:pt-6
                                        focus:pb-2
                                        [&:not(:placeholder-shown)]:pt-7
                                        [&:not(:placeholder-shown)]:pb-2
                                        autofill:pt-6
                                        autofill:pb-2"
                                        placeholder="Enter quantity"
                                        x-model="selectedItem.quantity"
                                        style="-moz-appearance: textfield;"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        {{-- @input="calculateSubtotal();" --}}
                                        required
                                        min="1"
                                        >
                                    <label
                                        for="hs-floating-gray-input-quantity"
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
                                <!-- sub total -->
                                <div class="relative w-full my-4">
                                    <input
                                        name="subTotal"
                                        type="number"
                                        pattern="[0-9]*"
                                        id="hs-floating-gray-input-subTotal"
                                        class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                        focus:pt-6
                                        focus:pb-2
                                        [&:not(:placeholder-shown)]:pt-7
                                        [&:not(:placeholder-shown)]:pb-2
                                        autofill:pt-6
                                        autofill:pb-2"
                                        placeholder="Enter subTotal"
                                        x-model="selectedItem.subTotal"
                                        style="-moz-appearance: textfield;"
                                        disabled
                                    >
                                    <label
                                        for="hs-floating-gray-input-subTotal"
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
                                {{-- buttons --}}
                                <div class="relative w-full my-4 flex">
                                    <div class="w-1/3 px-1">
                                        <button 
                                            type="reset" 
                                            class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                            x-on:click.prevent="selectedItem = {}"
                                        >
                                            Reset
                                        </button>
                                    </div>
                                    <div class="w-2/3 px-1">
                                        <button 
                                            type="button" 
                                            class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg text-white bg-green-700 rounded-md hover:bg-green-900 focus:outline-none focus:ring focus:border-green-800 dark:bg-green-700 dark:hover:bg-green-900 dark:focus:outline-none dark:focus:ring dark:focus:border-green-800"
                                            {{-- x-on:click.prevent="transactionDetails.push(selectedItem); selectedItem = {}" --}}
                                            x-on:click.prevent="submitToCart()"
                                        >
                                            Add to transaction
                                        </button>
                                    </div>
                                </div>
                                {{-- end buttons --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end left card --}}
            {{-- right card --}}
            <div class="w-10/12 mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form method="post" action="{{ route('transaction.store') }}">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                            <input type="hidden" name="transactionItems" :value="JSON.stringify(transactionDetails)">
                            <p class="text-white">
                                Transaction Detail
                            </p>

                            <div class="w-full flex">
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
                                <!-- current user -->
                                <div class="relative w-full my-4 px-1">
                                    <input 
                                        name=""
                                        type="text" 
                                        id="hs-floating-gray-input-username" 
                                        class="peer p-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-700 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600
                                        focus:pt-6
                                        focus:pb-2
                                        [&:not(:placeholder-shown)]:pt-7
                                        [&:not(:placeholder-shown)]:pb-2
                                        autofill:pt-6
                                        autofill:pb-2" 
                                        placeholder="input new code here"
                                        value="{{Auth::user()->name}}"
                                        readonly
                                    >
                                    <label 
                                        for="hs-floating-gray-input-username"
                                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                        peer-focus:text-xs
                                        peer-focus:-translate-y-1.5
                                        peer-focus:text-gray-100
                                        peer-[:not(:placeholder-shown)]:text-xs
                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                        peer-[:not(:placeholder-shown)]:text-gray-100"
                                    >
                                        Current User
                                    </label>
                                    @error('kode_barang')
                                        <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- End current user -->
                            </div>

                            {{-- detail transaksi --}}
                            <p class="text-white">
                                Transaction Detail
                            </p>
                            <div class="py-2">
                                <div class="border rounded-lg shadow overflow-hidden dark:border-gray-700 dark:shadow-gray-900">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col" class="px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400">No</th>
                                                <th scope="col" class="px-1 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Kode Barang</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Name</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Quantity</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Price</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Sub Total</th>
                                                <th scope="col" class="px-5 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400 w-fit">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr x-show="transactionDetails.length === 0">
                                                <td colspan="7" class="text-center py-4">No item yet</td>
                                            </tr>
                                            <template x-for="(item, index) in transactionDetails" :key="index">
                                                <tr class="even:bg-white odd:bg-gray-100 hover:bg-gray-100 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:hover:bg-gray-700">
                                                    <td x-text="item.number" class="px-1 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                                    <td x-text="item.kode_barang" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                                    <td x-text="item.name" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                                    <td x-text="item.quantity" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                                    <td x-text="item.price" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                                    <td x-text="item.subTotal" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                                    <td class="px-5 py-2 whitespace-nowrap text-center text-sm font-medium w-fit">
                                                        <button 
                                                            type="button" 
                                                            class="py-1 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                                            x-on:click.prevent="transactionDetails.splice(index, 1); updateTotalPrice();"
                                                            >
                                                            Select
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="text-white px-2">
                                    Total Price: Rp.<span x-text="totalPrice"></span>
                                </p>
                            </div>
                            {{-- end detail transaksi --}}
                            <div class="w-full flex justify-between items-center">
                                <!-- money paid -->
                                <div class="relative w-6/12 px-1">
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
                                        x-model="paid"
                                        style="-moz-appearance: textfield;"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        @input="calculateChange();"
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
                                        paid
                                    </label>
                                    @error('price')
                                        <p class="text-red-500 text-xs mt-1 ms-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- End money paid -->
                            </div>  
                            <div class="w-full flex justify-between items-center">
                            </div>
                            {{-- submit --}}
                            <div class="w-full flex justify-between item-end px-2 py-2">
                                <p class="text-white">
                                    Change: Rp.<span x-text="change"></span>
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
            {{-- end right card --}}
        </div>
    </div>
</x-app-layout>
