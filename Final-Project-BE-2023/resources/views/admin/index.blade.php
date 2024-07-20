@extends('partial/base')

@section('title', 'Admin Home')

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endsection

@section('content')
    <div class="d-flex justify-content-crnter align-items-start flex-column gap-4">
        <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="{{route('toys.create')}}">
            + Add Toy
        </a>

        <div class="d-flex justify-content-center align-items-center gap-4">
            @if (Request::routeIs('admin.search'))
                <a class="btn btn-outline-primary" href="{{ route('admin.home') }}">All Products</a>
            @else
                @php
                    $isHome = Request::routeIs('admin.home');
                @endphp
                <a class="btn {{ $isHome ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('admin.home') }}">All Categories</a>
                @foreach ($categories as $category)
                    @php
                        $isActive = Request::url() == route('admin.filter', $category);
                    @endphp
                    <a class="btn {{ $isActive ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ route('admin.filter', $category) }}">{{ $category->name }}</a>
                @endforeach
            @endif
        </div>

        <div class="w-100 d-flex justify-content-center align-items-center flex-column gap-4" style="min-height: 15vh">
            <h3 class="fw-semibold">List of Toys</h3>
            <form action="{{ route('admin.search') }}" class="d-flex justify-content-center align-items-center gap-4">
                @csrf
                <input type="text" class="form-control" placeholder="Search for a toy ..." name="keyword"
                    value="{{ $search ?? '' }}">
                <button class="btn btn-outline-primary">Search</button>
            </form>
            <table class="table table-hover table-bordered text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $num = 1; ?>
                    @foreach ($toys as $toy)
                        <tr class= "table-light" style="vertical-align: middle">
                            <th scope="row">{{ $num++ }}</th>
                            <td>
                                <img style="width: 150px; height: 150px display:block;" src="{{ $toy->image ? asset('img/toyImage/' . $toy->image) : 'https://picsum.photos/150' }}" alt="toy-image">
                            </td>
                            <td>
                                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="#">
                                    {{ $toy->name }}
                                </a>
                            </td>
                            <td>{{ $toy->category->name }}</td>
                            <td>{{ $toy->description }}</td>
                            <td>Rp {{ number_format($toy->price) }}</td>
                            <td>{{ $toy->stock }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-4">
                                    <a class="btn btn-outline-success" href="{{route('toys.edit', $toy)}}">
                                        <i class="bi bi-pen"></i>
                                    </a>
                                    @include('toys.delete')
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
