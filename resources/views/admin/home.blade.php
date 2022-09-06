<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Welcome, <?php echo Auth::user()->first ?>. You are an Administrator.
                </div>
                <div class="p-6">
                    <ul>
                        <li><a href="/campaigns">Review chat message language</a></li>
                        <li>Review WhatsApp student match survey data</li>
                        <li>Review all WhatsApp messaging</li>
                        <li>Review raw student data</li>
                        <li>Review all match data</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
