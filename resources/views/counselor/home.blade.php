<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Welcome, <?php echo Auth::user()->first ?>. You are a Counselor.
                </div>
                <div class="p-6">
                    <ul>
                        <li><a href="/chats">Review all students</a></li>
                        <li><a href="">Review matches</a></li>
                        <li><a href="">Review school profile</a></li>
                        <li><a href="">Review your profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
