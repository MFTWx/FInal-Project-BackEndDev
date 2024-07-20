@extends('partial.base')

@section('title', 'Account Page')

@section('style')
    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection

@section('content')

    <section class="w-100 px-4 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="{{ asset('img/userprofile.jpg') }}" class="img-fluid"
                                    style="width: 355px; height: 360x; border-radius: 10px; object-fit: cover;">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1">Account Information</h5>
                                <p class="mb-2 pb-1">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p>
                                <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                    <div>
                                        <p class="small text-muted mb-1">Email</p>
                                        <p class="mb-0">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                    <div>
                                        <p class="small text-muted mb-1">Contact Number</p>
                                        <p class="mb-0">+62 {{ Auth::user()->contact }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                    <div>
                                        <p class="small text-muted mb-1">Birthday</p>
                                        <p class="mb-0">
                                            {{ \Carbon\Carbon::parse(Auth::user()->birthday)->format('d-m-Y') }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                    <div>
                                        <p class="small text-muted mb-1">Address</p>
                                        <p class="mb-0">{{ Auth::user()->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-100 px-4 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <div class="d-flex">
                            <div class="flex-grow-1 ms-3">
                                <h3 class="w-100 d-flex justify-content-center align-items-center flex-column"
                                    style="min-height: 10vh;">
                                    Account Balance
                                </h3>
                                <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                    <div>
                                        <p class="small text-muted mb-1">Balance</p>
                                        <p class="mb-0">Rp. {{ number_format(Auth::user()->money) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded-3 p-2 mb-2">
                                    <div>
                                        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                            href="{{route('user.topup')}}">
                                            + Add Balance
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w-100 px-4 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <div class="d-flex">
                            <div class="flex-grow-1 ms-3">
                                <h3 class="w-100 d-flex justify-content-center align-items-center flex-column"
                                    style="min-height: 10vh;">
                                    Transaction History
                                </h3>
                                <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                    <div>
                                        <p class="small text-muted mb-1">Number of Transaction</p>
                                        <p class="mb-0">{{ $invoiceCount }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded-3 p-2 mb-2">
                                    <div>
                                        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                            href="{{ route('invoice.home') }}">
                                            + More Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
