<div class="box-container">
    @foreach ($products as $product)
        <form onsubmit="return false;" id="{{'form_product_' . $product->id}}" class="box">
            @CSRF
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <a class="fas fa-eye" href="/product/{{$product['id']}}"></a>
            <button type="submit" class="fas fa-shopping-cart" onclick="add_to_cart({{$product->id}})"></button>
            <img alt="{{$product->name}}" src="{{asset('storage/products/' . $product->img)}}">
            <a class="cat" href="/product/category/{{$product['id']}}">{{$product->category_name}}</a>
            <div class="name">{{$product->name}}</div>
            <div class="name">{{$product->store==0?"Sold out":"Store: ".$product->store}}</div>
            <div class="flex">
                <div class="price">{{$product->price}}<span> VND</span></div>
                <input type="number" name="quanlity" class="number" min="{{ $product->store == 0 ? 0 : 1 }}" max={{$product->store}}
                value="{{ $product->store == 0 ? 0 : 1 }}"  maxlength="2">
            </div>
        </form>
    @endforeach
</div>