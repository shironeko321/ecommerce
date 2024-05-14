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
            <a @class(['nav-link', 'collapsed' => !request()->routeIs('category.*')]) href="{{ route('category.index') }}">
                <i class="bi bi-tags"></i>
                <span>Category</span>
            </a>
        </li>

        <li class="nav-item">
            <a @class(['nav-link', 'collapsed' => !request()->routeIs('product.*')]) href="{{ route('product.index') }}">
                <i class="bi bi-bag"></i>
                <span>Product</span>
            </a>
        </li>

    </ul>

</aside>
