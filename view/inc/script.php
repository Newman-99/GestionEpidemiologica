

  <!-- Bootstrap core JavaScript-->
  
  <script src="<?php echo SERVERURL; ?>libraries/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  
  <script src="<?php echo SERVERURL; ?>libraries/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo SERVERURL; ?>view/js/sb-admin-2.min.js"></script>


  <!-- Page level plugins -->
  <script src="<?php echo SERVERURL; ?>libraries/chart.js/Chart.min.js"></script>




  <!-- Core plugin JavaScript-->

  <!--
<script src="<?php //echo SERVERURL; ?>libraries/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/DataTables-1.10.22/js/jquery.dataTables.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/DataTables-1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/AutoFill-2.3.5/js/dataTables.autoFill.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/AutoFill-2.3.5/js/autoFill.bootstrap4.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/Buttons-1.6.5/js/dataTables.buttons.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/Buttons-1.6.5/js/buttons.colVis.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/Buttons-1.6.5/js/buttons.flash.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/Buttons-1.6.5/js/buttons.html5.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/Buttons-1.6.5/js/buttons.print.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/KeyTable-2.5.3/js/dataTables.keyTable.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/Responsive-2.2.6/js/dataTables.responsive.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/Responsive-2.2.6/js/responsive.bootstrap4.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/RowGroup-1.1.2/js/dataTables.rowGroup.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/RowReorder-1.2.7/js/dataTables.rowReorder.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/Scroller-2.0.3/js/dataTables.scroller.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/SearchBuilder-1.0.0/js/dataTables.searchBuilder.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/SearchBuilder-1.0.0/js/searchBuilder.bootstrap4.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/SearchPanes-1.2.1/js/dataTables.searchPanes.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/SearchPanes-1.2.1/js/searchPanes.bootstrap4.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/Select-1.3.1/js/dataTables.select.min.js"></script>
<script src="<?php //echo SERVERURL; ?>libraries/datatables/fixedHeader/dataTables.fixedHeader.min.js"></script>

   Page level custom scripts
  <script src="<?php //echo SERVERURL; ?>view/js/demo/datatables-demo.js"></script>

  
-->

  <!-- Page level custom scripts -->
  <script src="<?php echo SERVERURL; ?>view/js/demo/chart-area-demo.js"></script>
  <script src="<?php echo SERVERURL; ?>view/js/demo/chart-pie-demo.js"></script>
  <script src="<?php echo SERVERURL; ?>view/js/demo/chart-bar-demo.js"></script>


<script src="<?php echo SERVERURL; ?>view/js/main.js" ></script>

  <!-- Logout script-->

<script src="<?php echo SERVERURL; ?>view/js/alerts.js" ></script>

  <script src="<?php echo SERVERURL; ?>view/js/scriptsSendAndRequestDataFromBakend.js"></script>

<script src="<?php echo SERVERURL; ?>view/js/logOut.js" ></script>


<script>
//$.material.init();
 


$(document).ready(function() {


// Script para evitar que el fixed header de las tablas se descuadre

 $('#accordionSidebar').on('click', function () {


   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .fixedColumns().relayout();
  });

 $('#sidebarToggleTop').on('click', function () {
   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .fixedColumns().relayout();
  });
 
} );



   $(window).on('resize', function () {
     
   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .fixedColumns().relayout();
  } );



    $('#dataTable')
        .on( 'draw.dt',  function () {
   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .fixedColumns().relayout();
         } ).DataTable();




$('div.table-responsive').on('scroll', function() {
//  alert('');
  
     $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .fixedColumns().relayout();

         } );


// Final Script evitar el fixed header de las tablas se descuadre



/*
$('table').keydown(function (e) {
        alert('alert');
    });
*/
/*
     $($.fn.dataTable.tables(true)).DataTable().on( 'key', function ( e, datatable, key, cell, originalEvent ) {
            alert( '<div>Key press: '+key+' for cell <i>'+cell.data()+'</i></div>' );
        } );

/*
$('#dataTable').keydown(function (key) {
    if (key.keyCode == 38) {
        window.scrollTo(document.body.scrollLeft,
                        document.body.scrollTop + 100);
    }
    if (key.keyCode == 40) {
        window.scrollTo(document.body.scrollLeft,
                        document.body.scrollTop + 100);
    }
});
/*
document.body.onkeyup = function(e) {
    var code = e.keyCode;
    if(code === 74) { // key code for j
        window.scrollTo(document.body.scrollLeft,
                        document.body.scrollTop + 100);
    }
};

/*
function arrow(dir) {
    var activeTableRow = $('.table tbody tr.active')[dir](".table tbody tr");
    if (activeTableRow.length) {
        $('.table tbody tr.active').removeClass("active");
        activeTableRow.addClass('active');
    }
};*/

/*

    $('#dataTable')
        .on( 'mouseenter', 'td', function () {
            var colIdx = table.cell(this).index().column;
 
            $( table.cells().nodes() ).removeClass( 'highlight' );
            $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
        } );


    var oTable = $('#dataTable').DataTable();

$("#dataTable tbody").click(function(event) {
$(oTable.fnSettings().aoData).each(function (){
$(this.nTr).removeClass('row_selected');
});
$(event.target.parentNode).addClass('row_selected');
});
*/

</script>

