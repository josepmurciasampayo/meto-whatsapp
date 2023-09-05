let buttons = document.querySelectorAll('.refresh-btn' )

setInterval(() => buttons.forEach(btn => btn.type !== 'button' ? btn.type = 'button' : null), 500)

Livewire.on('refreshRecords', () => {
    Livewire.emit('refreshOtherComponents')
})

let unstripeTables = () => {
    document.querySelectorAll('table.table-striped').forEach(table => {
        table.classList.remove('table-striped')

        let head = table.querySelector('tbody tr')
        !head.hasAttribute('wire:key')
            ? head.classList.add('bg-gray')
            : null
    })
}

unstripeTables()
setInterval(() => unstripeTables(), 500)

let card = document.querySelector('#student-details-card-holder')

let labels = document.querySelectorAll('#students-tables label')

let selectOption = (label, action = null) => {
    action = action || label.getAttribute('target').toLowerCase()
    // Unselect all the labels first
    unselectAllOptions(label)
    // Select the new label
    label.setAttribute('selected_option', true)
    label.classList.add(action)
    // Select the action's radio input
    document.querySelector("input[type='radio'][value='" + action + "'][name='student_" + label.getAttribute('key') + "']").checked = true
    // Handle the unselect event for this button
    label.removeAttribute('onclick')

    // Store the option on the selected options list
    let selected = JSON.parse(localStorage.getItem('selected_options')) ?? []
    if (selected.filter(key => ((key !== (key + ':connect')) || (key !== (key + ':maybe')) || (key !== (key + ':archive')))).length === 0) {
        selected.push({ [label.getAttribute('key')]: label.getAttribute('target') })
        localStorage.setItem('selected_options', JSON.stringify(selected))
    } else {
        selected = selected.filter(key => Object.keys(key)[0] !== label.getAttribute('key'))
        selected.push({ [label.getAttribute('key')]: label.getAttribute('target') })
        localStorage.setItem('selected_options', JSON.stringify(selected))
    }

    if (label.classList.contains(action)) {
        setTimeout(() => {
            label.addEventListener('click', () => {
                if (label.hasAttribute('selected_option') && ((label.classList.contains('connect') || label.classList.contains('maybe') || label.classList.contains('archive')))) {
                    label.removeAttribute('selected_option')
                    let puts = document.querySelectorAll('input[name="student_' + label.getAttribute('key') + '"]')

                    puts.forEach(input => {
                        setTimeout(() => input.checked = false, 200)
                    })
                    label.parentElement.querySelector('input').checked = false

                    // Remove the option from the selected options list
                    let selected = JSON.parse(localStorage.getItem('selected_options')) ?? []
                    selected = selected.filter(key => Object.keys(key)[0] !== label.getAttribute('key'))
                    localStorage.setItem('selected_options', JSON.stringify(selected))
                }
                label.setAttribute('onclick', 'selectOption(this)')
            }, { once: true })
        }, 500)
    }
}

let unselectAllOptions = label => {
    let key = label.getAttribute('key')
    // Uncolor all the labels
    document.querySelectorAll("label[key='" + key + "']").forEach(label => {
        label.hasAttribute('selected_option') ? label.removeAttribute('selected_option') : null
    })
    // Unselect all the radio inputs
    document.querySelectorAll('input[type="radio"][name="student_' + key + '"]').forEach(radio => radio.checked = false)
}

let showStudentCard = el => {
    let studentId = el.getAttribute('data-student-id')
    card.style.display = 'none'
    axios.get('/uni-student-fetch/' + studentId)
        .then(res => {
            let data = res.data;
            let student = data.data.student;

            card.style.display = 'block'
            card.classList.remove('d-none');
            card.innerHTML = data.view

            card.scrollIntoView();

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

let closeStudentCard = () => {
    card.style.display = 'none'
}

let selectSavedOptions = (unselect = false) => {
    if (localStorage.getItem('selected_options')) {
        JSON.parse(localStorage.getItem('selected_options')).forEach(option => {
            let el = document.querySelector('[key="' + Object.keys(option)[0] + '"][target="' + Object.values(option)[0] + '"]')
            if (el) {
                if (unselect) {
                    el.click()
                } else {
                    if (el && !el.getAttribute('selected_option')) {
                        el.click()
                    }
                }
            }
        })
    }
}

setInterval(() => {
    selectSavedOptions()

    let btn = document.querySelector('.reset-saved-options-btn')

    btn.type = 'button'

    btn.setAttribute('onclick', 'resetSavedOptions()')
}, 500)


setInterval(() => {
    if (el = document.querySelectorAll('[placeholder="Min"]')[1]) {
        el.placeholder !== 'Max' ? el.placeholder = 'Max' : null
    }
}, 50)

// Handle saving the filters for the first tab
setTimeout(() => {
    // Handle the multiselect filters
    let selected_curriculum_filters = (storage = localStorage.getItem('selected_curriculum_filters')) ? JSON.parse(storage) : JSON.parse("[]")
    if (selected_curriculum_filters.length > 0 && (filters = document.querySelector('#tomselect-1').parentElement.querySelectorAll('.ts-wrapper .ts-control [data-value]')).length !== (selected_curriculum_filters.length)) {
        output = []
        if (select = document.querySelector('.ts-control')) select.click()
        setTimeout(() => {
            selected_curriculum_filters.forEach(filter => {
                document.querySelector('[data-selectable][data-value="' + filter + '"]').click()
            })

            document.querySelector('tr td').click()
        }, 500)
    }

    // Handle the changes of the curriculum filter
    setInterval(() => {
        if ((selected = document.querySelector('#tomselect-1').parentElement.querySelectorAll('.ts-wrapper .ts-control [data-value]')).length !== selected_curriculum_filters.length) {
            let output = []
            selected.forEach(el => output.push(el.getAttribute('data-value')))
            localStorage.setItem('selected_curriculum_filters', JSON.stringify(output))
        }
    }, 1000)
}, 1000)

// Handle saving the filters for the second tab (Yes) (High school and high school country)
setTimeout(() => {
    // High school filter
    // Handle the multiselect high school filters
    let selected_high_school_filters = (storage = localStorage.getItem('selected_high_school_filters')) ? JSON.parse(storage) : JSON.parse("[]")
    if (selected_high_school_filters.length > 0 && (filters = document.querySelector('#tomselect-2').parentElement.querySelectorAll('.ts-wrapper .ts-control [data-value]')).length !== (selected_high_school_filters.length)) {
        output = []
        if (select = document.querySelectorAll('.ts-control')[1]) select.click()
        setTimeout(() => {
            selected_high_school_filters.forEach(filter => {
                document.querySelector('#tomselect-2-ts-dropdown [data-selectable][data-value="' + filter + '"]').click()
            })

            document.querySelector('tr td').click()
        }, 500)
    }

    // Handle the changes of the high school filter
    setInterval(() => {
        if ((selected = document.querySelector('#tomselect-2').parentElement.querySelectorAll('.ts-wrapper .ts-control [data-value]')).length !== selected_high_school_filters.length) {
            let output = []
            selected.forEach(el => output.push(el.getAttribute('data-value')))
            localStorage.setItem('selected_high_school_filters', JSON.stringify(output))
        }
    }, 1000)


    // High school country
    // Handle the multiselect high school filters
    // let selected_high_school_country_filters = (storage = localStorage.getItem('selected_high_school_country_filters')) ? JSON.parse(storage) : JSON.parse("[]")
    // if (selected_high_school_country_filters.length > 0 && (filters = document.querySelector('#tomselect-3').parentElement.querySelectorAll('.ts-wrapper .ts-control [data-value]')).length !== (selected_high_school_country_filters.length)) {
    //     output = []
    //     if (select = document.querySelectorAll('.ts-control')[2]) select.click()
    //     setTimeout(() => {
    //         selected_high_school_country_filters.forEach(filter => {
    //             document.querySelector('#tomselect-3-ts-dropdown [data-selectable][data-value="' + filter + '"]').click()
    //         })
    //
    //         document.querySelector('tr td').click()
    //     }, 500)
    // }

    // Handle the changes of the high school filter
    /*
    setInterval(() => {
        if ((selected = document.querySelector('#tomselect-3').parentElement.querySelectorAll('.ts-wrapper .ts-control [data-value]')).length !== selected_high_school_country_filters.length) {
            let output = []
            selected.forEach(el => output.push(el.getAttribute('data-value')))
            localStorage.setItem('selected_high_school_country_filters', JSON.stringify(output))
        }
    }, 1000)
    */

}, 1500)

let resetSavedOptions = () => {
    selectSavedOptions(true)

    localStorage.setItem('selected_options', JSON.stringify([]))

    localStorage.setItem('selected_curriculum_filters', JSON.stringify([]))

    window.location.reload()
}
