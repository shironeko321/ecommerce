@extends('layouts.dashboard')

@section('main')
    <!-- ======= Header ======= -->
    @include('templates.dashboard.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('templates.dashboard.sidebar')

    <main id="main" class="main">
        <div class="pagetitle row">
            <div class="col-auto me-auto">
                <h1>Product</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </nav>
            </div>
            <div class="col-auto align-self-center">
                <a href="{{ route('product.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card info-card">

                <div class="card-body my-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>*</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collection as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{ route('product.edit', ['product' => $item->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('product.destroy', ['product' => $item->id]) }}"  style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
    </main>
@endsection
