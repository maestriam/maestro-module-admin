<div class="empty-state">
    <div class="empty-state-icon {{ $color ?? '' }}">
        <i class="fas {{ $icon ?? 'fa-question' }}"></i>
    </div>
    <h2>{{ $title ?? __('admin::empty-state.title') }}</h2>
    <p class="lead">{{ $description ?? __('admin::empty-state.description') }}</p> 
</div>