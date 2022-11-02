@props([
    'type' => 'type',
    'owner_id' => 'owner_id',
    'file_id' => 'file_id',
])
<input type="hidden" name="owner_id-{{ $file_id }}" id="owner_id-{{ $file_id }}" value="{{ $user_id }}">
<input type="hidden" name="type-{{ $file_id }}" id="type-{{ $file_id }}" value="{{ $type }}">
<input type="file" name="file-{{ $file_id }}" id="file-{{ $file_id }}">
