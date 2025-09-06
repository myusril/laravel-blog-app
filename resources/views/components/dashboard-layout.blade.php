<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-dashboard-navbar></x-dashboard-navbar>

    <x-dashboard-sidebar></x-dashboard-sidebar>

    <main class="p-4 md:ml-64 h-auto pt-20">
        {{ $slot }}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <script src="/js/category-slug.js"></script>
    <script src="/js/post-slug.js"></script>
</body>

</html>
