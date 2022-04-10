@foreach ($permissions as $key => $perm)
    <div class="d-flex align-items-center py-2">
        <span class="bullet bg-primary me-3"></span>{{ $perm->implode('name',',') }} {{ $key }}
    </div>
@endforeach
