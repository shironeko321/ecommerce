@extends('layouts.dashboard')

@section('main')


  <main id="main" class="main">
    <div class="pagetitle row">
      <div class="col-auto me-auto">
        <h1>Ubah Product</h1>
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
          <form method="POST" action="{{ route('product.update', ['product' => $product->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Media</h5>
                <!-- Media -->
                <div class="row">
                  <div class="col-sm-12 {{ $errors->has('media') ? 'has-error' : '' }}">
                    <div class="needsclick dropzone" id="media-dropzone">
                    </div>
                    @if ($errors->has('media'))
                      <em class="invalid-feedback">
                        {{ $errors->first('media') }}
                      </em>
                    @endif
                  </div>
                </div>
                <div class="row py-2">
                  @foreach ($product->media as $item)
                    <div class="col-md-2">
                      <div class="card">
                        <img src="{{ asset('storage/images/' . $item->file_name) }}"
                          class="rounded card-img-top" height="150" style="object-fit: contain">
                        <div class="card-body pb-2">
                          <div class="d-flex justify-content-center pt-2 gap-2">
                            <input type="button" value="Hapus"
                              class="btn btn-danger btn-sm delete-image" id="{{ $item->id }}">
                            <input type="button" value="Detail" class="btn btn-primary btn-sm"
                              data-bs-toggle="modal"
                              data-bs-target="#detail-image-{{ $item->id }}">
                            @include('dashboard.product.imageEdit')
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
              <!-- End Media -->
            </div>

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Product</h5>

                <!-- Multi Columns Form -->
                <div class="row g-3">
                  <div class="col-md-12">
                    <label for="name" class="form-label">Judul Produk</label>
                    <input type="text" class="form-control" id="name" name="name"
                      placeholder="Judul Produk" value="{{ $product->name }}">
                  </div>
                  <div class="col-6">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-select">
                      @foreach ($category as $item)
                        <option value="{{ $item->id }}"
                          {{ $item->id == $product->category_id ? 'selected' : '' }}>
                          {{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" name="price"
                      placeholder="Harga Produk" value="{{ $product->price }}">
                  </div>
                  <div class="col-md-2">
                    <label for="quantity" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="quantity" name="quantity"
                      placeholder="Stok Produk" value="{{ $product->quantity }}">
                  </div>
                  <div class="col-12">
                    <label for="myeditorinstance" class="form-label">Detail</label>
                    <textarea class="tinymce-editor" id="myeditorinstance" name="details" aria-hidden="true">{!! $product->details !!}</textarea>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('product.index') }}" class="btn btn-danger">Batal</a>
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
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
    type="text/css" />
@endpush

@push('js')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>

  <script>
    let deleteImage = document.getElementsByClassName('delete-image');
    deleteImage.forEach(element => {
      element.addEventListener('click', function(e) {
        console.log(e.target.id)
        let id = e.target.id;
        let url = "{{ route('product.edit.media', ':product') }}";
        url = url.replace(':product', id);
        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'json',
          success: function(res) {
            console.log(res)
            let hapus = document.getElementById(e.target.id).value;
            if (e.target.id && hapus === "Hapus") {
              document.getElementById(e.target.id).classList.add('btn-success');
              document.getElementById(e.target.id).classList.remove('btn-danger');
              document.getElementById(e.target.id).value = "Pulihkan";
              $('form').append('<input type="hidden" name="delete[]" value="' + res
                .file_name + '">')
            } else {
              document.getElementById(e.target.id).classList.add('btn-danger');
              document.getElementById(e.target.id).classList.remove('btn-success');
              document.getElementById(e.target.id).value = "Hapus";
              $('form').find('input[name="delete[]"][value="' + res.file_name + '"]')
                .remove()
            }
          }
        })
      })
    });
  </script>

  <script>
    var uploadMediaMap = {}
    Dropzone.options.mediaDropzone = {
      url: "{{ route('product.storeMedia') }}",
      maxFiles: 5,
      maxFilesize: 2,
      acceptedFiles: ".jpeg,.jpg,.png",
      addRemoveLinks: true,
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      success: function(file, response) {
        $('form').append('<input type="hidden" name="media[]" value="' + response.name + '">')
        uploadMediaMap[file.name] = response.name
      },
      removedfile: function(file) {
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
          name = file.file_name
        } else {
          name = uploadMediaMap[file.name]
        }
        $('form').append('<input type="hidden" name="delete[]" value="' + name + '">')
        $('form').find('input[name="media[]"][value="' + name + '"]').remove()
      },
      // init: function() {
      //     @if (isset($product) && $product->media)
      //         var files =
      //             {!! json_encode($product->media) !!}
      //         for (var i in files) {
      //             var file = files[i]
      //             this.options.addedfile.call(this, file)
      //             file.previewElement.classList.add('dz-complete');
      //             console.log(file);
      //             file.previewElement.firstElementChild.firstElementChild.src = '/storage/images/' + file.file_name;
      //             $('form').append('<input type="hidden" name="media[]" value="' + file.file_name + '">')
      //         }
      //     @endif
      // }
    }
  </script>

  <script>
    function formatRupiah(angka, prefix) {
      let number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');

    }

    let rupiah = document.getElementById('harga');
    rupiah.addEventListener('keyup', function(e) {
      rupiah.value = formatRupiah(this.value);
    })
  </script>
@endpush
