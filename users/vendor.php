<?php
include '../includes/config.php';
include 'header.php';
if($_GET['id']!=''){
  $id=$_GET['id'];
  $obj = new Vendor();

  $result =  $obj->get_vendors($id);
}
$obj = new Vendor();
$get_countries=$obj->get_countries();
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
           <h5 class="m-b-10">Vendor </h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item"><a href="viewcustomer.php">Vendor</a></li>
           <li class="breadcrumb-item">Add Vendor</li>
           
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
      <form onsubmit="return false;" id="vendor_form">

        <div class="row">
         <div class="col-md-6">

          <div class="form-group">
           <label for="name">Name <span class="danger"> *</span></label>
           <input type="text" class="form-control enterAsTab" id="name" aria-describedby="nameHelp" placeholder="Enter Name"  value="<?php echo $result[0]['name'] ?>" autofocus>

         </div>
         <div class="form-group">
           <label for="exampleInputPassword1">Company Name <span class="danger"> *</span></label>
           <input type="text" class="form-control enterAsTab" id="company_name" placeholder="Enter Company Name" value="<?php echo $result[0]['company_name'] ?>">
         </div>
         <div class="form-group ">
           <label for="mobile">Mobile <span class="danger"> *</span></label>
           <input type="text" class="form-control enterAsTab" id="mobile" aria-describedby="mobileHelp" placeholder="Enter Mobile" value="<?php echo $result[0]['mobile'] ?>" >

         </div>
         

         <div class="form-group">
          <label for="email">Email <span class="danger"> *</span></label> 
          <input type="email" class="form-control enterAsTab" id="email" placeholder="Enter Email" value="<?php echo $result[0]['email'] ?>">
        </div>
      </div>
      <div class="col-md-6">

        <div class="form-group">
         <label for="country">Country</label>
         <select  type='text' name='country' id='country' class='form-control enterAsTab'  >
          <?php
          foreach ($get_countries as $value) {
            if ($value['name']=="India") {
             echo "<option value='".$value['id']."' data-id='".$value['phonecode']."' selected='selected'>" . $value["name"]."</option>";
           }
           else
           {                        
             echo "<option value='".$value['id']."' data-id='".$value['phonecode']."'>" . $value["name"]."</option>";
           }
         }
         ?>
       </select> 

     </div>
     <div class="form-group">
       <label for="state">State</label>
       <input type="text" class="form-control enterAsTab" id="state" aria-describedby="stateHelp" placeholder="Enter State" value="<?php echo $result[0]['state'] ?>">

     </div>
     <div class="form-group">
       <label for="city">City</label>
       <input type="text" class="form-control enterAsTab" id="city" aria-describedby="cityHelp" placeholder="Enter City" value="<?php echo $result[0]['city'] ?>">
     </div>

     <div class="form-group">
       <label for="address">Address</label>
       <textarea class="form-control enterAsTab" id="address" placeholder="Enter Address" aria-describedby="addressHelp" ><?php echo $result[0]['address'] ?></textarea>
     </div>






   </div>
 </div>

 
   <?php

   if($_GET['id']!='')
   {
   echo'<a href="viewvendor.php"><button type="button" class="btn btn-sm btn-warning float-right">Back</button></a>';
   }
   else
   {
   echo'<button type="reset" class="btn btn-sm btn-warning float-right" id="reset">Reset</button>'; 
   }

   ?>


 <button type="submit" class="btn btn-sm btn-success float-right enterAsTab" id="submit">Submit</button>


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
    if($("#name").val()==''){
     $('#name').css("border","1px solid red");
     $('#name').focus();
     return false
   }
   else{
    $('#name').css("border","1px solid lightgray");
  }
  if($("#company_name").val()==''){
   $('#company_name').css("border","1px solid red");
   $('#company_name').focus();
   return false
 }
 else{
  $('#company_name').css("border","1px solid lightgray");
}
if($("#mobile").val()==''){
 $('#mobile').css("border","1px solid red");
 $('#mobile').focus();
 return false
}
else{
  $('#mobile').css("border","1px solid lightgray");
} 
if($("#email").val()==''){
 $('#email').css("border","1px solid red");
 $('#email').focus();
 return false
}
else{
  $('#email').css("border","1px solid lightgray");
}



var name=$("#name").val();
var address=$("#address").val();
var state=$("#state").val();
var email=$("#email").val();
var company_name=$("#company_name").val();
var city=$("#city").val();
var country=$("#country").val();
var mobile=$("#mobile").val();
var id = "<?=$_GET['id']?>";
$.ajax({
  type:"POST",
  url:'ajaxCalls/add_vendor.php',
  dataType:"json",
  data:{'name':name,'address':address,'state':state,'email':email,'company_name':company_name,'city':city,'country':country,'mobile':mobile,'id':id},
  success: function(res){
       

   if(res.status=='success')
    {
      
      if(id!='')
      {

      $.growl.notice({
       title:"SUCCESS",
       message:"Vendor Edited Successfully"
      });

      $("#vendor_form").trigger('reset');
      window.location='viewvendor.php';
      setTimeout(function(){
        window.location='viewvendor.php';
      }, 1000);

      }
      else
      {


       $("#name").val(" ");
       $("#address").val(" ");
       $("#state").val(" ");
       $("#email").val(" ");
       $("#company_name").val(" ");
       $("#city").val(" ");
       $("#country").val(" ");
       $("#mobile").val(" ");

      $.growl.notice({
       title:"SUCCESS",
       message:"Vendor Added Successfully"
      });
       setTimeout(function(){
        $("#vendor_form").trigger('reset');
       window.location='viewvendor.php';
     }, 1000);

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