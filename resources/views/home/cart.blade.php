@extends('layouts.index')

@section('main')
  <div class="container mx-auto p-8 mt-24 rounded-lg bg-base-300">
    @foreach ($cart as $item)
      <div class="card card-side bg-base-100 shadow-xl">
        <figure><img src="{{ asset('storage/images/' . $item->product->media[0]->file_name) }}"
            alt="Movie" class="h-44" /></figure>
        <div class="card-body">
          <h2 class="card-title">{{ $item->product->name }}</h2>
          <p>{{ Number::currency($item->product->price, 'IDR') }}</p>
          <div class="card-actions justify-end">
            <button class="btn btn-primary">Buy</button>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
