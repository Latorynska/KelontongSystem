<x-app-layout>
    <div class="py-12 flex" x-data="{ selectedTransaction: {} }">
        {{-- transaction table --}}
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between p-2 text-lg font-bold">
                        <span>{{ $branch->name."'s transaction" }}</span>
                    </div>
                    <x-table :data="$branch->transactions" :filterFields="'[\'tanggal\', \'userName\']'">
                        <x-slot name="newData">
                        </x-slot>
                        <!-- Table Header -->
                        <x-slot name="header">
                            <tr>
                                <th scope="col" class="px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400">No</th>
                                <th scope="col" class="px-1 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Handled by</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Transaction Type</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Total Price</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Transaction Date</th>
                                <th scope="col" class="px-0 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400 w-fit">Action</th>
                            </tr>
                        </x-slot>

                        <!-- Table Body -->
                        <x-slot name="body">
                            <tr x-show="paginatedData.length === 0">
                                <td colspan="5" class="text-center py-4">No transaction yet</td>
                            </tr>
                            <template x-for="(transaction, index) in paginatedData" :key="index">
                                <tr class="even:bg-white odd:bg-gray-100 hover:bg-gray-100 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:hover:bg-gray-700">
                                    <td x-text="transaction.number" class="px-1 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="transaction.userName" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="transaction.type == 'in' ? 'Restock' : 'sale'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="transaction.totalPrice" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="transaction.tanggal" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td class="px-0 py-2 whitespace-nowrap text-center text-sm font-medium w-fit">
                                        <div class="hs-dropdown inline-flex">
                                            <button 
                                                type="button" 
                                                class="hs-dropdown-toggle py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                                x-on:click.prevent="selectedTransaction = transaction; console.log(selectedTransaction);" 
                                            >
                                                Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
        {{-- detail transaction table --}}
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between p-2 text-lg font-bold">
                        Transaction Detail
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-gray-400">No</th>
                                <th scope="col" class="px-1 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Item Name</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Quantity</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Price at</th>
                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">Sub total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr x-show="selectedTransaction === null || Object.keys(selectedTransaction).length === 0">
                                <td colspan="7" class="text-center py-4">No item yet</td>
                            </tr>
                            <template x-for="(detail, index) in selectedTransaction.transaction_details" :key="index">
                                <tr class="even:bg-white odd:bg-gray-100 hover:bg-gray-100 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:hover:bg-gray-700">
                                    <td x-text="index+1" class="px-1 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="detail.item.name" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="detail.quantity" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="detail.price_at" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="detail.quantity*detail.price_at" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
