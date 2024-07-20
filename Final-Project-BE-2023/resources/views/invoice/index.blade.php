@extends('partial.base')

@section('title', 'Invoice Page')

@section('style')
    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection

@section('content')

    <section class="h-100">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">
                    <div class="w-100 d-flex justify-content-between align-items-center flex-column gap-4 mb-4">
                        <h3 class="fw-normal mb-0 text-black">Transaction History</h3>
                    </div>

                    @if ($finalInvoice)

                        <a class="link-back link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                            href="{{ route('user.account') }}">
                            Back to Account Page
                        </a>

                        @foreach ($finalInvoice as $item)
                        <div class="card my-3 p-2">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="col-6">
                                        <h3 class="fw-bold mb-3">Invoice ID : {{ $item['invoice']->id }}</h3>
                                    </div>
                                </div>
                        
                                <div class="row">
                                    <div class="col-xl-8">
                                        <ul class="list-unstyled">
                                            <li class="text-muted">To : <span class="fw-bold">{{ auth()->user()->firstName }}</span></li>
                                            <li class="text-muted">Date : <span class="fw-bold">{{ $item['invoice']->created_at->format('d-M-y') }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                        
                                <div class="row my-2 mx-1 justify-content-center">
                                    <table class="table table-borderless">
                                        <thead class="text-center">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @php
                                                $number = 1;
                                            @endphp
                                            @foreach ($item['invoiceDetail'] as $sub_item)
                                                <tr>
                                                    <td>{{ $number }}</td>
                                                    <td>{{ $sub_item->toy->name }}</td>
                                                    <td>{{ $sub_item->toy->price }}</td>
                                                    <td>{{ $sub_item->quantity }}</td>
                                                    <td>{{ $sub_item->subTotal }}</td>
                                                </tr>
                                            @php
                                                $number++;
                                            @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        
                                <div class="row">
                                    <div class="col-xl-12">
                                        <ul class="list-unstyled">
                                            <li class="d-flex justify-content-between text-muted ms-3">
                                                <span class="text-black me-4">Total</span>Rp {{ number_format($item['invoice']->total_price - 50000) }}
                                            </li>
                                            <li class="d-flex justify-content-between text-muted ms-3 mt-2">
                                                <span class="text-black me-4">Administration Fee</span>Rp 50,000
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="text-black float-start fw-bold d-flex justify-content-between">
                                        <span class="text-black me-3">Total Price</span>
                                        <span style="font-size: 25px;">Rp {{ number_format($item['invoice']->total_price) }}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                    @else
                        <div class="w-100 d-flex justify-content-center align-items-center flex-column gap-4">
                            <h5 class="fw-light">No transaction record has been found.</h5>
                            <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                href="{{ route('user.account') }}">
                                Back to Account Page
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>


@endsection
