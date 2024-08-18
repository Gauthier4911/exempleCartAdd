<div class="row">
    @foreach($products as $product)
        <!-- Start Column 1 -->
        <div class="col-12 col-md-4 col-lg-3 mb-5">
            <span class="product-item" >
                <img src="{{asset("storage/imageArticle/".$product->image)}}" class="img-fluid product-thumbnail" alt="">
                <h3 class="product-title">{{ $product->title }}</h3>
                <strong class="product-price">${{ $product->price }}</strong>
                <span type="button" wire:click="addToCart({{ $product->id }})">
                <span class="icon-cross">
                    <img src="{{asset('images/cross.svg')}}" class="img-fluid" alt="">
                </span>
                </span>
            </span>
        </div>
    @endforeach
    <!-- End Column 1 -->
</div>
