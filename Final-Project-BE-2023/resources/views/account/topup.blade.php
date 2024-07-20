@extends('partial.base')

@section('title', 'Top Up Page')

@section('style')

    <style>
        .card-centered {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 2rem;
        }

        .card-custom {
            width: 100%;
            max-width: 500px;
            /* Increased max-width for a larger card */
        }

        .form-group {
            margin-bottom: 1.5rem;
            /* Added spacing between form groups */
        }

        .card-body {
            padding: 2rem;
        }

        .btn-center {
            display: flex;
            justify-content: center;
        }

        .balance-card {
            background-color: #f0f0f0;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .link-back {
            margin-bottom: 0.5rem; /* Adjust margin bottom for the link */
        }
    </style>

@endsection

@section('content')

    <div class="container">
        <a class="link-back link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{route('user.account')}}">
            Back to Account Page
        </a>

        <div class="card-centered">
            <div class="card card-custom shadow">
                <div class="card-body">
                    <div class="balance-card">
                        <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                            <div>
                                <p class="small text-muted mb-1">Balance</p>
                                <p class="mb-0">Rp. {{ number_format(Auth::user()->money) }}</p>
                            </div>
                        </div>
                    </div>

                    <h5 class="card-title text-center">Top Up Payment</h5>
                    <form action="{{ route('user.add') }}" method="POST" class="mx-2 mx-md-4">
                        @csrf
                        <div class="form-group">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" class="form-control" id="cardNumber" name="card_number" placeholder="Enter card number">
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount">
                        </div>
                        <div class="form-group">
                            <label for="password">Account Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        </div>
                        <div class="form-group btn-center">
                            <button class="btn btn-outline-primary">Proceed Payment</button>
                        </div>
                    </form>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
