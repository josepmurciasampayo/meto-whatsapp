<x-app-layout>
    <div class="p-6 bg-white border-b border-gray-200">
        <i class="fas fa-home"></i> Welcome, <?php echo Auth::user()->first ?>. You are an Administrator.
    </div>
    <div class="p-6" class="mb-16"> 
        <div>  
        <p class="h3" style="color:green">New High School or Access Program Request</p>  <br>    
        <iframe style="width: 40em; border: 1px solid" src="https://docs.google.com/forms/d/e/1FAIpQLSf0lH1aJamBv6lp5B4C2hFDRG9NmY-ctCxLT6BmHVx0e4MmmA/viewform?embedded=true" width="700" height="520" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
        </div> <br>
        <div>
        <p class="h3" style="color:green">Issue Log</p> <br>
        <iframe style="width: 40em; border: 1px solid" src="https://docs.google.com/forms/d/e/1FAIpQLSfwK_AaezRDLFmkNwsAU7v8Zx9u1DiEswOAcrsRJ-VGFy7CzQ/viewform?embedded=true" width="640" height="770" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
        </div>
</x-app-layout>
