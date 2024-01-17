<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Preview') }}
            </h2>
            <span class="text-slate-400 text-sm">*Klik Kolom dari masing masing file</span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 dark:text-white gap-2">
                <section class="flex flex-col space-y-4 bg-slate-800 text-white p-4 rounded-md">
                    <h5 class="text-xl font-bold text-white">File 1</h5>
                    @if(isset($data1) && $data1->count())
                        @foreach ($data1 as $index => $collection)
                            <div class="grid grid-cols-3 border-b border-slate-700 overflow-x-auto">
                                @foreach ($collection as $item)
                                    <span class="mb-2">{{ $item }}</span>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <p>No data found for File 1.</p>
                    @endif
                </section>
                <section class="flex flex-col space-y-4 bg-slate-800 text-white p-4 rounded-md">
                    <h5 class="text-xl font-bold text-white">File 2</h5>
                    @if(isset($data2) && $data2->count())
                        @foreach ($data2 as $index => $collection)
                            <div class="grid grid-cols-3 border-b border-slate-700">
                                @foreach ($collection as $item)
                                    <span class="mb-2">{{ $item }} </span>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <p>No data found for File 2.</p>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>