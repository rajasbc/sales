<?php
include '../includes/config.php';
include 'header.php';
if($_GET['id']!=''){
  $id=$_GET['id'];
  $obj = new Customer();
  $result =  $obj->get_customers($id);
}
$obj = new Customer();
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
           <h5 class="m-b-10">Customer </h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item"><a href="viewcustomer.php">Customers</a></li>
           <li class="breadcrumb-item">Add Customer</li>
           
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
           <label for="name">Name <span class="danger"> *</span></label>
           <input type="text" class="form-control enterAsTab" id="name" aria-describedby="nameHelp" placeholder="Enter Name"  value="<?php echo $result[0]['name'] ?>" autocomplete="off" autofocus>

         </div>

         <div class="form-group">
           <label for="exampleInputPassword1">Company Name <span class="danger"> *</span></label>
           <input type="text" class="form-control enterAsTab" id="company_name" placeholder="Enter Company Name" value="<?php echo $result[0]['company_name'] ?>" autocomplete="off">
         </div>
         <div class="form-group ">
           <label for="mobile">Mobile <span class="danger"> *</span></label>
           <input type="text" class="form-control enterAsTab" id="mobile" aria-describedby="mobileHelp" placeholder="Enter Mobile" value="<?php echo $result[0]['mobile'] ?>" autocomplete="off" >

         </div>
         

         <div class="form-group">
          <label for="email">Email <span class="danger"> *</span></label> 
          <input type="email" class="form-control enterAsTab" id="email" placeholder="Enter Email" value="<?php echo $result[0]['email'] ?>" autocomplete="off">
          <label style="display: none" id='email_available'></label>
        </div>
      </div>
      <div class="col-md-6">

        <div class="form-group">
         <label for="country">Country <span class="danger"> *</span></label>
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
       <label for="state">State </label>
       <input type="text" class="form-control enterAsTab" id="state" aria-describedby="stateHelp" placeholder="Enter State" value="<?php echo $result[0]['state'] ?>" autocomplete="off">

     </div>
     <div class="form-group">
       <label for="city">City </label>
       <input type="text" class="form-control enterAsTab" id="city" aria-describedby="cityHelp" placeholder="Enter City" value="<?php echo $result[0]['city'] ?>" autocomplete="off">
     </div>

     <div class="form-group">
       <label for="address">Address <span class="danger"> *</span></label>
       <textarea class="form-control" id="address" placeholder="Enter Address" aria-describedby="addressHelp" ><?php echo $result[0]['address'] ?></textarea>
     </div>

   </div>
 </div>

<div class="col-md-12 text-right">

 <button type="submit" class="btn btn-sm btn-success enterAsTab" id="submit">Submit</button>


 <?php

 if($_GET['id']!='')
 {
   echo'<a href="viewcustomer.php"><button type="button" class="btn btn-sm btn-warning">Back</button></a>';
 }
 else
 {
   echo'<button type="reset" class="btn btn-sm btn-warning" id="reset">Reset</button>'; 
 }

 ?>

</div>

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

if($("#country").val()==''){
 $('#country').css("border","1px solid red");
 $('#country').focus();
 return false
}
else{
  $('#country').css("border","1px solid lightgray");
}

if($("#address").val()==''){
 $('#address').css("border","1px solid red");
 $('#address').focus();
 return false
}
else{
  $('#address').css("border","1px solid lightgray");
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
  url:'ajaxCalls/add_customer.php',
  dataType:"json",
  data:{'name':name,'address':address,'state':state,'email':email,'company_name':company_name,'city':city,'country':country,'mobile':mobile,'id':id},
  success: function(res){
   if(res.status=='success')
   {

    if(id!='')
    {

      $.growl.notice({
       title:"SUCCESS",
       message:"Customer Edited Successfully"
     });
      $("#customer_form").trigger('reset');
      window.location='viewcustomer.php';
      // setTimeout(function(){
      //   window.location='viewcustomer.php';
      // }, 1000);

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
       message:"Customer Added Successfully"
     });
     $("#customer_form").trigger('reset');
     // setTimeout(function(){
       window.location='viewcustomer.php';
     // }, 1000);

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
<script>

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
                $("#email").blur(function(){

                     if(isEmail($("#email").val())==false){
                  $("#email").addClass("errorCall");

                    $("#email").val('');
                    $("#email").attr('placeholder','Enter Valid Email ID');
                    $("#email").css('border','1px solid #ff0000');
                    $("#email").focus();

                }else{
                    $("#email").css("border","1px solid #ccc");
                }

                $('.txtOnly').bind('keyup blur',function(){
    var node = $(this);
    node.val(node.val().replace(/[^a-z]/g,'') ); }

);
});




  $("#email").blur(function(){
    var email=$('#email').val();

    var id = '<?=$_GET['id']?>';

    if(email!='')
    {
      $.ajax({
        url:'ajaxCalls/search_email.php',
        data:{"email":email,'id':id},
        type:'POST',
        dataType:'json',
        success:function(res){
          if(res=="Email Availble")
          {
            $('#email_available').text(res).css('display','display').css('color','#00bba2');
            $('#submit').attr('disabled',false);
          }
          else
          {
            $('#email_available').text(res).css('display','block').css('color','#FF0000');
            $('#email_available').focus();
            $.growl.warning({
              title:"Warning",
              message:"Choose other Email Address"
            });
            $('#submit').attr('disabled','disabled');
          }
        }
      });
    }
    else
    {
      $('#email_available').css('display','none');
      
      $('#submit').attr('disabled','disabled');
    }
  });

</script>
