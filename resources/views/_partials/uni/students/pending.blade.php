<form method="POST" action="{{ route('uni.connection.decide') }}">
    @csrf
    <div class="text-end mb-4">
        <button class="btn btn-success rounded mt-4">Submit</button>
    </div>

    <livewire:uni.student-table/>

    <div class="text-end my-4">
        <button class="btn btn-success rounded">Submit</button>
    </div>
</form>
