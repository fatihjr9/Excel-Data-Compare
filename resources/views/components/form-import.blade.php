<form action="{{ route('dashboard.preview') }}" method="post" enctype="multipart/form-data" class="flex flex-col space-y-4">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        <input name="data_pertama" class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input_1" type="file">
        <input name="data_kedua" class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input_2" type="file">
    </div>
    <div class="flex flex-row gap-2">
        <button class="py-2 rounded-md w-full bg-indigo-600 text-white font-bold" type="submit">Submit</button>
    </div>
</form>