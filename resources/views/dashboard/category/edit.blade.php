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
                <h1>Category</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="card info-card">

                <div class="card-body my-2">
                    <h5 class="card-title">Edit</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session()->has('msg'))
                        <div class="alert alert-success">
                            <span>{{ session()->get('msg') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('category.edit', ['category' => $item->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $item->name }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Edit</button>
                    </form>
                </div>

            </div>
        </section>
    </main>
@endsection
