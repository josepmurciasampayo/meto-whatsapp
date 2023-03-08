<div style="display: flex; justify-content: center; gap: 16px;">
  <x-button id="back-btn"><i class="fas fa-chevron-left"></i> Back</x-button>
  <x-button id="next-btn">Next <i class="fas fa-chevron-right"></i></x-button>
</div>


<script>
document.getElementById("back-btn").addEventListener("click", function(){
  window.history.back();
});
</script>




  