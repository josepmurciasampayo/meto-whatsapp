<x-app-layout>
    <?php $formats = \App\Enums\QuestionFormat::descriptions() ?>
    <?php $categories = \App\Enums\Student\QuestionType::descriptions() ?>
    <?php $active = \App\Enums\QuestionStatus::descriptions() ?>
    <?php $yes = \App\Enums\General\YesNo::descriptions() ?>
    <?php $curricula = \App\Enums\Student\Curriculum::descriptions() ?>

    <h1 class="display-6 mt-5 text-center">Editing Question</h1>

    @if (!App::environment('prod'))
        <div class="text-center w-50">
            <p class="bg-info p-3">
                Please make changes at <a href="https://app.meto-intl.org">https://app.meto-intl.org</a>
            </p>
        </div>
    @endif

    <div class="text-center mt-6 mb-6">
        <x-button-nav href="{{ route('questions') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-50">Back to questions <i class="fas fa-question-circle"></i></x-button-nav>
    </div>

    <div class="w-75 lg:w-3/4 xl:max-w-md mt-6 px-6 py-4 bg-success bg-opacity-25 overflow-hidden sm:rounded-lg">
    <form method="POST" action="{{ route('question.store') }}">
        <input type="hidden" name="question_id" value="{!! $question->id !!}">
        @csrf
        <div class="mb-4 border border-secondary bg-light rounded-md p-2">
            <x-inputs.text saved="{!! $question->text !!}" label="Text" name="text"></x-inputs.text>
        </div>

        <div class="my-4 border border-secondary bg-light rounded-md p-2">
            <x-inputs.select label="Format" :options="$formats" name="format" saved="{{ $question->format }}"></x-inputs.select>
        </div>

        <div class="my-4 border border-secondary bg-light rounded-md p-2">
            <x-inputs.select label="Category" :options="$categories" name="category" saved="{{ $question->type }}"></x-inputs.select>
        </div>

        <div class="my-4 border border-secondary bg-light rounded-md p-2">
            <x-inputs.radio label="Required" :options="$yes" name="required" saved="{!! $question->required !!}"></x-inputs.radio>
        </div>

        <div class="my-4 border border-secondary bg-light rounded-md p-2">
            <x-inputs.radio label="Equivalency" :options="$yes" name="equivalency" saved="{!! $question->equivalency !!}"></x-inputs.radio>
        </div>

        <div class="my-4 border border-secondary bg-light rounded-md p-2">
            <x-inputs.radio label="Active" :options="$active" name="active" saved="{{ $question->status }}"></x-inputs.radio>
        </div>

        <div class="my-4 border border-secondary bg-light rounded-md p-2">
            <x-inputs.text label="Help Text" name="help" saved="{!! $question->help !!}"></x-inputs.text>
        </div>


        @if ($question->type == \App\Enums\Student\QuestionType::ACADEMIC())
            <div class="row fw-bold border-bottom mb-4">
                <div class="col text-center">Curriculum</div>
                <div class="col text-center">In Use</div>
                <div class="col text-center">Branching</div>
                <div class="col text-center">Screen</div>
                <div class="col text-center">Order</div>
                @if (!in_array($question['type'], \App\Enums\QuestionFormat::hasResponses()))
                    <div class="col text-center">Destination Screen</div>
                @endif
            </div>
            @foreach ($curricula as $id => $curriculum)
                <div class="row my-3 d-flex align-items-center">
                    <div class="col text-end">
                        <p>{!! $curriculum !!}</p>
                    </div>
                    <div class="col text-center">
                        @php $checked = ($question->$id == \App\Enums\General\YesNo::YES()) ? "checked" : "" @endphp
                        <input type="checkbox" name="inUse[{{$id}}]" {{ $checked }}>
                    </div>
                    <div class="col text-center">
                        @php $checked = (isset($screens[$id]) && $screens[$id]['branch'] == \App\Enums\General\YesNo::YES()) ? "checked" : "" @endphp
                        <input type="checkbox" name="hasBranch[{{$id}}]" {{ $checked }}>
                    </div>
                    <div class="col text-center">
                        @php $value = isset($screens[$id]['screen']) ? $screens[$id]['screen'] : null; @endphp
                        <input style="width:75px" name="screen[{{ $id }}]" value="{!! $value !!}" type="number">
                    </div>
                    <div class="col text-center">
                        @php $value = isset($screens[$id]['order']) ? $screens[$id]['order'] : null; @endphp
                        <input style="width:75px" name="order[{{ $id }}]" value="{!! $value !!}" type="number">
                    </div>
                    @if (!in_array($question['type'], \App\Enums\QuestionFormat::hasResponses()))
                        <div class="col text-center">
                            <input style="width:75px" name="destination[{{ $id }}]" value="{!! $screens[$id]['destination_screen'] ?? null !!}" type="number">
                        </div>
                    @endif
                </div>
            @endforeach

        @else
            <x-inputs.text label="Order" name="order" saved="{!! $question->order !!}"></x-inputs.text>
        @endif

        <x-inputs.textarea label="Notes" name="notes" saved="{!! $question->notes !!}" />

        @if (in_array($question->format, \App\Enums\QuestionFormat::hasResponses()))
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
                    <x-inputs.text label="Add # blank responses" name="responses"></x-inputs.text>
                </div>
                <div class="col">
                    <x-inputs.textarea label="Paste a list of responses" name="responsesList" />
                    <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600" name="deleteResponses"> Delete existing responses
                </div>
            </div>
        <div class="row">
                    <x-button class="my-4 p-4">Add</x-button>
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
                        <x-input label="" name="response[{{ $response->id }}]" saved="{!! $response->text !!}"></x-input>
                    </div>
                    @if ($question->type == \App\Enums\Student\QuestionType::ACADEMIC())
                        <div class="col-lg-4">
                            @foreach ($curricula as $id => $curriculum)
                                @if (isset($screens[$id]) && $screens[$id]['branch'] == \App\Enums\General\YesNo::YES())
                                    @php $value = (isset($branches[$response->id][$id])) ? $branches[$response->id][$id] : null; @endphp
                                    <input style="width:100px" type="number" id="{!! $curriculum !!}" name="responseBranch[{{$response->id}}][{{ $id }}]" value="{!! $value !!}">
                                    <label for="{!! $curriculum !!}">{!! $curriculum !!}</label><br/>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        @elseif ($screens && isset($screens[$id]) && $screens[$id]['branch'] == \App\Enums\General\YesNo::YES())
            <x-input label="Destination Screen" name="dest_screen" saved=""></x-input>
        @endif

        <div class="text-center">
            <x-button>Update <i class="fas fa-pencil-alt"></i></x-button>
        </div>
    </form>
    </div>
</x-app-layout>
