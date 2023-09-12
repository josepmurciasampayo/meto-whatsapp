<x-app-layout>
    @section('title')
        Review new connections
    @endsection
    
    <div class="pt-5 pb-3">
        <div class="alert alert-danger d-none mb-5" id="errorHolder">
            Something went wrong.
        </div>
        <livewire:admin.review-new-connections-table />
    </div>

    <script>
        let deletedConnections = 1

        let approveConnection = (btn) => {
            let connectionId = btn.getAttribute('connection_id')
            // Send the request
            disableButton(btn)
            axios.post('/connections/' + connectionId + '/approve')
                .then(res => {
                    document.querySelector('[connection_id="' + connectionId + '"]').parentElement.parentElement.parentElement.parentElement.remove()
                    deletedConnections += 1
                }).catch(err => {
                    document.querySelector('#errorHolder').classList.remove('d-none')
                }).finally(() => enableButton(btn))

            reloadIfThereIsNoConnection()
        }

        let denyConnection = (btn) => {
            let connectionId = btn.getAttribute('connection_id')
            // Send the request
            disableButton(btn)
            axios.post('/connections/' + connectionId + '/deny')
                .then(res => {
                    document.querySelector('[connection_id="' + connectionId + '"]').parentElement.parentElement.parentElement.parentElement.remove()
                    deletedConnections += 1
                }).catch(err => {
                document.querySelector('#errorHolder').classList.remove('d-none')
            }).finally(() => enableButton(btn))

            reloadIfThereIsNoConnection()
        }

        let reloadIfThereIsNoConnection = () => deletedConnections === 25 ? window.location.reload() : null

        let disableButton = btn => {
            let buttons = document.querySelectorAll('[connection_id="' + btn.getAttribute('connection_id') + '"]')
            buttons.forEach(btn => {
                btn.setAttribute('disabled', true)
            })
        }

        let enableButton = btn => {
            let buttons = document.querySelectorAll('[connection_id="' + btn.getAttribute('connection_id') + '"]')
            buttons.forEach(btn => {
                btn.removeAttribute('disabled')
            })
        }

        // Get the Bulk Approve and Deny buttons and Deactivate single Approve/Deny buttons once one of them is clicked
        let actionsButtons = [document.querySelector('.bulk-approve-btn'), document.querySelector('.bulk-deny-btn')]
        actionsButtons.forEach(button => {
            button.addEventListener('click', () => {
                actionsButtons.forEach(button => button.setAttribute('disabled', true))

                let buttons = Object.values(document.querySelectorAll('.btn-success, .btn-danger'))
                // Disable the buttons, LivewirePowergrid will handle enabling them
                buttons.forEach(btn => btn.setAttribute('disabled', true))
            })
        })
    </script>
</x-app-layout>
