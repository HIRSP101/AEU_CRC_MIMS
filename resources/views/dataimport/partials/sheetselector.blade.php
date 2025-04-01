
<div class="relative flex justify-center items-center">
    <div id="menu" class="w-full h-full bg-gray-200 bg-opacity-80 top-0 right-0 fixed sticky-0 overflow-scroll hidden">
        <div class="2xl:container 2xl:mx-auto py-16 px-4 md:px-16 ">
            <div
                class="w-full md:w-auto dark:bg-gray-800 bg-white py-6 px-4 md:px-16 xl:py-18 xl:px-36 rounded-lg">
                <div id="sheetContainer"
                    class="relative flex flex-wrap flex-row justify-evenly gap-4 items-center font-siemreap">

                </div>
                <div id="progressContainer" class="hidden mt-4 w-full">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mb-2">
                        <div id="progressBar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                    </div>
                    <div class="flex justify-between">
                        <span id="progressStatus" class="text-sm text-gray-500">Processing...</span>
                        <span id="progressPercentage" class="text-sm text-gray-500">0%</span>
                    </div>
                </div>

                <div id="sheetTable">

                </div>
                <hr class="w-full mt-4 mb-2 bg-red-600 p-[1px] border dark:bg-red-600">
                <div class="flex justify-between items-center gap-4 sticky end-0">
                    <button id="sheetBtn" class="px-3 py-2 bg-red-500 text-white rounded-lg">Cancel</button>
                    <button id="sheetImport" class="px-3 py-2 bg-green-500 text-white rounded-lg">Import</button>
                </div>
            </div>
        </div>

    </div>
</div>
