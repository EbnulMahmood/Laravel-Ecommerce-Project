<div>
    <ul class="list-group list-group-flush mb-3">

        <div id="cart-items">
        </div>

        <li class="list-group-item p-4 bg-light text-muted">
            <div class="d-flex justify-content-between">
                <div>
                    <small>Promocode: EXAMPLECODE</small>
                </div>
                <span>-$500</span>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <small>Discount 15%</small>
                </div>
                <span>-$15</span>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <small>Shipping</small>
                </div>
                <span>$0</span>
            </div>
        </li>

        <li class="list-group-item p-4 d-flex justify-content-between">
            <strong>Total (BDT)</strong>
            <strong id="cart-total"></strong>
        </li>

    </ul>
  
    <!-- Sidebar Buttons -->
  
    <div class="row justify-content-center pt-3 m-0">
        <div class="col-8">
            <button type="submit" class="btn btn-rounded btn-sm btn-block btn-dark px-5">Go to checkout</button>
            <a href="{{ route('my.cart') }}" type="button" class="btn btn-rounded btn-sm btn-block btn-dark px-5">Shopping cart</a>
            <div class="divider-separator">
                <span>Or</span>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-block px-3">Continue shopping</button>
            </div>
        </div>
    </div>
  
</div>

<script>
    
    const getCartJSON = async function(url, status = 0) {
        await fetch(url)
        .then(
            function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok!');
                }
                // Examine the text in the response
                response.json().then(function(data) {
                    if (status === 1) {
                        getCartData(data)
                    } else {
                        removeCartItemData(data)
                    }
                });
            }
        )
        .catch(function(err) {
            alert(err.message)
        })
    }

    function cartItems() {
        getCartJSON("{{ url('/product/cart/ajax') }}", 1)
    }

    cartItems()

    function removeCartItem(rowId) {
        getCartJSON("{{ url('/remove/cart-product/ajax') }}/" + rowId)
    }
    
</script>