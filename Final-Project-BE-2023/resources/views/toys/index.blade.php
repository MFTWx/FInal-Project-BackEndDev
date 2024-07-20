@extends('partial.base')

@section('title', 'Product Page')

@section('style')
    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection

@section('content')

    <div class="w-100 d-flex justify-content-center align-items-center flex-column gap-4" style="min-height: 15vh">
        <h3 class="fw-semibold">Anything on your mind right now?</h3>
        <div class="w-50">
            {{-- Search form --}}
            <form action="{{ route('home.search') }}" class="d-flex justify-content-center align-items-center gap-4">
                @csrf
                <input type="text" class="form-control" placeholder="Search for a toy ..." name="keyword"
                    value="{{ $search ?? '' }}">
                <button class="btn btn-outline-primary">Search</button>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center gap-4">
        @if (Request::routeIs('home.search'))
            <a class="btn btn-outline-primary" href="{{ route('home.product') }}">All Products</a>
        @else
            @php
                $isHome = Request::routeIs('home.product');
            @endphp
            <a class="btn {{ $isHome ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('home.product') }}">All Categories</a>
            @foreach ($categories as $category)
                @php
                    $isActive = Request::url() == route('product.filter', $category);
                @endphp
                <a class="btn {{ $isActive ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('product.filter', $category) }}">{{ $category->name }}</a>
            @endforeach
        @endif
    </div>

    <div class="container" style="margin-top: 10px;">
        <div class="d-flex justify-content-around align-items-center flex-wrap gap-4 my-1">
            @foreach ($toys as $toy)
                <div class="card mx-auto my-5" style="width: 18rem;">
                    <div class="card-body d-flex flex-row">
                        <img src="{{ asset('img/profile.jpg') }}" class="rounded-circle me-3" height="50px" width="50px"
                            alt="avatar" />
                        <div>
                            <h5 class="card-title font-weight-bold mb-2">{{ $toy->name }}</h5>
                            <span class="badge text-bg-primary">{{ $toy->category->name }}</span>
                        </div>
                    </div>
                    <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                        <img class="img-fluid"
                            src="{{ $toy->image ? asset('img/toyImage/' . $toy->image) : 'https://picsum.photos/366/300' }}" height="300px" width="366px"
                            alt="toy's image" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-link link-danger p-md-1 my-1" data-mdb-toggle="collapse"
                                href="{{route('product.detail', $toy)}}" role="button" aria-expanded="false"
                                aria-controls="collapseContent">Detail</a>
                            <div>
                                @if ($toy->stock > 0)
                                    <a href="{{route('toys.order', $toy)}}" class="btn btn-outline-success">Add to Cart</a>
                                @else
                                    <button class="btn btn-outline-danger">Out of Stock</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $toys->links() }}
    </div>



@endsection
