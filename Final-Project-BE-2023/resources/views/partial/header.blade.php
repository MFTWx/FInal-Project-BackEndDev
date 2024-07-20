<nav class="navbar navbar-expand-lg navbar-dark p-3 bg-primary sticky-top" id="headerNav">
    <div class="container-fluid">
      <a class="navbar-brand d-block d-lg-none" href="#">
        <img src="" height="80" alt="logo" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto ">
          <li class="nav-item">
            <a class="nav-link mx-2 active" aria-current="page" href="{{route('home')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 active" href="{{route('home.product')}}">Products</a>
          </li>
          <li class="nav-item d-none d-lg-block">
            @auth
              @if (Auth::user()->role == 'admin')
                <a class="nav-link mx-2 active" href="{{route('admin.home')}}">
                  <img src="{{asset('img/logo.png')}}" height="25" />
                </a>
              @elseif (Auth::user()->role == 'user')
                <a class="nav-link mx-2 active" href="{{route('home')}}">
                  <img src="{{asset('img/logo.png')}}" height="25" />
                </a>
            @endauth
              @else
                <a class="nav-link mx-2 active" href="{{route('home')}}">
                  <img src="{{asset('img/logo.png')}}" height="25" />
                </a>
              @endif
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 active" href="{{route('cart.home')}}">Cart</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link mx-2 dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Account
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                @auth
                <li><a class="dropdown-item" href="{{route('user.account')}}">Information</a></li>
                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <li><a class="dropdown-item" href="{{route('register')}}">Register</a></li>
                    <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>
                @endauth
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
