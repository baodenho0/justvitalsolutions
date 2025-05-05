<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>{{ $section->title }}</h2>
                <p class="lead">{{ $section->subtitle }}</p>
            </div>
        </div>

        @if(isset($section->extra_data['products']) && is_array($section->extra_data['products']))
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="widget">
                    <h6 class="title">Shopping Cart</h6>
                    <hr>
                    <ul class="cart-overview">
                        @foreach($section->extra_data['products'] as $product)
                        <li>
                            <a href="#">
                                @if(isset($product['image']))
                                <img alt="{{ $product['name'] ?? 'Product' }}" src="{{ asset($product['image']) }}" />
                                @endif
                                <div class="description">
                                    <span class="product-title">{{ $product['name'] ?? 'Product' }}</span>
                                    <span class="price number">${{ number_format($product['price'] ?? 0, 2) }}</span>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <hr>
                    <div class="cart-controls">
                        <a class="btn btn-sm btn-filled" href="#">Checkout</a>
                        <div class="list-inline pull-right">
                            <span class="cart-total">Total: </span>
                            <span class="number">${{ number_format(array_sum(array_column($section->extra_data['products'], 'price')), 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($section->button_text)
        <div class="row text-center mt32">
            <a href="{{ $section->button_url ?? '#' }}" class="btn btn-lg btn-filled">{{ $section->button_text }}</a>
        </div>
        @endif
    </div>
</section>
