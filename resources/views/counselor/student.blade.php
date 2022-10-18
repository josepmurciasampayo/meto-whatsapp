<x-app-layout>
    <x-notes-counselor :notes="$notes"></x-notes-counselor>
    <h3 class="my-2">Student Data - {{ $data[0]['name'] }}</h3>
    <?php foreach ($data as $row) { ?>
        <div class="py-3">
            <!-- question ID: <?php echo $row['question_id'] ?> -->
            <x-label value="<?php echo $row['question'] ?>" />
            <p><?php echo $row['answer'] ?></p>
        </div>
    <?php } ?>

</x-app-layout>
