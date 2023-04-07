<div style="display: flex; justify-content: center; gap: 16px;">
    <script type="text/javascript">
        function goBack() {
            document.getElementById('direction').value = -1;
            document.forms[0].submit();
        }
    </script>
  <x-button type="button" onclick="goBack()" id="back-btn"><i class="fas fa-chevron-left"></i> Back</x-button>
  <x-button id="next-btn">Next <i class="fas fa-chevron-right"></i></x-button>
</div>
