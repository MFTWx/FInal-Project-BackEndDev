@extends('partial.base')

@section('title', 'Cart Page')

@section('style')
    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection

@section('script')

@endsection

@section('content')

    <section class="h-100">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">
                    <div class="w-100 d-flex justify-content-between align-items-center flex-column gap-4 mb-4">
                        <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                    </div>

                    @if ($toys)
                        <div class="w-100 d-flex justify-content-center align-items-center flex-column gap-4 mb-4">
                            <h5 class="fw-light">Your account balance right now is Rp
                                {{ number_format(Auth::user()->money) }}
                            </h5>
                        </div>
                        <?php $subTotal = 0; ?>
                        @foreach ($toys as $toy)
                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src='https://picsum.photos/400/300' class="img-fluid rounded-3"
                                                alt="toy's image">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2">{{ $toy['name'] }}</p>
                                            <p><span class="badge text-bg-primary">{{ $toy['category'] }}</span></p>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <input id="form1" min="0" name="quantity"
                                                value="{{ $toy['quantity'] > $toy['stock'] ? $toy['stock'] : $toy['quantity'] }}" type="number"
                                                class="form-control form-control-sm" disabled />
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h5 class="mb-0">Rp {{ number_format($toy['price']) }}</h5>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <form action="{{ route('toys.order.delete', $toy['id']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $subTotal += $toy['price'] * $toy['quantity']; ?>
                        @endforeach

                        <div class="card rounded-3 mb-4 p-4">
                            <h4 class="mb-3">Payment</h4>
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-light">Sub Total</h6>
                                <h6 class="fw-light">Rp {{ number_format($subTotal) }}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-light">Administration Fee</h6>
                                <h6 class="fw-light">Rp 50.000</h6>
                            </div>
                            <hr>
                            <div class="mt-3 mb-3 d-flex justify-content-between">
                                <h4 class="fw-semi-bold">Total Price</h4>
                                <h4 class="fw-semi-bold text-primary">Rp {{ number_format($subTotal + 50000) }}</h4>
                            </div>
                        </div>

                        @if (Auth::user()->money >= $subTotal + 50000)
                            <div class="t-3">
                                <form action="{{ route('checkout.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="total_price" value="{{ $subTotal + 50000 }}">
                                    <button class="w-100 btn btn-outline-success btn-block btn-lg">Checkout Now!</button>
                                </form>
                            </div>
                        @else
                            <div class="t-3">
                                    <button class="w-100 btn btn-danger btn-block btn-lg">Insufficient Amount</button>
                            </div>
                        @endif

                        
                    @else
                        <div class="w-100 d-flex justify-content-center align-items-center flex-column gap-4">
                            <h5 class="fw-light">Your cart is empty. Please add some items to your cart.</h5>
                            <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                href="{{ route('home.product') }}">
                                Back to Product Page
                            </a>
                        </div>
                    @endif



                </div>
            </div>
        </div>
    </section>

@endsection
