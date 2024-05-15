@extends('layouts.index')

@section('main')
  @include('templates.home.header')

  <div class="container my-3 d-flex flex-column gap-5">
    {{-- carousel --}}
    <div id="carouselExampleIndicators" class="carousel slide overflow-hidden" style="height: 60vh"
      data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
          class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img
            src="https://imgs.search.brave.com/lNgkiHuMh_tE4g938YnBQhgTVWhewEVG_9IN8arVk5c/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMuY3RmYXNzZXRz/Lm5ldC9ocmx0eDEy/cGw4aHEvNE4xTmVv/SFRhVDhuSTB4N3Ax/akNHay81YTYwNTRh/NTA0NmI3NzQ5YTZi/NzhhZDNjYTFlYjU3/Zi93YXRlci1zcGxh/c2gtY2xyLXNodXR0/ZXJzdG9ja18yNTg0/MjE4MDUuanBnP2Zp/dD1maWxsJnc9NDgw/Jmg9Mjcw"
            class="d-block w-100 h-50 rounded-3" alt="...">
        </div>
        <div class="carousel-item">
          <img
            src="https://imgs.search.brave.com/jYJenORZ1vlj73g6bbNTraWjAF0iMRCR9mtFLuRWJF8/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9idXJz/dC5zaG9waWZ5Y2Ru/LmNvbS9waG90b3Mv/aWNlLWNyYWNrcy1v/bi1hLWZyb3plbi1z/ZWEuanBnP3dpZHRo/PTEwMDAmZm9ybWF0/PXBqcGcmZXhpZj0w/JmlwdGM9MA"
            class="d-block w-100 h-50 rounded-3" alt="...">
        </div>
        <div class="carousel-item">
          <img
            src="https://imgs.search.brave.com/gm3qlBqmzxSDXuSC7jNfLyoL0RykP_gNLg5tedJGYgc/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMuY3RmYXNzZXRz/Lm5ldC9ocmx0eDEy/cGw4aHEvMlN3UDBa/NDZVRTRVMlljNE1n/YWEydy80ZTVjMzQ0/OTI4MzhjNDI1ZWUz/MzY0YTdlZjliOGMw/NS9qcGctcG5nLXBk/Zi5qcGc_Zml0PWZp/bGwmdz00ODAmaD0y/NzA"
            class="d-block w-100 h-50 rounded-3" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    {{-- main content --}}
    <div class="row gx-5">
      {{-- product --}}
      <div class="col col-lg-9">

        {{-- recomendation --}}
        <div class="row">
          <div class="card">
            <h5 class="card-header border-0 bg-transparent mt-3">Recomendation</h5>
            <div class="card-body overflow-auto">
              <div class="d-inline-flex gap-3 overflow-auto">
                @for ($i = 0; $i < 5; $i++)
                  <div class="card" style="width: 18rem;">
                    <div style="height: 180px" class="overflow-hidden">
                      <img
                        src="https://imgs.search.brave.com/lERXzUNAQFf47JKa7W7NeAztkxH927TESYThL16fVAs/rs:fit:860:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvY29tbW9ucy8x/LzE3L1RlaF9DX1Bl/bmcuanBn"
                        class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make
                        up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
                @endfor
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- category or someting --}}
      <div class="d-none d-lg-block col-3">
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title">
              Category
            </h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">An item</li>
              <li class="list-group-item">A second item</li>
              <li class="list-group-item">A third item</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
