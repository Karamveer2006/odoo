<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
    $(function () {
    $('#menuToggle').on('click', function () {
      $('#mobileMenu').toggleClass('active');
      $('#menuOverlay').toggleClass('active');
    });

    $('#menuOverlay').on('click', function () {
      $('#mobileMenu').removeClass('active');
      $('#menuOverlay').removeClass('active');
    });
    $('#toggleTheme').on('click', function () {
      const current = $('body').attr('data-theme');
      $('body').attr('data-theme', current === 'dark' ? 'light' : 'dark');
    });
  });
  
</script>