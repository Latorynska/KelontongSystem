<x-app-layout>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Selamat datang di halaman manage gudang, ".Auth::user()->name."!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>