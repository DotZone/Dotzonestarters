{{-- Begin::Dashboard --}}
<div class="menu-item side-menus">
    <a class="menu-link menu-text-wrap {{ Route::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        <span class="menu-icon">
            <i class="fas fa-chart-pie"></i>
        </span>
        <span class="menu-title">{{ __('messages.dashboard.dashboard') }}</span>
    </a>
</div>
{{-- End::Dashboard --}}