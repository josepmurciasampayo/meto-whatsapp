<x-app-layout>
    <h3 class="my-2">Student Data - {{ $data[0]['name'] }}</h3>
    <x-label for="notes" value="Notes" />
    <textarea class="form-control" id="notes" name="notes" row="4">{{ $notes }}</textarea>
    <hr>
    <?php foreach ($data as $row) { ?>
    <div class="py-3">
        <x-label value="{{ $row['question'] }}" />
        <p>{{ $row['answer'] }}</p>
    </div>
    <?php } ?>
</x-app-layout>
