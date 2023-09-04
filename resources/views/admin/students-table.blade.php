<x-app-layout>
    <div class="my-5">
        <form id="filterForm" class="mb-1 pt-5" action="">
            <div class="row">
                <div class="col-md-5">
                    <label for="efc">EFC</label>
                    <input id="efc" name="efc" type="text" class="form-control" value="{{ request()->get('efc') }}">
                </div>
                <div class="col-md-5">
                    <label for="equivalency">Equivalency</label>
                    <input id="equivalency" name="equivalency" type="text" class="form-control" value="{{ request()->get('equivalency') }}">
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-green text-white w-100 py-2 mt-4">Submit</button>
                </div>
            </div>
        </form>

        <livewire:admin.students-table :efc="intval(request()->get('efc') ?? 0)" :equivalency="intval(request()->get('equivalency') ?? 0)" />
    </div>

    <script>
        let card = document.querySelector('#student-details-card-holder')

        let showStudentCard = el => {
            let studentId = el.getAttribute('data-student-id')
            card.style.display = 'none'
            axios.get('/uni-student-fetch/' + studentId)
                .then(res => {
                    let data = res.data;
                    let student = data.data.student;

                    card.style.display = 'block'
                    card.innerHTML = data.view

                    // card.querySelector('#name').textContent = student.user.first + ' ' + student.user.last
                    // card.querySelector('#age').textContent = student.age

                    // qas = card.querySelector('#qas')
                    // qas.innerHTML = ''
                    // data.qas.forEach(qa => {
                    //     qas.innerHTML += '<div class="p-3 col-md-6">' + '<div class="bg-light p-3 qa rounded mb-3">' +
                    //         '<p class="fw-bold small">#' + qa.question_id + ': ' +  qa.question.text + '</p>' +
                    //         '<p class="small">' + qa.text + '</p>' +
                    //         '</div>' + '</div>'
                    // })
                })
                .catch(err => console.log(err))
        }
    </script>
</x-app-layout>
