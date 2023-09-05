<x-app-layout>
    @php
        $formats = \App\Enums\QuestionFormat::descriptions();
        $categories = \App\Enums\Student\QuestionType::descriptions();
        $active = \App\Enums\QuestionStatus::descriptions();
        $yes = \App\Enums\General\YesNo::descriptions();
        $curricula = \App\Enums\Student\Curriculum::descriptions();
    @endphp

    <h1 class="display-6 mt-5 text-center">Editing Question</h1>

    @if (!App::environment('prod'))
        <div class="text-center w-50">
            <p class="bg-info p-3">
                Please make changes at <a href="https://app.meto-intl.org">https://app.meto-intl.org</a>
            </p>
        </div>
    @endif

    <div class="text-center mt-6 mb-6">
        <x-button-nav href="{{ route('questions.index') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-50">
            Back to questions <i class="fas fa-question-circle"></i>
        </x-button-nav>
    </div>

    <div class="w-75 lg:w-3/4 xl:max-w-md mt-6 px-6 py-4 bg-success bg-opacity-25 overflow-hidden sm:rounded-lg">
        <form method="POST" action="{{ route('questions.store') }}">
            <input type="hidden" name="question_id" value="{!! $question->id !!}">
            @csrf
            <div class="mb-4 border border-secondary bg-light rounded-md p-2">
                <x-inputs.text saved="{{ $question->text }}" label="Text" name="text"></x-inputs.text>
            </div>

            <script type="text/javascript">
                function showResponse(el) {
                    const showResponses = {{ json_encode(\App\Enums\QuestionFormat::hasResponses()) }};
                    if (showResponses.includes(el.value)) {
                        document.getElementById('showResponses').classList.remove('d-none');
                    } else {
                        document.getElementById('showResponses').classList.add('d-none');
                    }
                }
            </script>

            <div class="my-4 border border-secondary bg-light rounded-md p-2">
                <x-inputs.select onchange="" label="Format" :options="$formats" name="format" saved="{{ $question->format }}"></x-inputs.select>
            </div>

            @php $showResponses = ($question->hasResponses()) ? '' : 'd-none'; @endphp
            <div id="showResponses" class="border border-secondary p-4 bg-light {{ $showResponses }}">
                <p class="mb-3">Responses</p>
                <input type="hidden" name="toDelete" id="toDelete" value="0">
                <script type="text/javascript">
                    function deleteResponse(id) {
                        document.getElementById('toDelete').value = id;
                        document.forms[0].submit();
                    }
                </script>
                <div class="row">
                    <div class="col">
                        <x-inputs.text label="Add # blank responses" name="responses"></x-inputs.text>
                    </div>
                    <div class="col">
                        <x-inputs.textarea label="Paste a list of responses" name="responsesList"/>
                        <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600" name="deleteResponses">
                        Delete existing responses
                    </div>
                </div>
                <div class="my-3 text-end">
                    <x-button class="submit-form-btn">Add Responses</x-button>
                </div>

                {{-- each response gets a row in the table --}}
                @foreach ($responses as $key => $response)
                    <div class="row my-1">
                        <div class="col col-lg-2">
                            <x-button onclick="deleteResponse({{ $response->id }})">
                            <span class="mr-2">
                                <i class="fas fa-trash"></i>
                            </span>
                                Delete
                            </x-button>
                        </div>
                        <div class="col-8">
                            <input class="block w-full border border-gray-400 rounded-md h-10 px-3" name="response[{{ $response->id }}]" id="response[{{ $response->id }}]" value="{{ $response->text }}" />
                        </div>
                        <div class="col-2">
                            <input class="block w-full border border-gray-400 rounded-md h-10 px-3 response-order" type="number" name="orders[{{ $response->id }}]" id="orders[{{ $response->id }}]" placeholder="Order" value="{{ $response->order }}" @if($response->order > 0) min="{{ 0 }}" @endif max="{{ count($responses) }}" />
                        </div>
                    </div>
                @endforeach
            </div>

            <script type="text/javascript">
                function initialCurriculum() {
                    if (document.getElementById('category').value == {{ \App\Enums\Student\QuestionType::ACADEMIC() }}) {
                        document.getElementById('initialCurriculum').classList.remove('d-none');
                        document.getElementById('orderQuestion').classList.add('d-none');
                    } else {
                        document.getElementById('initialCurriculum').classList.add('d-none');
                        document.getElementById('orderQuestion').classList.remove('d-none');
                    }
                }
            </script>

            <div class="my-4 border border-secondary bg-light rounded-md p-2">
                <x-inputs.select onchange="initialCurriculum()" label="Category" :options="$categories" name="category" saved="{{ $question->type }}"></x-inputs.select>
            </div>

            @php ($displayCurriculum = $question->type == \App\Enums\Student\QuestionType::ACADEMIC()) ? "" : "d-none"; @endphp
            <div class={{ $displayCurriculum }} id="initialCurriculum">
                <div class="my-4 border border-secondary bg-light rounded-md p-2">
                    <x-inputs.select name="addCurricula" :options="$curricula" label="Initial Curriculum"></x-inputs.select>
                </div>
            </div>

            @if ($question->type == \App\Enums\Student\QuestionType::ACADEMIC())
                @if (count($question->academic) > 0)
                    <div class="border border-secondary p-4 bg-light">
                        <div class="row fw-bold mb-4">
                            <div class="col text-center">Curriculum</div>
                            <div class="col text-center">Branching</div>
                            <div class="col text-center">Screen</div>
                            <div class="col text-center">Order</div>
                            @if ($question->academic[0]->branch == \App\Enums\General\YesNo::NO())
                                <div class="col text-center">Destination Screen</div>
                            @endif
                        </div>

                        @foreach ($question->academic as $academic)
                            <input type="hidden" name="join[{{ $academic->curriculum->id }}]" value="{{ $academic->id }}">

                            <div class="row my-3 d-flex align-items-center">
                                <div class="col text-center">
                                    <p>{!! $academic->curriculum->name !!}</p>
                                </div>
                                <div class="col text-center">
                                    @php $checked = ( $academic->branch == \App\Enums\General\YesNo::YES()) ? "checked" : "" @endphp
                                    <input type="checkbox" name="hasBranch[{{ $academic->id }}]" {{ $checked }}>
                                </div>
                                <div class="col text-center">
                                    <input style="width:75px" name="screen[{{ $academic->id }}]" value="{!! $academic->screen !!}" type="number">
                                </div>
                                <div class="col text-center">
                                    <input style="width:75px" name="order[{{ $academic->id }}]" value="{!! $academic->order !!}" type="number">
                                </div>
                                @if ($academic->branch == \App\Enums\General\YesNo::NO())
                                    <div class="col text-center">
                                        <input style="width:75px" name="destination[{{ $academic->id }}]" value="{!! $academic->destination_screen !!}" type="number">
                                    </div>
                                @endif
                            </div>

                            @if ($academic->branch == \App\Enums\General\YesNo::YES())
                                <hr class="mt-4">

                                <div class="display-8 text-center my-3">Branching</div>
                                <div class="row mb-2">
                                    <div class="col text-center fw-bold">Response Text</div>
                                    <div class="col text-center fw-bold">Destination Screen</div>
                                </div>

                                @foreach ($responses as $response)
                                    <div class="row">
                                        <div class="col text-center">{{ $response->text }}</div>
                                        <div class="col text-center">
                                            <input required style="width:75px" name="branchDestinations[{{ $response->id  }}]" value="{{ $response->branch?->to_screen }}" type="number">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                @endif

            @else
                <div id="orderQuestion" class="my-4 border border-secondary bg-light rounded-md p-2">
                    <x-inputs.text label="Order" name="order" saved="{!! $question->order !!}"></x-inputs.text>
                </div>
            @endif

            <div class="my-4 border border-secondary bg-light rounded-md p-2">
                <x-inputs.radio label="Required" :options="$yes" name="required" saved="{!! $question->required !!}"></x-inputs.radio>
            </div>

            <div class="my-4 border border-secondary bg-light rounded-md p-2">
                <x-inputs.radio label="Equivalency" :options="$yes" name="equivalency" saved="{!! $question->equivalency !!}"></x-inputs.radio>
            </div>

            <div class="my-4 border border-secondary bg-light rounded-md p-2">
                <x-inputs.radio label="Active" :options="$active" name="active" saved="{{ $question->status }}"></x-inputs.radio>
            </div>

            @if ($question->format == \App\Enums\QuestionFormat::NUMBER())
                <div id="input-validation" class="my-4 border border-secondary bg-light rounded-md p-2">
                    <x-inputs.radio label="Numeric Validation" :options="$yes" name="has_validation" saved="{{ $question->has_validation }}"></x-inputs.radio>

                    <div id="min-and-max-holder" class="{{ $question->has_validation !== \App\Enums\General\YesNo::YES() ? 'd-none' : '' }} mt-4">
                        <x-inputs.text label="Min" name="min" saved="{{ $question->min }}"></x-inputs.text>
                        <br />
                        <x-inputs.text label="Max" name="max" saved="{{ $question->max }}"></x-inputs.text>
                    </div>
                </div>
            @endif

            <div class="my-4 border border-secondary bg-light rounded-md p-2">
                <x-inputs.text label="Help Text" name="help" saved="{{ $question->help }}"></x-inputs.text>
            </div>

            <div class="my-4 border border-secondary bg-light rounded-md p-2">
                <x-inputs.textarea label="Notes" name="notes" saved="{!! $question->notes !!}"></x-inputs.textarea>
            </div>

            <div class="text-center mt-2">
                <x-button class="submit-form-btn">Update Question</x-button>
            </div>
        </form>
    </div>

    @push('js')
        <script>
            // Show the validation input only when the input format is Number
            let format = document.querySelector('#format')
            let validationInputHolder = document.querySelector('#input-validation')
            let minAndMaxHolder = document.querySelector('#min-and-max-holder')

            format.addEventListener('change', () => {
                if (format.value === '13') {
                    validationInputHolder.classList.remove('d-none')
                } else {
                    validationInputHolder.classList.add('d-none')
                }
            })


            let radios = document.querySelectorAll('[name="has_validation"]')
            radios.forEach(radio => {
                radio.addEventListener('change', () => {
                    let choice = Object.values(radios).filter(radio => radio.checked === true)[0]

                    if (parseInt(choice.value) === 1) {
                        // Show the min and max inputs
                        minAndMaxHolder.classList.remove('d-none')
                    } else {
                        // Hide the min and max inputs
                        minAndMaxHolder.classList.add('d-none')
                    }
                })
            })

            let enableButtons = buttons => {
                buttons.forEach(btn => btn.setAttribute('disabled', true))
            }

            let disableButtons = buttons => {
                buttons.forEach(btn => btn.removeAttribute('disabled'))
            }

            let watchForOrderInputs = () => {
                let orderInputs = Object.values(document.querySelectorAll('.response-order'))
                let filledOrders = orderInputs.filter(el => el.value !== '')
                let submitButtons = document.querySelectorAll('.submit-form-btn')

                if (filledOrders.length > 0) {
                    orderInputs.filter(el => el.value === '').forEach(el => el.classList.add('form-control', 'border-danger', 'is-invalid'))
                    enableButtons(submitButtons)
                }

                if (filledOrders.length === orderInputs.length) {
                    disableButtons(submitButtons)
                }

                filledOrders.forEach(el => el.classList.remove('form-control', 'border-danger', 'is-invalid'))
            }

            setInterval(() => watchForOrderInputs(), 100)
        </script>
    @endpush
</x-app-layout>
