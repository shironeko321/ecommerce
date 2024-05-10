@php
  if (!isset($active)) {
      $active = '';
  }
@endphp

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    {{-- .collapsed sama dengan tidak active --}}
    <li class="nav-item">
      <a @class([
          'nav-link',
          'collapsed' => Route::currentRouteName() !== 'dashboard',
      ]) href="{{ route('dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a @class(['nav-link', 'collapsed' => $active !== 'users']) href="{{ route('dashboard') }}">
        <i class="bi bi-people"></i>
        <span>Users</span>
      </a>
    </li>

  </ul>

</aside>
