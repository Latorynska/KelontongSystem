<x-app-layout>
    <div class="py-6 flex" x-data="{ selectedTransaction: {} }">
        {{-- transaction table --}}
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between p-2 text-lg font-bold">
                        <span>{{ $branch->name."'s item stock" }}</span>
                    </div>
                    <x-table :data="$branch->items" :filterFields="'[\'name\', \'userName\']'">
                        <x-slot name="newData">
                            <x-button-link
                                :href="route('item.data.view.print', ['id' => $branch->id])"
                                target="_blank"
                                type="button" 
                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-500 text-white hover:bg-gray-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            >
                                Export Data
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
                            </tr>
                        </x-slot>

                        <!-- Table Body -->
                        <x-slot name="body">
                            <tr x-show="paginatedData.length === 0">
                                <td colspan="6" class="text-center py-4">No Item yet</td>
                            </tr>
                            <template x-for="(item, index) in paginatedData" :key="index">
                                <tr class="even:bg-white odd:bg-gray-100 hover:bg-gray-100 dark:even:bg-gray-800 dark:odd:bg-gray-700 dark:hover:bg-gray-700">
                                    <td x-text="item.number" class="px-1 py-4 text-center whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="item.kode_barang" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="item.name" class="px-1 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="item.stock" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="item.price" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                    <td x-text="item.discount" class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                </tr>
                            </template>
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
