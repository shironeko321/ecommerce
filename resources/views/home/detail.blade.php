@extends('layouts.index')

@section('main')
  <div class="container mx-auto px-8 mt-32">
    <div class="container bg-base-200 rounded-box p-8 grid grid-cols-5 gap-3">
      <div class="col-span-2 flex flex-col gap-1 relative">
        <img src="{{ asset('storage/images/' . $product->media[0]->file_name) }}" alt="nothing"
          id="image" class="sticky top-0 left-0">
        @if (count($product->media) > 1)
          <div class="carousel carousel-center p-4 space-x-4 bg-neutral rounded-box">
            @foreach ($product->media as $media)
              <div class="carousel-item">
                <img src="{{ asset('storage/images/' . $media->file_name) }}" class="rounded-box" />
              </div>
            @endforeach
          </div>
        @endif
      </div>
      <div class="col-span-3 flex flex-col">
        <div class="card bg-base-100">
          <div class="card-body p-5">
            <div class="inline-flex justify-between items-center w-full">
              <h2 class="card-title text-2xl font-bold">{{ $product->name }}</h2>
              <span class="text-2xl font-bold">{{ Number::currency($product->price, 'IDR') }}</span>
            </div>
            <p class="text-xl mb-3">Category:
              <a href="{{ route('category', ['category' => $product->category->slug]) }}"
                class="underline decoration-2">{{ $product->category->name }}</a>
            </p>

            <div class="collapse collapse-arrow bg-base-200 rounded">
              <input type="checkbox" id="detail" />
              <label class="collapse-title text-xl font-medium pl-2" for="detail">
                Detail
              </label>
              <div class="collapse-content">
                {!! $product->details !!}
              </div>
            </div>

            <div class="card-actions items-center justify-end">
              <p class="text-xl">Stock: {{ $product->quantity }}</p>

              <form action="{{ route('cart.store', ['product' => $product->id]) }}" method="post">
                @csrf
                <input type="number" name="quantity" id="quantity" placeholder="quantity"
                  class="input input-bordered w-52" min="1" max="{{ $product->quantity }}"
                  required />
                <button type="submit" class="btn btn-primary text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                    <path
                      d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                  </svg>
                  <span>Cart</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
