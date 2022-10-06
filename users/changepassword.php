<?php
include '../includes/config.php';
include 'header.php';

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
           <h5 class="m-b-10">Change Password </h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item">Change Password</li>
           
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

        <div class="row">
         <div class="col-md-6">

          <div class="text-danger" id="errorTxt3"></div>

          <div class="form-group">
           <label for="name">Password <span class="danger"> *</span></label>
           <input type="password" class="form-control enterAsTab" id="newpassword" aria-describedby="nameHelp" placeholder="Enter Password" autofocus />

         </div>
         <div class="form-group">
           <label for="exampleInputPassword1">Confirm Password <span class="danger"> *</span></label>
           <input type="password" class="form-control enterAsTab" id="confirmpassword" placeholder="Confirm Password" />
         </div>

         <button type="submit" id="update" class="btn btn-sm btn-success enterAsTab" id="submit">Submit</button>
         
      </div>
      <div class="col-md-6">

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
</div>
</div>

<?php
include 'footer.php';
?>
<script>
 $(document).ready(function(){


$('#update').click(function(){

                    var password=$("#newpassword").val();
                    var confirmpassword=$("#confirmpassword").val();


                    if(password=='')
                    {
                    $("#newpassword").focus();
                    $("#newpassword").css('border','1px solid red');
                    return false;
                    }
                    else
                    {
                      $("#newpassword").css('border','1px solid eee');
                    }

                    if(confirmpassword=='')
                    {
                    $("#newpassword").focus();
                    $("#confirmpassword").css('border','1px solid red');
                    return false;
                    }
                    else
                    {
                      $("#confirmpassword").css('border','1px solid eee');
                    }


                    if(password!=confirmpassword)
                    {
                    $("#newpassword").focus();
                    $.growl.error({title:"SUCCESS",message:"Password not matched"});
                    return false;
                    }

                        $.ajax({
                            type:"POST",
                            dataType:"json",
                            url: 'ajaxCalls/password_change.php',
                            data: {"password":password},
                            success:function(res){
                               if(res.status=='success'){
                               $.growl.notice({title:"SUCCESS",message:"Password changed successfully."});
                               }
                            }
                        });

                });


$("#confirmpassword").blur(function(){
                    var password=$("#newpassword").val();
                    var confirm_password=$("#confirmpassword").val();
                    if(password!='' && confirm_password!=''){
                    if(password!=confirm_password){
                       $("#errorTxt3").html("Password Doesn't Match");
                       $("#newpassword").focus();
                    }
                    else
                    {
                      $("#errorTxt3").html("");
                    }
                }
                else{
                    $("#newpassword").focus();
                }
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