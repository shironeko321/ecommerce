@extends('layouts.index')

@section('main')
  <div class="hero min-h-screen bg-base-200">
    <div class="hero-content text-center">
      <div class="max-w-md space-y-4">
        <h1 class="text-5xl font-bold">E-Commerce</h1>
        <form action="{{ route('search') }}" method="get">
          <label class="w-96 input input-bordered flex items-center gap-2">
            <input type="text" name="search" class="grow input border-none" placeholder="Search" />
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
              class="w-4 h-4 opacity-70">
              <path fill-rule="evenodd"
                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                clip-rule="evenodd" />
            </svg>
          </label>
        </form>
      </div>
    </div>
  </div>

  <div class="container mx-auto my-16 grid grid-cols-1 md:grid-cols-5 gap-3">
    <div class="md:col-span-4 container flex flex-col gap-3 p-3 bg-base-200">
      <span class="text-lg">Products</span>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($product as $item)
          @php
            $image = $item->media[0]->file_name;
          @endphp
          <a href="#" class="card w-full bg-base-300 shadow h-60">
            <figure><img src='{{ asset("storage/images/$image") }}'' alt="Shoes" />
            </figure>
            <div class="card-body card-compact">
              <h2 class="card-title">{{ $item->name }}</h2>
              <p>{{ Number::currency($item->price, 'IDR') }}</p>
            </div>
          </a>
        @endforeach
      </div>
    </div>
    <div class="flex flex-row md:flex-col md:col-span-1">
      <ul class="menu bg-base-200 w-56 rounded">
        <span class="text-lg">Category</span>
        @foreach ($category as $item)
          <li>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
@endsection
