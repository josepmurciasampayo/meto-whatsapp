@props(['notes' => ''])
<?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
<form id="notes" name="notes" action="{{ route('saveNotes') }}" method="POST">
    @csrf
    <div class="alert alert-info" role="alert">
        <h5 class="alert-heading"></h5>
        <p class="text-center" class="lead" class="form-check-label" for="notes"><strong> Use this box to take notes. Your notes are private and no one else in your organization can see them.</strong>  </p>
        <hr>
        <p class="text-center" class="mb-0" ><i>Your notes will also magically follow you around on other pages if you update before leaving each page.</i></p>
      </div>
    <textarea class="form-control" id="notes" name="notes" rows="6">{{ $notes }}</textarea>
    <div class="text-end p-3">
        <x-button>Update Notes</x-button>
    </div>
</form>
<?php } ?>
