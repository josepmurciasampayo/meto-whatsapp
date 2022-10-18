<x-app-layout>
    <x-notes-counselor :notes="$notes"></x-notes-counselor>
    <h2 class="my-2">Student Data - {{ $data[0]['name'] }}</h2>
    <?php foreach ($data as $row) { ?>
        <div class="py-3">
            <!-- question ID: <?php echo $row['question_id'] ?> -->
            <x-label value="{{ $row['question'] }}" />
            <p><?php echo $row['answer'] ?></p>
        </div>
    <?php } ?>
</x-app-layout>
