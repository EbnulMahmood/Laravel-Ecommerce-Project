@php
    $route = Route::current()->getName();
    $step = 1;
    if ($route == 'checkout') {
        $step = 1;
    } else if ($route == 'shipping') {
        $step = 2;
    } else if ($route == 'checkout.store') {
        $step = 3;
    } else if ($route == 'order.receipt') {
        $step = 4;
    }
@endphp
<div class="pt-3 pt-lg-4 pb-5 pb-lg-6 mb-2 mb-lg-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="steps steps-sm">
                    <ul class="row">

                        <li class="col {{ ($step > 1) ? 'active' : '' }} {{ ($route == 'checkout') ? 'current' : '' }}">
                            <a href="{{ route('checkout') }}">
                                <span class="step-item" data-text="Checkout">
                                    <span>1</span>
                                </span>
                            </a>
                        </li>
                        <li class="col {{ ($step > 2) ? 'active' : '' }} {{ ($route == 'shipping') ? 'current' : '' }}">
                            <a href="{{ route('shipping') }}">
                                <span class="step-item" data-text="Shipping">
                                    <span>2</span>
                                </span>
                            </a>
                        </li>
                        <li class="col {{ ($step > 3) ? 'active' : '' }} {{ ($route == 'checkout.store') ? 'current' : '' }}">
                            <a>
                                <span class="step-item" data-text="Payment">
                                    <span>3</span>
                                </span>
                            </a>
                        </li>
                        <li class="col {{ ($step > 4) ? 'active' : '' }} {{ ($route == 'order.receipt') ? 'current' : '' }}">
                            <a>
                                <span class="step-item" data-text="Receipt">
                                    <span>4</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>