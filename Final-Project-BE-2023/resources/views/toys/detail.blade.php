@extends('partial.base')

@section('title', 'Detail Page')

@section('script')
    
@endsection

@section('content')

    <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{route('home.product')}}">
        Back to Product Page
    </a>
    
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ $toy->image ? asset('img/toyImage/' . $toy->image) : 'https://picsum.photos/700/600' }}" height="700px" width="600px" alt="toy's image" /></div>
                <div class="col-md-6">
                    <div class="small mb-1">SKU: TYS-{{$toy->id}}</div>
                    <h1 class="display-5 fw-bolder">{{$toy->name}}</h1>
                    <div class="fs-5 mb-5">
                        <span>Rp {{number_format($toy->price)}}</span><br>
                        <span class="badge text-bg-primary">{{ $toy->category->name }}</span>
                    </div>
                    <p class="lead">{{$toy->description}}</p><br>
                    <p class="lead">Stock Available : {{ $toy->stock }}</p>
                    <div class="d-flex">
                        @if ($toy->stock > 0)
                            <a href="{{route('toys.order', $toy)}}" class="btn btn-outline-success">Add to Cart</a>
                        @else
                            <button class="btn btn-outline-danger">Out of Stock</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container" style="margin-top: 10px;">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="d-flex justify-content-around align-items-center flex-wrap gap-4 my-1">
            @foreach ($toys->where('category_id', $toy->category_id)->take(4) as $toy_product)
                <div class="card mx-auto my-5" style="width: 18rem;">
                    <div class="card-body d-flex flex-row">
                        <img src="{{ asset('img/profile.jpg') }}" class="rounded-circle me-3" height="50px" width="50px"
                            alt="avatar" />
                        <div>
                            <h5 class="card-title font-weight-bold mb-2">{{ $toy_product->name }}</h5>
                            <span class="badge text-bg-primary">{{ $toy_product->category->name }}</span>
                        </div>
                    </div>
                    <div class="bg-image hover-overlay ripple rounded-0" data-mdb-ripple-color="light">
                        <img class="img-fluid"
                            src="{{ $toy_product->image ? asset('img/toyImage/' . $toy_product->image) : 'https://picsum.photos/366/300' }}" height="300px" width="366px"
                            alt="toy's image" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-link link-danger p-md-1 my-1" data-mdb-toggle="collapse"
                                href="{{route('product.detail', $toy_product)}}" role="button" aria-expanded="false"
                                aria-controls="collapseContent">Detail</a>
                            <div>
                                @if ($toy_product->stock > 0)
                                    <a href="{{route('toys.order', $toy_product)}}" class="btn btn-outline-success">Add to Cart</a>
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

@endsection
