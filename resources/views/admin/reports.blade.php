<x-app-layout>
    <div class="p-6 bg-white border-b border-gray-200">
        <i class="fas fa-home"></i> Welcome, <?php echo Auth::user()->first ?>. You are an Administrator.
    </div>
    <div class="p-6" class="mb-16"> 
        <div>  
        <iframe width="890" height="600" src="https://lookerstudio.google.com/embed/reporting/0cc34c6f-e877-4242-983e-2665f38e35ad/page/rXzZD" frameborder="0" style="border:0" allowfullscreen></iframe>                </div>
        </div>
</x-app-layout>
