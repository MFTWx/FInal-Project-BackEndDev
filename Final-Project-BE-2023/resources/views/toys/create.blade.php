@extends('partial.base')

@section('title', 'Create Toy')

@section('script')
    {{-- CDN for holder js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.8/holder.min.js"></script>
    <script>
        const imageInput = document.getElementById('imageInput');
        const previewImage = document.getElementById('previewImage');

        imageInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

@section('content')
    <form action="{{ route('toys.creation') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row" style="min-height: 100vh">
            <div class="col-4 d-flex justify-content-center align-items-center flex-column border-1 border-end border-dark">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload your toy image!</label>
                    <img id="previewImage" src="holder.js/300x200?text=Image">
                    <input id="imageInput" class="form-control" type="file" name="image">
                </div>
            </div>
            <div class="col-8 d-flex justify-content-center align-items-start flex-column ps-5">
                <h3 class="mb-3">Create a New Toy</h3>
                <div class="w-75">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="toy's name"
                            name="name">
                        <label for="floatingInput">Name</label>
                    </div>
                    <div class=" mb-3">
                        <select class="form-select" aria-label="Default select example" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="toy's description" id="floatingTextarea2" style="height: 100px"
                            name="description"></textarea>
                        <label for="floatingTextarea2">Description</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="toy's price"
                            name="price">
                        <label for="floatingInput">Price</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="toy's stock"
                            name="stock">
                        <label for="floatingInput">Stock</label>
                    </div>
                    <div class="form-floating mb-3">
                        <button class="btn btn-outline-success">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
