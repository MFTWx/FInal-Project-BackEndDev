<form action="{{route('toys.delete', $toy)}}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-outline-danger">
        <i class="bi bi-trash"></i>
    </button>
</form>