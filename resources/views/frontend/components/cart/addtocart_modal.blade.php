
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myLargeModalLabel"><span id="product_name"></span></h5>
            <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card card-fill br-lg">
                        <img id="product_thumbnail" src="{{ asset('upload/default_product.jpg') }}" class="card-img-top" alt="Product Iamge">
                        <div class="card-body">
                            <h4 class="card-title" id="product_name_en"></h4>
                            <p class="card-text">Category: <strong id="category_name_en"></strong></p>
                        </div>
                        <div class="card-footer card-footer-bottom">
                            <div class="row align-items-center">
                                <div class="col-6">Code: <strong id="product_code">None</strong></div>
                                <div class="col-6 text-right">
                                    <div class="card-price">
                                        <span id="discount_price"></span>
                                    </div>
                                    <small class="text-uppercase">
                                        <s id="selling_price"></s>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-12">
                    <div class="bg-light shadow-sm br-sm p-3 p-lg-4">

                        <!-- Product order -->
                        
                        <div class="clearfix">
                        
                            <!-- Product brand -->
                        
                            <div class="row">
                                <div class="col-6 col-lg-12">
                                    <div class="row mb-2">
                                        <div class="col-xl-4">
                                            <span class="text-muted">Brand</span>
                                        </div>
                                        <div class="col-xl-8" id="brand_name_en">None</div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12">
                                    <div class="row mb-2">
                                        <div class="col-xl-4">
                                            <span class="text-muted">Materials</span>
                                        </div>
                                        <div class="col-xl-8">Plastic, Leather</div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12">
                                    <div class="row mb-2">
                                        <div class="col-xl-4">
                                            <span class="text-muted">Shipping</span>
                                        </div>
                                        <div class="col-xl-8">
                                            <i class="icon icon-checkmark-circle"></i> Free shipping
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12">
                                    <div class="row mb-2">
                                        <div class="col-xl-4">
                                            <span class="text-muted">Availability</span>
                                        </div>
                                        <div id="in-stock" class="col-xl-8 text-success">
                                            <i class="icon icon-checkmark-circle"></i> In stock
                                        </div>
                                        <div id="out-of-stock" class="col-xl-8 text-danger">
                                            <i class="icon icon-cross-circle"></i> Out of stock
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <hr />
                        
                            <!-- Product size -->
                                
                            <div id="sizeArea" class="mb-2">
                                <div class="text-muted pre-label mb-2">
                                    <small>
                                        Choose size
                                    </small>
                                </div>
                                <div class="form-group w-100">
                                    <select id="size" name="size" class="form-control form-control-sm">
                                    </select>
                                </div>
                            </div>
                        
                            <hr />
                            
                            <!-- Product colors -->
                            
                            
                            <div id="colorArea" class="mb-2">
                                <div class="text-muted pre-label mb-2">
                                    <small>
                                        Choose color
                                    </small>
                                </div>
                                <div class="form-group w-100">
                                    <select id="color" name="color" class="form-control form-control-sm">
                                    </select>
                                </div>
                            </div>
                        
                            <hr>
    
                            <!-- Product quantity -->
                            <input type="hidden" id="product_id">
                            <div class="mb-2">
                                <div class="row">
                                    <div class="col-5">
                                        <input id="quantity" type="number" class="form-control mr-2" value="1" min="1">
                                    </div>
                                    <div class="col-7" id="cart-toggle">
                                        <button onclick="addToCart()" class="btn btn-block btn-primary">
                                            <i class="icon icon-cart"></i> Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        
                            <hr />
                         
                        </div>
    
                        <!-- Add to basket -->
                        <div class="btn-group w-100">
                            <button id="wishlist-value" onclick="addToWishlist(this.value)" type="submit" title="Add to wishlist"
                                class="btn btn-sm btn-outline-primary">
                                <span><i class="fa fa-heart-o"></i> Wish</span>
                            </button>
                            <span class="btn btn-sm btn-outline-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                                <span class="show"><i class="fa fa-eye-slash"></i> Watch</span>
                                <span class="hide"><i class="fa fa-eye"></i> Watching</span>
                            </span>
                        </div>
    
    
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script>
    
    const getJSON = async function(url, id) {
        await fetch(url)
        .then(
            function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok!');
                }
                // Examine the text in the response
                response.json().then(function(data) {
                    getProductData(data, id)
                });
            }
        )
        .catch(function(err) {
            alert(err.message)
        })
    }

    function productView(id) {
        getJSON("{{ url('/product/modal/ajax') }}/" + id, id)
    }

    // Example POST method implementation:
    const postData = async function(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            // 'Content-Type': 'application/x-www-form-urlencoded',
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }

    function addToCart() {
        const product_id = $('#product_id').val()
        const product_name_en = $('#product_name_en').text()
        const product_color_en = $('#color option:selected').val()
        const product_size_en = $('#size option:selected').val()
        const quantity = $('#quantity').val()

        postData("{{ url('/cart/data/store') }}/" + product_id, {
            product_name_en: product_name_en,
            product_color_en: product_color_en,
            product_size_en: product_size_en,
            quantity: quantity,
        })
        .then(data => {
            $('#closeModal').click()
            cartItems()
            getToastAlert(data)
        });
    }

</script>