<?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
<form id="notes" name="notes" action="{{ route('saveNotes') }}" method="POST">
    @csrf
    <x-label for="notes" value="Use this box to take notes. Your notes are private and no one else in your organization can see them." />
    <x-label for="notes" value="Your notes will also magically follow you around on other pages if you update before leaving each page." />
    <textarea class="form-control" id="notes" name="notes" rows="4">{{ $notes }}</textarea>
    <div class="text-end p-3">
        <x-button>Update Notes</x-button>
    </div>
</form>
<?php } ?>
