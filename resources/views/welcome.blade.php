<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/js/app.js', 'resources/js/bootstrap.js')
</head>

<body class="bg-gray-100 p-8">
    <h1 class="text-xl font-bold mb-4">Test Progress</h1>


    <!-- Progress -->
    <div class="flex w-full h-3 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700" role="progressbar"
        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
        <div id="progressBar"
            class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500 dark:bg-blue-500">
            </div>
    </div>
    <!-- End Progress -->

    <div class="mt-4">
        <!-- Use a button instead of an anchor for triggering the action -->
        <button id="startProgress" class="px-4 py-2 bg-blue-500 text-white rounded-lg">
            Start Progress Update
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            document.getElementById('startProgress').addEventListener('click', function() {
                fetch('/test-progress', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    }
                });
            });
        });
    </script>
</body>

</html>
