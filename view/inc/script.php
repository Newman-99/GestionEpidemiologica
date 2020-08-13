  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo SERVERURL; ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo SERVERURL; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo SERVERURL; ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo SERVERURL; ?>view/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo SERVERURL; ?>vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo SERVERURL; ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo SERVERURL; ?>view/js/demo/datatables-demo.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo SERVERURL; ?>vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo SERVERURL; ?>view/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo SERVERURL; ?>view/js/demo/chart-pie-demo.js"></script>
  <script src="<?php echo SERVERURL; ?>view/js/demo/chart-bar-demo.js"></script>


<script src="<?php echo SERVERURL; ?>view/js/main.js" ></script>

  <!-- Logout script-->

<script src="<?php echo SERVERURL; ?>view/js/alerts.js" ></script>

<script src="<?php echo SERVERURL; ?>view/js/logOut.js" ></script>

<script>
//$.material.init();
</script>


<script>
    $(document).ready( function () {
        $('#dataTable').DataTable({
          language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ Registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
          },    "bDestroy": true
        });
    } );
  </script>