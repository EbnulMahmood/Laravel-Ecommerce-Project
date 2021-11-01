<div class="col-6 col-xl-3 p-1">
    <div class="wow fadeInUp" data-wow-delay=".1s">
        <div class="card card-fill">
            <div class="card-image">
                <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->product_slug_en]) }}">
                    <img src="{{ asset($product->product_thumbnail) }}" class="card-img-top" alt="Product Image">
                </a>
                @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount/$product->selling_price) * 100;
                @endphp
                    @if ($product->discount_price == NULL)
                        <small class="card-badge badge badge-success text-uppercase mr-2">
                            new
                        </small>
                    @else
                        <small class="card-badge badge badge-danger text-uppercase mr-2">
                            {{ round($discount) }}%
                        </small>
                    @endif
            </div>
            <div class="card-body p-3 p-lg-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="card-title mb-1 h5">
                            <a href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->product_slug_en]) }}" class="text-dark">
                                {{ (session()->get('language') == 'bangla') ? $product->product_name_bn : $product->product_name_en }}
                            </a>
                        </h2>
                        <small class="pre-label text-muted">
                            @if ($product->discount_price == NULL)
                                <span>{{ $product->selling_price }}৳</span>
                            @else
                                <span>{{ $product->discount_price }}৳</span>
                                <s>{{ $product->selling_price }}৳</s>
                            @endif
                        </small>
                    </div>
                    <div>
                        <a id="{{ $product->id }}" onclick="productView(this.id)" type="button" class="d-inline-block" data-toggle="modal" data-target=".bd-example-modal-lg" data-placement="top" title="Add to cart">
                            <i class="icon icon-cart font-size-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>