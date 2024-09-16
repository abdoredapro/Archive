<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title') | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{  asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{  asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{  asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{  asset('css/font.css') }}">
    <link rel="stylesheet" href="{{  asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/files.css') }}">
    <link rel="stylesheet" href="{{ asset('css/settings.css') }}">

    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css"/>
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>
    <link href="https://vjs.zencdn.net/8.16.1/video-js.css" rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset('assets2/vendor/css/rtl/core.css')}}" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="{{ asset('assets2/vendor/css/rtl/theme-default.css')}}"
          class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="{{ asset('assets2/css/demo.css')}}"/>
    <script src="{{ asset('assets2/vendor/js/helpers.js')}}"></script>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets2/vendor/libs/node-waves/node-waves.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets2/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets2/vendor/libs/typeahead-js/typeahead.css')}}"/>
    <script src="{{ asset('assets2/vendor/js/helpers.js')}}"></script>

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

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/linechart.js') }}"></script>
<script src="{{  asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{  asset('js/all.min.js') }}"></script>
<script src="{{ asset('js/columnchart.js') }}"></script>
<script src="{{ asset('js/donutchart.js') }}"></script>
<script src="{{ asset('js/areachart.js') }}"></script>
<script src="{{ asset('js/secondareachart.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets2/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{ asset('assets2/vendor/libs/popper/popper.js')}}"></script>
<script src="{{ asset('assets2/vendor/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets2/vendor/libs/node-waves/node-waves.js')}}"></script>
<script src="{{ asset('assets2/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{ asset('assets2/vendor/libs/hammer/hammer.js')}}"></script>
<script src="{{ asset('assets2/vendor/libs/i18n/i18n.js')}}"></script>
<script src="{{ asset('assets2/vendor/libs/typeahead-js/typeahead.js')}}"></script>
<script src="{{ asset('assets2/vendor/js/menu.js')}}"></script>

<script>
    const deleteButtons = document.querySelectorAll('.delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();

            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من استعادة هذا المستخدم!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم, احذف!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        });
    });
</script>


<script src="https://vjs.zencdn.net/8.16.1/video.min.js"></script>
@yield('script')


@livewireScripts
</body>
</html>
