@props(['page' => false, 'screen' => false, 'answers' => []])

<div style="display: flex; justify-content: center; gap: 16px;">
    <script type="text/javascript">
        function goBack() {
            document.getElementById('direction').value = -1;
            document.forms[0].submit();
        }
        function goHome() {
            document.getElementById('direction').value = -3;
            document.forms[0].submit();
        }
    </script>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                @if ($page && $page() == \App\Enums\Page::ACADEMIC())
                    @if ($screen && $screen == 1)
                        <a href="{{ route('student.highschool') }}"><x-button type="button" id="back-btn"><i class="fas fa-chevron-left "></i> Back</x-button></a>
                    @else
                        <x-button type="button" onclick="history.back()" id="back-btn"><i class="fas fa-chevron-left "></i> Back</x-button>
                    @endif
                @elseif ($page && $page() != \App\Enums\Page::DEMO())
                    <x-button type="button" onclick="goBack()" id="back-btn"><i class="fas fa-chevron-left"></i> Back</x-button>
                @endif
            </div>
            <div class="col">
                <x-button id="next-btn">Next <i class="fas fa-chevron-right"></i></x-button>
            </div>
        </div>

        @if (count($answers) > 0)
            <div class="row mt-3">
                <div class="col text-center">
                    <x-button type="button" onclick="goHome()" id="save">Save and Return Home <i class="fas fa-home"></i></x-button>
                </div>
            </div>
        @endif
    </div>
</div>
