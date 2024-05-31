@extends('layouts.index')

@section('main')
  <div class="container mx-auto px-8 mt-32">
    <div class="grid grid-cols-4 gap-3">

      {{-- products --}}
      <div class="md:col-span-3 container rounded-md bg-base-200 p-8">
        <span class="text-lg mb-3">Products</span>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          @foreach ($product as $item)
            @php
              $image = $item->media[0]->file_name;
            @endphp
            <a href="{{ route('detail', ['product' => $item->slug]) }}"
              class="card w-full bg-base-300 shadow h-60">
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
      {{-- @dd($category) --}}

      {{-- relate category --}}
      <div class="hidden md:block md:col-span-1 md:rounded-md md:bg-base-200 md:p-8 md:pl-4">
        <span class="text-lg mb-3 md:pl-4">Category</span>
        <ul class="pl-0 menu">
          @foreach ($category as $item)
            @if (count($item->category_children) !== 0)
              <li>
                <details open>
                  <summary>
                    <a
                      href="{{ route('category', ['category' => $item->slug]) }}">{{ $item->name }}</a>
                  </summary>
                  <ul class="menu-dropdown menu-dropdown-show">
                    @foreach ($item->category_children as $child)
                      <li><a
                          href="{{ route('category', ['category' => $child->slug]) }}">{{ $child->name }}</a>
                      </li>
                    @endforeach
                  </ul>
                </details>
              </li>
            @elseif($item->category_id === null)
              <li><a
                  href="{{ route('category', ['category' => $item->slug]) }}">{{ $item->name }}</a>
              </li>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection
