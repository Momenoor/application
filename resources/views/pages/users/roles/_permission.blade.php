@php
$name = app(\App\Services\Permission::class)->getValueName($perm, true);
@endphp
<label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
    <input class="form-check-input" type="checkbox" value="{{ $perm->id }}" name="permissions[{{ $perm->name }}]"
        @if (in_array($perm->id, $selectedPerms??[])) checked="checked" @endif />
    <span class="form-check-label @if (\Str::lower($name) == 'delete') text-danger @endif">{{ $name }}</span>
</label>
