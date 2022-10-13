<x-app-layout>
    <div class="container bg-white">
        <div class="container py-5">
            <h3 class="my-2">Student Data - {{ $name }}</h3>
            <x-label for="notes" value="Notes" />
            <textarea class="form-control" id="notes" name="notes" row="4">{{ $notes }}</textarea>
            <hr>
            <?php foreach ($data as $row) { ?>
                <x-label value="{{ $row['question'] }}" />
                <p>{{ $row['answer'] }}</p>
            </div>
        </div>
</x-app-layout>
