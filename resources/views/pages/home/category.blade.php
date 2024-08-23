@extends('layouts.master')
<style>
    .box.active {
        background-color: var(--black);
    }

    .box.active img {
        filter: brightness(0) invert(1);
    }

    .box.active h3 {
        color: white !important;
    }
</style>
@section('content')
<section class="category">
    <h1 class="title">category</h1>
    <div class="box-container">
        @foreach ($categories as $category)
            <a href="/product/category/{{$category['id']}}" class="box {{ $category['id'] == $id ? 'active' : '' }}">
                <img src="{{asset('storage/categories/' . $category->img)}}" alt="{{$category->name}}">
                <h3>{{$category->name}}</h3>
            </a>
        @endforeach
    </div>
</section>
<section class="products">
    <h1 class="title">latest</h1>
    @include('components.home.product', ['products' => $products])
</section>
@endsection