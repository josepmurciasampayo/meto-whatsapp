@if(session()->has('response'))
    <div class="alert alert-success">
        <strong>
            {{ session()->get('response') }}
        </strong>
    </div>
@endif
