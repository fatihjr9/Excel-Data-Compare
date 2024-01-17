<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Preview') }}
            </h2>
            <span class="text-slate-400 text-sm">*Klik centang jika data tersebut sama</span>
        </div>
    </x-slot>

    <style>
        .highlight {
            background-color: #4682B4;
            padding: .5rem;
            border-radius: .5rem;
        }
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row items-start justify-between dark:text-white gap-2">
                <section class="w-full flex flex-col space-y-4 bg-slate-800 text-white p-4 rounded-md">
                    <h5 class="text-xl font-bold text-white">File 1</h5>
                    @if(isset($data1) && $data1->count())
                        @foreach ($data1 as $index => $collection)
                            <div class="grid grid-cols-3 border-b border-slate-700">
                                @foreach ($collection as $item)
                                    <span class="mb-2">{{ $item }} </span>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <p>No data found for File 1.</p>
                    @endif
                </section>
                <section class="w-full flex flex-col space-y-4 bg-slate-800 text-white p-4 rounded-md">
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
                <section class="w-fit flex flex-col space-y-4 bg-slate-800 text-white p-4 rounded-md">
                    <h5 class="text-xl font-bold text-white">#</h5>
                    <div class="flex flex-col gap-y-4 border-b border-slate-700">
                        <span id="span1">Hei</span>
                        <span id="span2">Hei</span>
                        <input type="checkbox" id="check" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script>
        var checkbox = document.getElementById('check');
        var span1 = document.getElementById('span1');
        var span2 = document.getElementById('span2');
        checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            span1.classList.add('highlight');
            span2.classList.add('highlight');
        } else {
            span1.classList.remove('highlight');
            span2.classList.remove('highlight');
        }
        });
    </script>
</x-app-layout>