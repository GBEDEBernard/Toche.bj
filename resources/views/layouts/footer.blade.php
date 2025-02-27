<!--begin::Footer-->
<footer class="main-footer">
    <div class="float-end d-none d-sm-inline">Anything you want</div>
    <strong>
        Copyright &copy; 2014-2024&nbsp;
        <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
    </strong>
    All rights reserved.
</footer>
<!--end::Footer-->

<!-- Scripts nécessaires -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="path_to_your_adminlte/dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function () {
      // Réactive les menus déroulants
      $('.nav-item.dropdown').on('click', function () {
          let dropdownMenu = $(this).find('.dropdown-menu');
          if (dropdownMenu.hasClass('show')) {
              dropdownMenu.removeClass('show');
          } else {
              $('.dropdown-menu').removeClass('show'); // Ferme les autres menus
              dropdownMenu.addClass('show');
          }
      });

      // Empêche le menu de se fermer en cliquant dedans
      $('.dropdown-menu').on('click', function (e) {
          e.stopPropagation();
      });

      // Gestion de la sidebar AdminLTE
      $('[data-widget="pushmenu"]').PushMenu('toggle');
  });
</script>
