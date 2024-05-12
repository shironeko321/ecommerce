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
            <div class="col-auto align-self-center">
                <a href="{{ route('category.create') }}" class="btn btn-primary">Create</a>
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
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
    </main>
@endsection
