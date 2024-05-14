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
                <h1>Tambah Product</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </nav>
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
            </div>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Media</h5>
                            <!-- Media -->
                            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="dropzone" id="my-awesome-dropzone">

                                        </div>
                                        {{-- <input type="file" name="file[]" class="form-control" id="media"> --}}
                                    </div>
                                </div>
                                <!-- End Media -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Multi Columns Form</h5>

                            <!-- Multi Columns Form -->
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="inputName5">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail5" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail5">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword5" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="inputPassword5">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress5" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="inputAddres5s"
                                        placeholder="1234 Main St">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">Address 2</label>
                                    <input type="text" class="form-control" id="inputAddress2"
                                        placeholder="Apartment, studio, or floor">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">City</label>
                                    <input type="text" class="form-control" id="inputCity">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputState" class="form-label">State</label>
                                    <select id="inputState" class="form-select">
                                        <option selected="">Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="inputZip">
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            Check me out
                                        </label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div><!-- End Multi Columns Form -->

                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </section>
    </main>
@endsection

@push('style')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('js')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    var myDropzone = new Dropzone("#my-awesome-dropzone", {
    url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
    //paramName: "file", // The name that will be used to transfer the file
    maxFiles: 10,
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    acceptedFiles: ".jpeg,.jpg,.png"
});
</script>
@endpush
