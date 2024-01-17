<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 p-4 rounded-md">
                <div class="flex flex-col space-y-1 border-b pb-2 border-gray-700 mb-2">
                    <h5 class="text-2xl font-bold text-white">Import File Excel</h5>
                    <p class="text-sm text-slate-400">Format yang didukung : CSV, XSLX</p>
                </div>
                <x-form-import data="[$data1, $data2]"/>
            </div>
        </div>
    </div>
</x-app-layout>
