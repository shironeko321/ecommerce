@extends('layouts.dashboard')

@push('style')
  {{-- tailwind css style --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush

@section('main')
  <!-- ======= Header ======= -->
  @include('templates.dashboard.header')
  <!-- End Header -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>{{ __('Profile') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">{{ __('Profile') }}</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
      <div class="card info-card">
        <div class="card-body">
          <h5 class="card-title">
            {{ __('Profile Information') }}
          </h5>
          @include('profile.partials.update-profile-information-form')
        </div>
      </div>
      <div class="card info-card">
        <div class="card-body">
          <h5 class="card-title">
            {{ __('Update Password') }}
          </h5>
          @include('profile.partials.update-password-form')
        </div>
      </div>
      <div class="card info-card">
        <div class="card-body">
          <h5 class="card-title">
            {{ __('Delete Account') }}
          </h5>
          @include('profile.partials.delete-user-form')
        </div>
      </div>
    </section>

  </main>

  <!-- ======= Sidebar ======= -->
  @include('templates.dashboard.sidebar')

  <!-- ======= Footer ======= -->
  @include('templates.dashboard.footer')
  <!-- End Footer -->
@endsection
