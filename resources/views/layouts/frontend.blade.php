<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Funko King Webshop">
    <meta name="keywords" content="Funko Pop, Keychain, Action Figures, Shop">
    <meta name="author" content="Angelino Verhaeghe 2020 Full Stack Developer">
    <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{asset('css/front-app.css')}}">
    @yield('scripts')
    @yield('stripe-extra')

    <title>@yield('title')</title>

</head>
<body>
<div id="app">
<div class="container-fluid">
    <!-- Navbar Start -->
@include('includes.frontend.navbar')
<!-- Navbar Ends -->

@yield('content')

<!--Section Social -->
@include('includes.frontend.social')
<!-- End Section Social -->

    <!-- Footer Start -->
@include('includes.frontend.footer')
<!-- Footer Ends -->

</div>
</div>
{{--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="/path/to/wan-spinner.js"></script>--}}
{{--@yield('shop-scripts')--}}
{{--<script src='https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.0.3/nouislider.min.js'></script>--}}

<script src="{{asset('js/front-app.js')}}"></script>
@yield('image-script')
{{--@yield('stripe-script')--}}
@yield('extra-js-stripe')
</body>

</html>
