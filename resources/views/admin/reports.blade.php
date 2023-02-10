<x-app-layout>
    <div class="p-6 bg-white border-b border-gray-200">
        <i class="fas fa-home"></i> Welcome, <?php echo Auth::user()->first ?>. You are an Administrator.
    </div>
    <div class="p-6" class="mb-16"> 
        <div>  
        <iframe width="100%" height="750" src="https://datastudio.google.com/embed/reporting/1ac8ccdd-a501-495d-9947-e14b9c75e715/page/iqd8C" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
</x-app-layout>
