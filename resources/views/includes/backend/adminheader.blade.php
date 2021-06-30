@php
    use App\Order;
    use App\Product;
    use App\Stock;
    use App\User;
    use Illuminate\Support\Facades\Session;
    Session::flash('usersCount', count(User::all()));
    Session::flash('productCount', count(Product::all()));
    Session::flash('ordersCount', count(Order::all()));
    Session::flash('stocksCount', count(Stock::all()));
@endphp

<meta charset="utf-8">
<meta name="description" content="Funko King Webshop">
<meta name="keywords" content="Funko Pop, Keychain, Action Figures, Shop">
<meta name="author" content="Angelino Verhaeghe 2020 Full Stack Developer">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<title>Funko King | Dashboard</title>

<link rel="stylesheet" href="{{asset('css/app.css')}}">
<style>
    .btn{

    }
</style>
<!-- Dropzone Style -->
@yield('styles')
<!-- Ck Editor Header -->
{{--@yield('ck-header')--}}
