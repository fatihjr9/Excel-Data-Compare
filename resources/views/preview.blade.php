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
            <div class="grid grid-cols-1 dark:text-white gap-2 z-0 relative">
                <section class="flex flex-col space-y-4 bg-slate-800 text-white p-4 rounded-md">
                    <h5 class="text-xl font-bold text-white">Merged Data</h5>
                    @if(isset($mergedData) && count($mergedData) > 0)
                        @foreach ($mergedData as $key => $mergedRow)
                            <div class="grid grid-cols-6 border-b border-slate-700 p-2 rounded-md gap-y-2">
                                {{-- Display merged row data --}}
                                @foreach ($mergedRow['data1'] as $index => $value)
                                    <p class="col-span-2 @if($mergedRow['merged']) bg-slate-700 p-2 @endif">{{ $value }}</p>
                                @endforeach

                                @foreach ($mergedRow['data2'] as $index => $value)
                                    <p class="col-span-2 @if($mergedRow['merged']) bg-slate-700 p-2 @endif">{{ $value }}</p>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <p>No merged data found.</p>
                    @endif
                </section>
            </div>
            <a href="{{ route('dashboard.download', ['files' => $fileName]) }}" type="submit" class="w-full py-2 rounded-md bg-slate-800 text-white mt-6 z-20 relative text-center">
                Download Merged Data
            </a>

        </div>
    </div>
</x-app-layout>