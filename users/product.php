<?php
include '../includes/config.php';
include 'header.php';
if($_GET['id']!=''){
  $id=$_GET['id'];
  $obj = new Product();
  $result =  $obj->getitem($id);
}
?>
<style>
  .danger{
    color: red;
  }
</style>

<div class="pcoded-main-container">
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
           <h5 class="m-b-10">Product </h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item"><a href="viewproduct.php">Products</a></li>
           <li class="breadcrumb-item">Add Product</li>
           
         </ul>
       </div>
     </div>
   </div>
 </div>
 <!-- [ breadcrumb ] end -->
 <!-- [ Main Content ] start -->
 <div class="row">
   <!-- [ form-element ] start -->
   <div class="col-sm-12">
    <div class="card">
   <!--   <div class="card-header">
      <h5>Basic Componant</h5>
    </div> -->
    <div class="card-body">
      <form onsubmit="return false;" id="customer_form">

        <div class="row">
         <div class="col-md-6">

          <div class="form-group">
           <label for="name">Product Name <span class="danger"> *</span></label>
           <input type="text" class="form-control enterAsTab" id="product_name" aria-describedby="nameHelp" placeholder="Enter Name"  value="<?php echo $result['name'] ?>" autocomplete="off" autofocus>
          </div>
         
      </div>
      <div class="col-md-6">

      </div>
 </div>

<div class="col-md-6 text-right">

 <button type="submit" class="btn btn-sm btn-success enterAsTab" id="submit">Submit</button>


 <?php

 if($_GET['id']!='')
 {
   echo'<a href="viewproduct.php"><button type="button" class="btn btn-sm btn-warning">Back</button></a>';
 }
 else
 {
   echo'<button type="reset" class="btn btn-sm btn-warning" id="reset">Reset</button>'; 
 }

 ?>

</div>

<div class="col-md-6 text-right"></div>

</form>
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

<?php
include 'footer.php';
?>
<script>
 $(document).ready(function(){
  $("#submit").click(function(){

    if($("#product_name").val()==''){
     $('#product_name').css("border","1px solid red");
     $('#product_name').focus();
     return false
   }
   else{
    $('#product_name').css("border","1px solid lightgray");
  }


var product_name=$("#product_name").val();
var id = "<?=$_GET['id']?>";

$.ajax({
  type:"POST",
  url:'ajaxCalls/add_products.php',
  dataType:"json",
  data:{'product_name':product_name,'id':id},
  success: function(res){
   if(res.status=='success')
   {

    if(id!='')
    {

      $.growl.notice({
       title:"SUCCESS",
       message:"Product Edited Successfully"
     });
      $("#customer_form").trigger('reset');
      window.location='viewproduct.php';
    }
    else
    {
     $("#name").val(" ");

     $.growl.notice({
       title:"SUCCESS",
       message:"Product Added Successfully"
     });
     $("#customer_form").trigger('reset');
       window.location='viewproduct.php';
    }


 }


}
});

});

});

</script>
<script>
 var selector = '.enterAsTab';
 $('body').on('keydown', selector, function(e) {
  if (e.key === "Enter") {
    var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
    focusable = form.find(selector).filter(':visible');
    next = focusable.eq(focusable.index(this)+1);
    if ($(e.target).closest("#submit").length>0){
      self.click();
    }
    if (next.length) {
      // console.log($next).attr('id');
      if ($(next).attr('id')=='submit') {
        $("#submit").click();
      }
      next.focus();
    }
    return false;
  }
});
</script>