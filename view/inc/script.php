

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


 document.getElementById('sidebarToggle').click();


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

/*


$('.dataTables_scrollBody').on('click', function() {
  
  alert('here');

     $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .fixedColumns().relayout();

         } );


//      $('#registerOrUpdateReportEpiFilasModal').modal('show');

  /*
  $('.table-responsive-disabled').keydown(function (e) {
    console.log('keyCode');
    

});

*/



/*var oTable = $('#dataTable').dataTable();


oTable.columns.adjust().draw();


window
  .addEventListener("keydown", function(event) {
        
        if (event.keyCode == 37 || event.keyCode == 39 ) {

//oTable.columns.adjust().draw();
//    oTable.fnAdjustColumnSizing();

/*
   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust().relayout();

        }
});
*/

/*

$(document).ready(function() {

    var table = $('#dataTable').DataTable();

 $('.buttons-colvisGroup').on('click', function () {

    var table = $('#dataTable').DataTable();

  var timer;

$('.search-column').on('keyup', function () {
console.log(this);
  window.clearTimeout(timer);
  timer = window.setTimeout(() => {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();
  }, 1000);


        });
  window.clearTimeout(timer);

});
*/




$(document).ready(async function() {


/*
  var  search_column = $('.search-column');


  $('.buttons-colvisGroup').on('click', function () {

  var  search_column = $('.search-column');
    var table = $('#dataTable').DataTable();

  console.log(search_column);
 });

*/




$(document).on('keyup', '.search-column', function(){

    var table = $('#dataTable').DataTable();

  var timer;

console.log(this);

  window.clearTimeout(timer);

  timer = window.setTimeout(() => {
            table.column($(this).parent().index()+' :visible')
                .search(this.value)
                .draw();
  }, 1000);


//  window.clearTimeout(timer);

        });

});

</script>

