<?php
include '../includes/config.php';
include 'header.php';
?>

<style type="text/css">
  
.form-control
{
  height: 31px;
}

select.custom-select {
    -webkit-appearance: menulist;
  }

</style>

<section class="pcoded-main-container">
 <div class="pcoded-wrapper">
  <div class="pcoded-content">
   <div class="pcoded-inner-content">
    <div class="main-body">
     <div class="page-wrapper">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
       <div class="page-block">
        <div class="row align-items-center">
         <div class="col-md-12">
          <div class="page-header-title">
           <h5 class="m-b-10">Products</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item">Products</li>
         </ul>
       </div>
     </div>
   </div>
 </div>
 <!-- [ breadcrumb ] end -->
 <!-- [ Main Content ] start -->
 <div class="row">                                

   <!-- [ dark-table ] end -->
   <!-- [ stiped-table ] start -->
   <div class="col-xl-12">
    <div class="card">
     <div class="card-header">

      <div class="row">
      <div class="col-md-10">
        
        <table>
                        <thead>
                            <tr>
                <th class="ts-pager">
                  <div class="form-inline">
                    <div class="btn-group" style="margin: 5px;" role="group">
                      <button type="button" class="btn first" title="first"><i class="fa fa-backward" aria-hidden="true"></i></button>
                      <button type="button" class="btn prev" title="previous"><i class="fa fa-caret-left fa-lg" aria-hidden="true"></i></button>
                    </div>
                    <span class="pagedisplay"></span>
                    <div class="btn-group"  style="margin: 5px;" role="group">
                      <button type="button" class="btn  next" title="next"><i class="fa fa-caret-right fa-lg" aria-hidden="true"></i></button>
                      <button type="button" class="btn  last" title="last"><i class="fa fa-forward" aria-hidden="true"></i></button>
                    </div>
                    <select class="form-control custom-select pagesize" style="padding: 0px 15px; height: 31px; margin: 5px;" title="Select page size">
                      <option selected="selected" value="10">10</option>
                      <option value="20">20</option>
                      <option value="30">30</option>
                      <!-- <option value="all">All Rows</option> -->
                    </select>
                    <select class="form-control custom-select px-4 pagenum" style="padding: 0px 15px; height: 31px; margin: 5px;" title="Select page number"></select>

                    <input type="text" class="form-control" placeholder="Search...." id="mySearch" style="width: 170px; margin: 5px;" onkeyup="getproduct(this)" />

                  </div>
                </th>
              </tr>
                        </thead>
                    </table>

      </div>

      <div class="col-md-2" style="float:right; margin-top: 5px;">

      <a class="btn btn-sm btn-info" href="product.php" style="margin-top: 10px; float: right;">+New</a>

      </div>

    </div>
      
      
    </div>
    <div class="card-body table-border-style">

      
      <div class="table-responsive">

        <table class="table table-hover">
          <thead>
           <tr>
            <th>S.No</th>
            <th>Name</th>

            <?php
            if($_SESSION['utype']=='Admin')
            {
            ?>
            <th class="filter-false">Action</th>
            <?php
            }
            ?>

          </tr>
        </thead>
        <tbody id="mytable">

        </tbody>
      </table>
    </div>

  </div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</section>

<?php

include 'footer.php';

?>

  <script>
    $(document).ready(function(){

      getproduct();

   });

 </script>

 <script id="js">

function getproduct()
{

  var search = $("#mySearch").val();

  $(function() {
       $.fn.columnCount = function() {
       return $('th', $(this).find('thead')).length;
       };
       var count=$('table').columnCount();

    $("table").tablesorter({
       theme : "bootstrap",

        widthFixed: true,

        headers: {
        4: { sorter: false, filter: false },
        7: { sorter: false, filter: false },
        10: { sorter: false, filter: false }
        },
        widgetOptions : {
            
            zebra : ["even", "odd"],

            
            filter_reset : ".reset",

            filter_cssFilter: [
                'form-control',
                'form-control',
                'form-control', // select needs custom class names :(
                'form-control',
                'form-control',
                'form-control',
                'form-control',
                'form-control',
                'form-control'
            ]

        }


    })
    .tablesorterPager({

        container: $(".ts-pager"),

        cssGoto  : ".pagenum",

        removeRows: false,

        ajaxUrl: "ajaxCalls/get_product_list_ajax.php?page={page}&size={size}&search="+search,
      customAjaxUrl: function(table, url) {

            $(table).trigger('changingUrl');

            return url += '&currentUrl=' + window.location.href;
          },
          ajaxProcessing: function(data){

              var total = data.count;

              $("#count_item").text(data.count).css('color','blue');
              $('#mytable').html(data.out);
              $("table").trigger('update');
              return [total];

          },

        output: '{startRow} to {endRow} of {filteredRows} ({totalRows})'

    });
    

});

}


</script>