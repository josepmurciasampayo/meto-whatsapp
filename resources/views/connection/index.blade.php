<x-app-layout>
    <div class="pt-5 pb-3">
        <div class="alert alert-danger d-none mb-5" id="errorHolder">
            Something went wrong.
        </div>
        <livewire:admin.connections-table />
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

        let reloadIfThereIsNoConnection = () => deletedConnections === 10 ? window.location.reload() : null

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
    </script>
</x-app-layout>
