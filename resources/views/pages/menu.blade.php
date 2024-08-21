@extends('layouts.master')

@section('content')
<div class="heading">
    <h3>our menu</h3>
</div>
<section class="products">
    <h1 class="title">latest</h1>
    @include('components.product', ['products' => $products])
</section>
@endsection