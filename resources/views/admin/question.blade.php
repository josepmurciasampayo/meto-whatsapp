<x-app-layout>
    <?php $formats = \App\Enums\QuestionFormat::descriptions() ?>
    <?php $categories = \App\Enums\Student\QuestionType::descriptions() ?>
    <?php $active = \App\Enums\QuestionStatus::descriptions() ?>
    <?php $active[""] = ''; ?>
    <?php $yes = \App\Enums\General\YesNo::descriptions() ?>
    <?php $yes[""] = ''; ?>
    <?php $curricula = \App\Enums\Student\Curriculum::descriptions() ?>

    <h3 class="display-7 flex justify-center">Editing Question</h3>

    <div class="flex justify-center mt-6 mb-6">
        <x-button-nav href="{{ route('questions') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-50">Back to questions <i class="fas fa-question-circle"></i></x-button-nav>
    </div>

    <form method="POST" action="{{ route('question.store') }}">
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        @csrf
        <x-input-text saved="{{ $question->text }}" label="Text" name="text"></x-input-text>
        <x-select label="Format" :options="$formats" name="format" saved="{{ $question->format }}"></x-select>
        <x-select label="Category" :options="$categories" name="category" saved="{{ $question->type }}"></x-select>
        <x-radio label="Required" :options="$yes" name="required" saved="{{ $yes[$question->required] }}"></x-radio>
        <x-radio label="Active" :options="$active" name="active" saved="{{ $active[$question->status] }}"></x-radio>
        <x-input-text label="Help Text" name="help" saved="{{ $question->help }}"></x-input-text>

        @if ($question->type == \App\Enums\Student\QuestionType::ACADEMIC())
            <div class="row fw-bold border-bottom mb-4">
                <div class="col text-center">Curriculum</div>
                <div class="col text-center">In Use</div>
                <div class="col text-center">Branching</div>
                <div class="col text-center">Screen</div>
                <div class="col text-center">Order</div>
            </div>
            @foreach ($curricula as $id => $curriculum)
                <div class="row my-3 d-flex align-items-center">
                    <div class="col text-end">
                        <p>{{ $curriculum }}</p>
                    </div>
                    <div class="col text-center">
                        @php $checked = ($question->$id == \App\Enums\General\YesNo::YES()) ? "checked" : "" @endphp
                        <input type="checkbox" name="inUse[{{$id}}]" {{ $checked }}>
                    </div>
                    <div class="col text-center">
                        @php $checked = (isset($screens[$id]) && $screens[$id]['branch'] == \App\Enums\General\YesNo::YES()) ? "checked" : "" @endphp
                        <input type="checkbox" name="hasBranch[{{$id}}]" {{ $checked }}>
                    </div>
                    <div class="col">
                        @php $value = isset($screens[$id]['screen']) ? $screens[$id]['screen'] : null; @endphp
                        <input style="width:75px" name="screen[{{ $id }}]" value="{{ $value }}" type="number">
                    </div>
                    <div class="col">
                        @php $value = isset($screens[$id]['order']) ? $screens[$id]['order'] : null; @endphp
                        <input style="width:75px" name="order[{{ $id }}]" value="{{ $value }}" type="number">
                    </div>
                </div>
            @endforeach
        @else
            <x-input-text label="Order" name="order" saved="{{ $question->order }}"></x-input-text>
        @endif

        @if ($question->hasResponses())
            <input type="hidden" name="toDelete" id="toDelete" value="0">
            <script type="text/javascript">
                function deleteResponse(id) {
                    document.getElementById('toDelete').value = id;
                    document.forms[0].submit();
                }
            </script>
            <div class="display-7">Responses <i class="fas fa-check-square"></i></div>
            <div class="row">
                <div class="col">
                    <x-input-text label="Add # blank responses" name="responses"></x-input-text>
                </div>
                <div class="col">
                    <x-button class="my-4 p-4">Add</x-button>
                </div>
            </div>
            <div class="row">
                <div class="col col-lg-2"></div>
                <div class="col text-center">Response Text</div>
                @if ($question->type == \App\Enums\Student\QuestionType::ACADEMIC())
                    <div class="col-lg-4 text-center">Destination Screen</div>
                @endif
            </div>
            @foreach ($responses as $response)
                <div class="row my-4">
                    <div class="col col-lg-2 mt-1">
                        <x-button onclick="deleteResponse({{ $response->id }})">
                            <span class="mr-2">
                                <i class="fas fa-trash"></i>
                            </span>
                            Delete
                        </x-button>
                    </div>
                    <div class="col">
                        <x-input label="" name="response[{{ $response->id }}]" saved="{{ $response->text }}"></x-input>
                    </div>
                    @if ($question->type == \App\Enums\Student\QuestionType::ACADEMIC())
                        <div class="col-lg-4">
                            @foreach ($curricula as $id => $curriculum)
                                @if (isset($screens[$id]) && $screens[$id]['branch'] == \App\Enums\General\YesNo::YES())
                                    @php $value = (isset($branches[$response->id][$id])) ? $branches[$response->id][$id] : null; @endphp
                                    <input
                                        style="width:100px"
                                        type="number"
                                        id="{{ $curriculum }}"
                                        name="responseBranch[{{$response->id}}][{{ $id }}]"
                                        value="{{ $value }}"
                                    >
                                    <label for="{{ $curriculum }}">{{ $curriculum }}</label><br/>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
        <div class="text-end">
            <x-button>Update <i class="fas fa-pencil-alt"></i></x-button>
        </div>
    </form>
</x-app-layout>
