@props(['notes' => ''])

<?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
<form id="notes" name="notes" action="{{ route('saveNotes') }}" method="POST" class="mt-6 bg-gray-100 shadow-md rounded-lg p-6">
    @csrf
    <div class="mb-3 text-center">
        <label for="notes" class="mb-1 text-center text-gray-800 block display-7">Take Notes <i class="fas fa-pencil"></i></label>
        <label for="notes" class="mb-1 text-gray-600 text-center block text-lg">Your notes are private and will follow you around on other pages if you update before leaving each page.</label>
        <div class="mx-auto w-full lg:w-3/4 xl:w-1/2">
            <textarea class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focusring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" id="notes" name="notes" rows="4">{{ $notes }}</textarea>
        </div>
    </div>
    
    <div class="text-end p-3">
        <x-button><i class="fas fa-sync"></i> Update Notes</x-button>
    </div>
</form>
<?php } ?>
