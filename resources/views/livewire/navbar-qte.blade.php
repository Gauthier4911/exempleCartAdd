<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('app.home') }}">Furni<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0" x-data="{ totalQuantity: @entangle('totalQuantity') }" @cart-updated.window="totalQuantity = $wire.totalQuantity">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('app.home') }}">Home</a>
                </li>
                <li><a class="nav-link" href="{{ route('products.create') }}">Ajouter</a></li>
                <li>
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        <img src="{{ asset('images/cart.svg') }}" alt="">
                        <span class="mx-2 fw-bold">
                            <strong class="text-danger" x-text="totalQuantity"></strong>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
