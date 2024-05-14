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

                    <form action="{{ route('category.update', ['category' => $category->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $category->name }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cover" class="col-sm-2 col-form-label" accept=".jpg, .png, .jpeg">Cover</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="cover" id="cover">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Sub Category</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Sub Category" name="category_id">
                                    @if ($category->category_id != null)
                                    <option value="null" selected>Tidak Ada</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ ($item->id == $category->category_parent->id) ? 'selected' : '' }} >{{ $item->name }}</option>
                                    @endforeach
                                  @else
                                    <option value="null" selected>Tidak Ada</option>
                                @endif
                              </select>
                            </div>
                          </div>
                        <button type="submit" class="btn btn-primary float-end">Edit</button>
                    </form>
                </div>

            </div>
        </section>
    </main>
@endsection
