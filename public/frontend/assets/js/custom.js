const toastAlert = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000
})

const getToastAlert = function (data) {
    if (!$.isEmptyObject(data.success)) {
        toastAlert.fire({
            icon: 'success',
            title: data.success,
        })
    } else if (!$.isEmptyObject(data.error)) {
        toastAlert.fire({
            icon: 'error',
            title: data.error,
        })
    } else if (!$.isEmptyObject(data.info)) {
        toastAlert.fire({
            icon: 'info',
            title: data.info,
        })
    } else {
        toastAlert.fire({
            icon: 'danger',
            title: 'Something went wrong!',
        })
    }
}


const getProductData = function (data, id) {

    $('#wishlist-value').val(id)
    $('#product_name').text(data.product.product_name_en)
    $('#product_name_en').text(data.product.product_name_en)
    if (data.product.discount_price === null) {
        $('#selling_price').text('')
        $('#discount_price').text('')
        $('#discount_price').text(data.product.discount_price + ' ৳')
    } else {
        $('#selling_price').text(data.product.selling_price + ' ৳')
        $('#discount_price').text(data.product.discount_price + ' ৳')
    }
    $('#category_name_en').text(data.product.category.category_name_en)
    $('#brand_name_en').text(data.product.brand.brand_name_en)
    $('#product_code').text(data.product.product_code)
    if (data.product.product_qty > 0) {
        $('#out-of-stock').hide()
        $('#in-stock').show()
        $('#cart-toggle').show()
    } else {
        $('#in-stock').hide()
        $('#out-of-stock').show()
        $('#cart-toggle').hide()
    }
    $('#product_id').val(id)
    $('#quantity').val(1)
    $('#product_thumbnail').attr('src', '/' + data.product.product_thumbnail)

    if (data.product_color_en[0] === '' || data.product_color_en === '') {
        $('#colorArea').hide()
    } else {
        $('#colorArea').show()
        $('select[name="color"]').empty()
        $('select[name="color"]').append(
            `<option value="" selected disabled>Select Color</option>`
        )
        $.each(data.product_color_en, function (_, value) {
            $('select[name="color"]').append(
                `<option value="${value}">${value}</option>`
            )
        })
    }

    if (data.product_size_en[0] === '' || data.product_size_en === '') {
        $('#sizeArea').hide()
    } else {
        $('#sizeArea').show()
        $('select[name="size"]').empty()
        $('select[name="size"]').append(
            `<option value="" selected disabled>Select Size</option>`
        )
        $.each(data.product_size_en, function (_, value) {
            $('select[name="size"]').append(
                `<option value="${value}">${value}</option>`
            )
        })
    }
}


const getCartData = function (data) {
    let cartItem = ''
    $('#cart-total').text(data.cartTotal + ' ৳')
    $('#cart-qty').text(data.cartQty)
    $('#cart-qty-icon').text(data.cartQty)
    if (data.carts.length === 0) {
        $('#cart-items').html(
            `<div class="box box-image p-5 br-lg">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <h4 class="mb-md-4 text-info">Your Cart is empty.</h4>
                    </div>
                </div>
            </div>
            `
        )
        return
    }
    $.each(data.carts, function (_, value) {
        cartItem += `
            <li class="list-group-item p-4">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-2 mb-2 mb-lg-0">
                        <img src="/${value.options.image}" alt="Product Image" class="img-fluid br-sm" />
                    </div>
                    <div class="col-md-6 pl-md-2 mb-2 mb-lg-0">
                        <p class="my-0">${value.name}</p>
                        <small class="text-muted">${value.price} ৳</small>
                    </div>
                    <div class="col-6 col-md-2">
                        <span class="form-control form-control-sm">${value.qty}</span>
                    </div>
                    <div class="col-6 col-md-2 text-right text-muted">
                        <a class="text-danger" type="submit" id="${value.rowId}" onclick="removeCartItem(this.id)">
                            <span class="icon icon-trash"></span>
                        </a>
                    </div>
                </div>
            </li>
        `
        $('#cart-items').html(cartItem)
    })
}

const removeCartItemData = function (data) {
    cartItems()
    if (typeof myCartItems === 'function') {
        myCartItems()
    }
    if (typeof couponCalculation === 'function') {
        couponCalculation()
    }
    getToastAlert(data)
}


const getWishlistData = function (data) {
    let wishlistItem = ''
    $('#wishlist-count').text(data.length)
    if (data.length === 0) {
        $('#wishlist-items').html(
            `<div class="box box-image p-5 br-lg">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <h4 class="mb-md-4 text-info">Your wishlist is empty.</h4>
                    </div>
                </div>
            </div>
            `
        )
        return
    }
    $.each(data, function (_, value) {
        wishlistItem += `
            <div class="card card-fill p-3 mb-3 shadow-sm bg-white">
                
                <div class="row align-items-center no-gutters p-md-2">
                    <div class="col-lg-2">
                        <img src="/${value.product.product_thumbnail}" class="img-fluid br-sm shadow-sm" alt="Product Image">
                    </div>
                    <div class="col-lg-5 pl-lg-3 py-2 py-lg-0">
                        <div><small class="pre-label">Name</small></div>
                        <div><strong>${value.product.product_name_en}</strong></div>
                    </div>
                    <div class="col-6 col-lg-3 text-left">
                        <div><small class="pre-label">Price</small></div>
                        <div>
                            ${value.product.discount_price == null ?
                `<span>${value.product.selling_price} ৳</span>` :
                `<span>${value.product.discount_price} ৳</span>
                             <s>${value.product.selling_price} ৳</s>`}
                        </div>
                    </div>
                    <div class="col-6 col-lg-2 text-right">
                        <div class="dropdown d-inline">
                            <button class="btn btn-icon btn-rounded btn-outline-gray" type="button" id="dropdownMenuButton-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon icon-menu text-dark"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-1">
                                <a id="${value.product_id}" onclick="productView(this.id)" type="button" class="dropdown-item text-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add to cart</a>
                                <a id="${value.id}" onclick="removeWishlistItem(this.id)" type="submit" class="dropdown-item text-danger">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `
        $('#wishlist-items').html(wishlistItem)
    })
}

const removeWishlistItemData = function (data) {
    wishlistItems()
    getToastAlert(data)
}


const getMyCartData = function (data) {
    $('#my-cart-count').text(data.cartQty)
    let myCartItem = ''
    if (data.carts.length === 0) {
        $('#my-cart-items').html(
            `<div class="box box-image p-5 br-lg">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <h4 class="mb-md-4 text-info">Your Cart is empty.</h4>
                    </div>
                </div>
            </div>
            `
        )
        return
    }
    $.each(data.carts, function (_, value) {
        myCartItem += `
            <div class="bg-white shadow-sm rounded mb-3 p-3 alert alert-dismissible" role="alert">
                <button id="${value.rowId}" onclick="removeMyCartItem(this.id)" type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Delete">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="row align-items-center no-gutters p-md-2">
                    <div class="col-lg-2">
                        <img src="/${value.options.image}" alt="Product Image" class="img-fluid" />
                    </div>
                    <div class="col-lg-5 pl-lg-3 mb-2 mb-lg-0">
                        <h2 class="h5 mb-0">${value.name}</h2>
                        <div>
                            <small class="text-muted">${value.options.color ? 'Color: <strong>' + value.options.color + '</strong>,' : ''}</small>
                        </div>
                        <div>
                            <small class="text-muted">${value.options.size ? 'Size: <strong>' + value.options.size + '</strong>' : ''}</small>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2">
                        ${value.qty > 1 ?
                `<button id="${value.rowId}" onclick="decrementMyCartQty(this.id)" type="submit" class="btn btn-danger btn-sm">-</button>` :
                `<button disabled type="submit" class="btn btn-danger btn-sm">-</button>`}
                        <input type="text" value="${value.qty}" min="1" disabled style="width: 25px;">
                        <button id="${value.rowId}" onclick="incrementMyCartQty(this.id)" type="submit" class="btn btn-success btn-sm">+</button>
                    </div>
                    <div class="col-6 col-lg-3 text-right">
                        <div class="h5 mb-0"><strong>${value.subtotal} ৳</strong></div>
                        <small class="text-muted">${value.qty} * <strong>${value.price} ৳</strong></small>
                    </div>
                </div>
            </div>
        `
        $('#my-cart-items').html(myCartItem)
    })
}

const removeMyCartItemData = function (data) {
    myCartItems()
    cartItems()
    couponCalculation()
    getToastAlert(data)
}

const incrementMyCartQtyData = function (data) {
    myCartItems()
    couponCalculation()
    cartItems()
}

const decrementMyCartQtyData = function (data) {
    myCartItems()
    couponCalculation()
    cartItems()
}


const getCouponData = function (data) {
    if (data.total) {
        $('#apply-coupon-success').html('')
        $('#apply-coupon-code').show()
        $('#coupon-code').val('')
        $('#coupon-info').html(
            `
                <div class="col-6">
                    <b>Sub-Total</b>
                </div>
                <div class="col-6 text-right">
                    ${data.total} ৳
                </div>
                <div class="col-6">
                    <b>Vat</b>
                </div>
                <div class="col-6 text-right">
                    $ 0.0
                </div>
            `
        )
        $('#coupon-cal-field').html(
            `
                <div class="row no-gutters">
                    <div class="col-6">
                        <div class="h4 mb-0">Grand Total</div>
                    </div>
                    <div class="col-6 text-right">
                        <div class="h4 mb-0">${data.total} ৳</div>
                    </div>
                </div>
            `
        )
    } else {
        $('#apply-coupon-code').hide()
        $('#apply-coupon-success').html(
            `
                <div id="apply-coupon-success" class="form-group">
                    <p class="text-success">Coupon Applied Successfully</p>
                </div>
            `
        )
        $('#coupon-info').html(
            `
                <div class="col-6">
                    <b>Coupon Name</b>
                </div>
                <div class="col-6 text-right">
                    <strong class="text-success">${data.coupon_name}</strong>
                    <button onclick="removeCoupon()" style="padding-left: 4px;" type="submit" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-6">
                    <b>Sub-Total</b>
                </div>
                <div class="col-6 text-right">
                    ${data.subtotal} ৳
                </div>
                <div class="col-6">
                    <b>Discount ${data.coupon_discount}%</b>
                </div>
                <div class="col-6 text-right">
                    ${data.discount_amount} ৳
                </div>
                <div class="col-6">
                    <b>Vat</b>
                </div>
                <div class="col-6 text-right">
                    $ 0.0
                </div>
            `
        )
        $('#coupon-cal-field').html(
            `
                <div class="row no-gutters">
                    <div class="col-6">
                        <div class="h4 mb-0">Grand Total</div>
                    </div>
                    <div class="col-6 text-right">
                        <div class="h4 mb-0">${data.total_amount} ৳</div>
                    </div>
                </div>
            `
        )
    }
}

const RemoveCouponData = function (data) {
    couponCalculation()
    getToastAlert(data)
}


const addDropdownData = function (data, status) {
    if (status === 1) {
        $('#state_id').html('');
        $('#state_id').append(
            `<option selected="selected" disabled="disabled" value="">Choose State...</option>`
        );
        $('#district_id').empty();
        if (!Array.isArray(data) || !data.length) {
            $('#district_id').append(
                `<option value="" selected="" disabled="">No District Found</option>`
            );
            $('#state_id').html('');
            $('#state_id').append(
                `<option value="" selected="" disabled="">No State Found</option>`
            );
        } else {
            $('#district_id').append(
                `<option selected="selected" disabled="disabled" value="">Choose District...</option>`
            );
            $.each(data, function (_, value) {
                $('#district_id').append(
                    `<option value="${value.id}">${value.district_name}</option>`
                );
            });
        }
    }
    else if (status === 0) {
        $('#state_id').empty();
        if (!Array.isArray(data) || !data.length) {
            $('#state_id').append(
                `<option value="" selected="" disabled="">No State Found</option>`
            );
        } else {
            $.each(data, function (key, value) {
                $('#state_id').append(
                    `<option value="${value.id}">${value.state_name}</option>`
                );
            });
        }
    }
}