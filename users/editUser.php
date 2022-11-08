<?php
include'../includes/config.php';
$userId=$_GET['t'];
$obj=new Admin();
$user=$obj->getusername($userId);

?>

<style type="text/css">

.red
{
    color: red;
}

input[type="text"]
{
    height: 40px;
}

</style>

<div class="container">
    <div class='row'>
        <div class='col-lg-12'><h5>Edit User
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button></h5>
      </div>
  </div>
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home" id="referralInfo">User Information</a>
  </li>
</ul>
<form id='user_update'>
    <div class="row"><div class="col-lg-12"><br><label id='errorTxt' class="text-danger"></label></div></div>
    <div class="form-row">
        <div class="form-group col-lg-3">  Name <span class="red">*</span>
        </div>
        <div class="form-group col-lg-9">
            <input type="hidden" name="userId" id="userId" value='<?=$user['id']?>' class="form-control" >
            <input type="text" name="username_edit" id="username_edit" value='<?=$user['name']?>' class="form-control" >
        </div>
    </div>

<div class="form-row">
    <div class="col-lg-3">  Mobile No <span class="red">*</span>
    </div>
    <div class=" col-lg-9">
        <div class="input-group mb-3">
          <!-- <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">+91</span>
        </div> -->
        <input type="text" name="edit_mobile_no" id="edit_mobile_no" maxlength="10" value='<?=$user['mobile']?>' class="form-control number_only" >
    </div>

</div>
</div>
<div class="form-row">
    <div class="form-group col-lg-3">Email ID <span class="red">*</span>
    </div>

    <div class="form-group col-lg-9">
        <input type="text" name="edit_email_id" id="edit_email_id" value='<?=$user['email']?>' class="form-control" >
    </div>
</div>

<div class="form-row">
    <div class="form-group col-lg-3">
        Staff Role <span class="red">*</span>
    </div>
    <div class="form-group col-lg-9">

            <select id='edit_staff_category' name="edit_staff_category" readonly class="form-control">
                    <option value="">Select Role</option>
                    <option value="Admin" <?php if($user['type']=='Admin'){ echo'selected="selected"'; } ?>>Admin</option>
                    <option value="Sales Person" <?php if($user['type']=='Sales Person'){ echo'selected="selected"'; } ?>>Sales Person</option>
                    <option value="Accounts" <?php if($user['type']=='Accounts'){ echo'selected="selected"'; } ?>>Accounts</option>
            </select>

    </div>
</div>

<div class="form-row">
    <div class="form-group col-lg-3">Username <span class="red">*</span></div><div class="form-group col-lg-9"><input type="text" name="username" value='<?=$user['username']?>' id="username" class='form-control'></div></div>



<div class="form-row">
    <div class="form-group col-lg-3">Password <span class="red">*</span></div>
    <div class="form-group col-lg-9">
        <div class="input-group mb-3">
          <div class="input-group " id="conPassword">
              <input class="form-control" style="height:40px;" type="password" name="password_edit" id="password_edit" >

              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><div class="input-group-addon">
                 <a href="#" id='psh'><i class="fa fa-eye" ></i></a>
             </div></span>
         </div>
     </div>
 </div>
</div>
</div>

</div>
</form>
<script type="text/javascript">

 $("#conPassword a").on('click', function(event) {
    event.preventDefault();
    if($('#conPassword input').attr("type") == "text"){
        $('#conPassword input').attr('type', 'password');
            //$('#conPassword a svg').removeClass( '' );
            $('#psh').html( '<i class="fa fa-eye" aria-hidden="true"></i>' );

        }else if($('#conPassword input').attr("type") == "password"){
            $('#conPassword input').attr('type', 'text');

            $('#psh').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
        }
    });
</script>
