<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title') | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    {{-- All style scripts  --}}
    @include('partials._style')

    @yield('style')

    
    @livewireStyles
</head>

<body>
<div class="page">
    <!-- sidebar -->
    <x-nav/>
    <!-- sidebar -->

    <!-- content -->
    <div class="content">
        <!-- header -->
        @include('dashboard.extends.header')
        <!-- header -->

        {{-- start content  --}}
        @yield('content')
        {{-- End Content  --}}

        <!-- footer -->
        @include('dashboard.extends.footer')
        <!-- footer -->

    </div>
    <!-- content -->

</div>


@include('partials._script')


@yield('script')

@livewireScripts
</body>
</html>
