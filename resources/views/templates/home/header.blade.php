@php
  use App\Models\Cart;
  if (Auth::check()) {
      $user_id = Auth::user()->id;
      $cart_count = Cart::where('user_id', $user_id)->count();
  }
@endphp

<div class="navbar bg-base-300 fixed top-0 z-50">
  <div class="container mx-auto px-3">
    <div>
      <a class="btn btn-ghost text-xl" href="{{ route('home') }}">E-Commerce</a>
    </div>

    @if (!request()->routeIs('home'))
      <form action="{{ route('search') }}" method="get" class="mx-auto">
        <label class="w-96 input input-bordered flex items-center gap-2">
          <input type="text" name="search" class="grow input border-none" placeholder="Search"
            value="{{ request()->input('search') }}" />
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
            class="w-4 h-4 opacity-70">
            <path fill-rule="evenodd"
              d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
              clip-rule="evenodd" />
          </svg>
        </label>
      </form>
    @endif

    <div @class([
        'flex-none inline-flex items-center',
        'ml-auto' => request()->routeIs('home'),
    ])>
      @auth
        {{-- cart --}}
        <a href="{{ route('cart.index') }}" role="button" class="btn btn-ghost btn-circle">
          <div class="indicator">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            @if ($cart_count > 0)
              <span class="badge badge-sm indicator-item">{{ $cart_count }}</span>
            @endif
          </div>
        </a>
        {{-- profile --}}
        <div class="dropdown dropdown-end">
          <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar items-center">
            <div class="w-10 rounded-full">
              <img alt="Tailwind CSS Navbar component"
                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
            </div>
          </div>
          <ul tabindex="0"
            class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-200 rounded-box w-52">
            <li>
              <div class="flex flex-col">

                <div class="avatar placeholder">
                  <div class="bg-neutral text-neutral-content rounded-full w-24">
                    <span class="text-3xl">D</span>
                  </div>
                </div>
                <span class="pb-3">{{ Auth::user()->name }}</span>
              </div>
            </li>
            <li>
              <a href="{{ route('profile.edit') }}">
                Profile
              </a>
            </li>
            @role('admin')
              <li>
                <a href="{{ route('dashboard') }}">
                  Dashboard
                </a>
              </li>
            @endrole
            <li>
              <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                @csrf
                <button type="submit">Log Out</button>
              </form>
            </li>
          </ul>
        </div>
      @else
        {{-- login register --}}
        <ul class="menu menu-horizontal gap-3">
          <li><a href="{{ route('login') }}" class="btn btn-primary btn-sm">Log
              in</a></li>
          <li>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
          </li>
        </ul>
      @endauth
    </div>
  </div>
</div>
