<nav class="navbar navbar-lg sticky-top navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid py-3 px-5 row">
    <a class="navbar-brand col" href="#">E-commerce</a>

    {{--  search --}}
    <form class="d-flex w-75 col me-5" role="search">
      <input class="form-control" type="search" placeholder="Search" aria-label="Search"
        data-bs-theme="light">
    </form>

    {{-- account, cart, search --}}
    <ul class="navbar-nav col justify-content-end">
      @auth
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">
            <i class="bi bi-cart-dash"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
            aria-expanded="false">
            <i class="bi bi-person-circle"></i>
            <span>{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
              @csrf

              <button type="submit" class="btn">Log Out</button>
            </form>
        </li>
      </ul>
      </li>
    @else
      <li class="nav-item">
        <a href="{{ route('login') }}" class="btn btn-primary">Log
          in</a>
      </li>

      @if (Route::has('register'))
        <li class="nav-item">
          <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        </li>
      @endif
    @endauth
    </ul>
  </div>
</nav>
