<form id="notes" name="notes" action="{{ route('saveNotes') }}" method="POST">
    @csrf
    <x-label for="notes" value="Notes" />
    <textarea class="form-control" id="notes" name="notes" rows="4">{{ $notes }}</textarea>
    <div class="text-end p-3">
        <x-button>Update Notes</x-button>
    </div>
</form>
