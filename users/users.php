<?php
include '../includes/config.php';
include 'header.php';

$obj = new Admin();
$result = $obj->getUserData();

?>

<style type="text/css">
  
.form-control
{
  height: 31px;
}

select.custom-select {
    -webkit-appearance: menulist;
  }

  #editUser{
        z-index: 99999 !important;
    }

.red
{
    color: red;
}

input[type="text"]
{
    height: 40px;
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
           <h5 class="m-b-10">Users</h5>
         </div>
         <ul class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
           <li class="breadcrumb-item">Users</li>
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
                      <option value="all">All Rows</option>
                    </select>
                    <select class="form-control custom-select px-4 pagenum" style="padding: 0px 15px; height: 31px; margin: 5px;" title="Select page number"></select>

                    <input type="text" class="form-control" placeholder="Search...." id="mySearch" style="width: 170px; margin: 5px;" />

                  </div>
                </th>
              </tr>
                        </thead>
                    </table>

      </div>

      <div class="col-md-2">
      <a class="btn btn-sm btn-primary new_user" href="#" style="margin-top: 10px; float: right;">+New</a>
      </div>
    </div>

    </div>
    <div class="card-body table-border-style">
      <div class="table-responsive">

        <table class="table table-hover">
          <thead>
           <tr>
            <th style="width:15%;">Name</th>
            <th style="width:10%;">Mobile</th>
            <th style="width:12%;">Username</th>
            <th style="width:12%;">Email</th>
            <th style="width:8%;">Type</th>
            <th style="width:10%;">Action</th>
          </tr>
        </thead>
        <tbody id="mytable">


          <?php

          foreach($result as $row)
          {

          echo"<tr id='row" . $row['id'] . "'><td>" .$row['name']. "</td><td>". $row['mobile'] ."</td><td>". $row['username'] ."</td><td>". $row['email'] . "</td><td>" . $row['type'] . "</td><td><button class='btn btn-sm btn-success' data-id='" . $row['id'] . "' data-url='editUser.php?t=" . $row['id'] . "' value='" . $row['id'] . "' name='user_edit' id='user_edit" . $row['id'] . "' onclick='userEdit(this)' data-toggle='modal' " . $dnone . $disabled_btn . ">Edit</button> &nbsp; <button class='btn btn-sm btn-warning' data-id='" . $row['id'] . "' data-url='deleteUser.php?t=" . $row['id'] . "' value='" . $row['id'] . "' name='user_delete' onclick='userDelete(this)' id='user_delete" . $row['id'] . "' data-toggle='modal' " . $dnone . " " . $disabled_btn . ">Delete</button></td></tr>";

          }

          ?>



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

<div id="editUser" class="modal fade" tabindex="3" data-backdrop="static" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                  <div class="modal-body">

                  </div>
              <div class='modal-footer'>
              <div class="form-row">
                  <div class="form-group col-lg-12 text-right">
                      <input type="button" id='userUpdate' class="btn btn-sm btn-success" value="Save">
                  </div>
              </div>
              </div>
          </div>
        </div>
</div>

<div id="deleteUser" class="modal fade" tabindex="3" data-backdrop="static" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-body">

                                        </div>
                                    </div>
                                </div>
                            </div>


<div class="modal fade" id="addUser"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form id='user_data'>
   <div class="container">
    <div class='row'>
        <div class='col-lg-12'><h5>Add User
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

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active">
      <div class="container">
        <div class="row"><div class="col-lg-12"><label id='errorTxt' class="text-danger"></label></div></div>

        <div class="form-row">
            <div class="form-group col-lg-3">  Name <span class="red">*</span>
            </div>
            <div class="form-group col-lg-9">
                <input type="text" name="username" id="username" class="form-control" >
            </div>
        </div>
        
        <div class="form-row">
            <div class="col-lg-3">  Mobile No  <span class="red">*</span>
            </div>
            <div class=" col-lg-9">
                    <div class="input-group mb-3">
                       <input type="text" name="mobile_no" id="mobile_no"  class="form-control number_only" >
                    </div>

            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-lg-3">Email ID  <span class="red">*</span>
            </div>

            <div class="form-group col-lg-9">
                <input type="text" name="email_id" id="email_id" class="form-control" >
            </div>
        </div>
        
        
        <div class="form-row">
            <div class="form-group col-lg-3">
                Role  <span class="red">*</span>
            </div>
            <div class="form-group col-lg-9">
                <select id='staff_category' name="staff_category" class="form-control">
                    <option value="">Select Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Sales Person">Sales Person</option>
                    <option value="Accounts">Accounts</option>
                </select>
            </div>            
        </div>
        
        <div class="form-row">
            <div class="form-group col-lg-3">Username  <span class="red">*</span></div><div class="form-group col-lg-9"><input type="text" name="login_username" id="login_username" class='form-control'></div>

        </div>

        <div class="row">
                <div class="col-lg-3"></div><div class="col-lg-9">
                 <div class="errorTxt4 text-success"></div>
                 <div class="text-danger" id="errorTxt3" class="text-center "></div></div>
        </div>


        <div class="form-row"><div class="form-group col-lg-3">Password  <span class="red">*</span></div>
            <div class=" col-lg-9">
             <div class="input-group mb-3">
                <div class="input-group " id="confirmPassword">
                  <input class="form-control " style="height:40px;" type="password" name="password" id="password" >

                  <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                          <div class="input-group-addon">
                          <a href="#" id="Cpsh"><i class="fa fa-eye"  aria-hidden="true"></i></a>
                          </div>
                        </span>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
                                                    
            <div class="form-row">
              <div class="form-group col-lg-3">Confirm Password  <span class="red">*</span></div>
                 <div class="form-group col-lg-9">
                    <div class="input-group mb-3">
                      <div class="input-group " id="conPassword">
                          <input class="form-control" style="height:40px;" type="password" name="confirm_password" id="confirm_password" >

                      <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2"><div class="input-group-addon">
                           <a href="#" id='psh'><i class="fa fa-eye" ></i></a>
                          </div></span>
                      </div>
                    </div>
                 </div>
                </div>
              </div>

        <div class="form-row">
            <div class="form-group col-lg-12 text-right">
                <input type="button" id='user_save' class="btn btn-sm btn-success" value="Save">
            </div>
        </div>
      </div>
    </div>

</div>
</form>
      </div>
    </div>
  </div>
</div>







<?php

include 'footer.php';

?>

  <script>



    // $(document).ready(function(){



function modalClose(){
      $(".modal .close").click();
    }
     function checkPassword(){
        var password=$("#password").val();
                    var confirm_password=$("#confirm_password").val();
                    if(password!='' && confirm_password!=''){
                    if(password===confirm_password){
                        $("#errorTxt3").html("Password Matched");
                        $("#errorTxt3").removeClass().addClass('text-success');
                    }
                    else{
                        $("#errorTxt3").removeClass().addClass('text-danger');
                       $("#errorTxt3").html("Password Doesn't Match");

                    }
                }
                else{
                   // $("#password").focus();
                }
    }
    function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function phonenumber(inputtxt)
{
  var phoneno = /^\+?([6-9]{1})\)?([0-9]{4})?([0-9]{5})$/;
  if((inputtxt.match(phoneno)))
        {
      return true;
        }
      else
        {
        return false;
        }
}
function userEdit(field){
    var url = $(field).data("url");
    var title = $(field).data("title");
    $.ajax({
        type: "GET",
        url: url,
        success: function(res) {
            // update modal content
            $('#editUser .modal-body').html(res);
            // show modal
            $('#editUser').modal('show');

        },
        error:function(request, status, error) {
            console.log("ajax call went wrong:" + request.responseText);
        }
    });
}


 function userDelete(field){
  // $('#deleteUser').modal('show');
    var url = $(field).data("url");
    var title = $(field).data("title");
    $.ajax({
        type: "GET",
        url: url,
        success: function(res) {
            // update modal content
            $('#deleteUser .modal-body').html(res);
            // show modal
            $('#deleteUser').modal('show');

        },
        error:function(request, status, error) {
            console.log("ajax call went wrong:" + request.responseText);
        }
    });
}

function confirmDelete(){
     var userId=$("#userId").val();

      $.ajax({
        type:"POST",
        url:"ajaxCalls/delete_user.php",
        dataType:'json',
        data:{"userId":userId},
        success: function(res)
        {
          console.log(res);
          if(res.status=='success'){
            $.growl.notice({
                title:"SUCCESS",
                message:"User Deleted Successfully"
            });
             $("#row"+res.id).remove();
            $("#deleteUser").modal('hide');
            $('table').trigger('update');

          }

        }
        });
    }
    function modalClose(){
      $("#deleteUser").modal('hide');
    }
    
    $(document).ready(function(){
            
$(".number_only").bind("keypress", function(event) {
    //this.value=this.value.replace(/[^0-9]/g)
    if (event.charCode!=0) {
        var regex = new RegExp("^[0-9]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
    }

});
        $(".popup").hide();




     $("#mySearch").keyup(function() {
    var value = $(this).val().toLowerCase();
    $("#mytable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });


     $(".new_user").click(function(){
    $("#addUser").modal('show');
    $("#user_data")[0].reset();
    $("#errorTxt3").html('');
   });


$("#email_id").blur(function(){
        if(isEmail($("#email_id").val())==false){
                $("#email_id").val('')
                $("#email_id").attr("placeholder","Please Enter Valid Email ID");
                  $("#email_id").css("border","1px solid red");
                    // $("#email_id").focus();
                    // return false
                }
                else{
                    $("#email_id").css("border","1px solid #ccc");
                }
    })
   
        $("#login_username").blur(function(){
            var name=$(this).val();
            $.ajax({
                type:"POST",
                url:"ajaxCalls/userVerify.php",
                dataType:"json",
                data:{"name":name},
                success: function(res){
                    if(res.status=='failed'){
                         $("#login_username").focus();
                         $.growl.error({title:"FAILED",message:"Username already exist"});
                         return false;
                    }

                }
            });
        });


        $("#email_id").blur(function(){
            var email=$(this).val();
            $.ajax({
                type:"POST",
                url:"ajaxCalls/emailVerify.php",
                dataType:"json",
                data:{"email":email},
                success: function(res){
                    if(res.status=='failed'){
                         $("#email_id").focus();
                         $.growl.error({title:"FAILED",message:"Email already exist"});
                         return false;
                    }

                }
            });
        });




        $(document).on("blur","#username",function(){
            var name=$(this).val();
            var userId=$("#userId").val();
            $.ajax({
                type:"POST",
                url:"ajaxCalls/userVerify.php",
                dataType:"json",
                data:{"name":name,"userId":userId},
                success: function(res){
                    if(res.status=='failed'){
                         $("#username").focus();
                         $.growl.error({title:"FAILED",message:"Username already exist"});
                         return false;
                    }

                }
            });
        });


        $(document).on("blur","#edit_email_id",function(){
            var email=$(this).val();
            var userId=$("#userId").val();
            $.ajax({
                type:"POST",
                url:"ajaxCalls/emailVerify.php",
                dataType:"json",
                data:{"email":email,"userId":userId},
                success: function(res){
                    if(res.status=='failed'){
                         $("#edit_email_id").focus();
                         $.growl.error({title:"FAILED",message:"Email already exist"});
                         return false;
                    }

                }
            });
        });


        


          $("#confirm_password").blur(function(){
                    checkPassword();
                });
                $("#password").blur(function(){
                    checkPassword();
                });

 $("#confirmPassword a").on('click', function(event) {
            event.preventDefault();
        if($('#confirmPassword input').attr("type") == "text"){
            $('#confirmPassword input').attr('type', 'password');
            //$('#confirmPassword a svg').removeClass( '' );
           $('#Cpsh').html( '<i class="fa fa-eye" aria-hidden="true"></i>' );

        }else if($('#confirmPassword input').attr("type") == "password"){
            $('#confirmPassword input').attr('type', 'text');
           //$('#confirmPassword i').removeClass( "fa-eye-slash" );
            $('#Cpsh').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
        }
    });
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


    $("#user_save").click(function(){
            if($("#username").val()==''){
                $('#username').css("border","1px solid red");
                    $('#username').focus();
                        return false
            }
            else{
                $('#username').css("border","1px solid lightgray");
            }
              if($("#designation").val()==''){
                $('#designation').css("border","1px solid red");
                    $('#designation').focus();
                        return false
            }
            else{
                $('#designation').css("border","1px solid lightgray");
            }
            if($("#mobile_no").val()==''){
                $('#mobile_no').css("border","1px solid red");
                    $('#mobile_no').focus();
                        return false
            }
            else{
                $('#mobile_no').css("border","1px solid lightgray");
            }





            if($("#email_id").val()==''){
                $('#email_id').css("border","1px solid red");
                    $('#email_id').focus();
                        return false
            }
            else{
                $('#email_id').css("border","1px solid lightgray");
            }
            if($("#address").val()==''){
                $('#address').css("border","1px solid red");
                    $('#address').focus();
                        return false
            }
            else{
                $('#address').css("border","1px solid lightgray");
            }
            if($("#staff_category").val()==''){
                $('#staff_category').css("border","1px solid red");
                    $('#staff_category').focus();
                        return false
            }
            else{
                $('#staff_category').css("border","1px solid lightgray");
            }
            if($("#login_username").val()==''){
                $('#login_username').css("border","1px solid red");
                    $('#login_username').focus();
                        return false
            }
            else{
                $('#login_username').css("border","1px solid lightgray");
            }
            // if($("#branch").val()==''){
            //     $('#branch').css("border","1px solid red");
            //         $('#branch').focus();
            //             return false
            // }
            // else{
            //     $('#branch').css("border","1px solid lightgray");
            // }
            var branch_id=$("#branch").val();
            if($("#password").val()==''){
                $('#password').css("border","1px solid red");
                    $('#password').focus();
                        return false
            }
            else{
                $('#password').css("border","1px solid lightgray");

            }
            if($("#password").val()==$("#confirm_password").val()){
                $("#password").css("border","1px solid lightgray");
            $("#confirm_password").css("border","1px solid lightgray");

            $.ajax({
                type:"POST",
                url:'ajaxCalls/addUser.php',
                dataType:"json",
                data:$("#user_data").serialize(),
                success: function(res){
                    console.log(res);
                    if(res.status=='Failed Email')
                    {
                       $.growl.error({title:"FAILED",message:res.msg});
                       $("#email_id").focus();
                        $("#email_id").css('border','1px solid red');
                    }
                    else if(res.status=='faild'){
            $.growl.error({title:"FAILED",message:res.msg});
                        //$("#errorTxt").html(res.msg);
                        $("#email_id").focus();
                        $("#email_id").css('border','1px solid red');
                    }else{
             $.growl.notice({title:"SUCCESS",message:res.msg});
                    //$("#printReferralName").html(res.name);
                    //$("#referralId").val(res.id);}
                   var rowCount=$("#myTable tr").length;
                    var i=rowCount+1;
                    $("#mytable").append("<tr id='row"+res.id+"'><td>"+res.name+"</td><td>"+res.mobile_no+"</td><td>"+res.username+"</td><td>"+res.email+"</td><td>"+res.type+"</td><td><button class='btn btn-sm btn-success btn-action' data-id='"+res.id+"' data-url='editUser.php?t="+res.id+"' value='"+res.id+"' name='user_edit' id='user_edit"+res.id+"' onclick='userEdit(this)' data-toggle='modal' >Edit</button> &nbsp; <button class='btn btn-sm btn-warning btn-action' data-id='"+res.id+"' data-url='deleteUser.php?t="+res.id+"' value='"+res.id+"' onclick='userDelete(this)' name='user_delete' id='user_delete"+res.id+"' data-toggle='modal' >Delete</button></td></tr>");
                     $("#user_data")[0].reset();
                     $("#errorMsg").html('');
         $("#addUser .close").click();
         $('table').trigger('update');
                }

            }



        });
        }else{
            $("#password").focus();
            $("#password").css("border","1px solid red");
            $("#confirm_password").css("border","1px solid red");
        }
    });
$("#userUpdate").on('click',function(){
            if($("#username_edit").val()==''){
                $('#username_edit').css("border","1px solid red");
                    $('#username_edit').focus();
                        return false
            }
            else{
                $('#username_edit').css("border","1px solid lightgray");
            }
              if($("#design").val()==''){
                $('#design').css("border","1px solid red");
                    $('#design').focus();
                        return false
            }
            else{
                $('#design').css("border","1px solid lightgray");
            }
            if($("#edit_mobile_no").val()==''){
                $('#edit_mobile_no').css("border","1px solid red");
                    $('#edit_mobile_no').focus();
                        return false
            }
            else{
                $('#edit_mobile_no').css("border","1px solid lightgray");
            }
            if($("#edit_email_id").val()==''){
                $('#edit_email_id').css("border","1px solid red");
                    $('#edit_email_id').focus();
                        return false
            }
            else{
                $('#edit_email_id').css("border","1px solid lightgray");
            }
            if($("#edit_address").val()==''){
                $('#edit_address').css("border","1px solid red");
                    $('#edit_address').focus();
                        return false
            }
            else{
                $('#edit_address').css("border","1px solid lightgray");
            }
            if($("#edit_staff_category").val()==''){
                $('#edit_staff_category').css("border","1px solid red");
                    $('#edit_staff_category').focus();
                        return false
            }
            else{
                $('#edit_staff_category').css("border","1px solid lightgray");
            }
            if($("#username").val()==''){
                $('#username').css("border","1px solid red");
                    $('#username').focus();
                        return false
            }
            else{
                $('#username').css("border","1px solid lightgray");
            }


            $.ajax({
                type:"POST",
                url:'ajaxCalls/updateUser.php',
                dataType:"json",
                data:$("#user_update").serialize(),
                success: function(res){
                    
                    if(res.status=='Failed Email'){
            $.growl.error({title:"FAILED",message:res.msg});
                        //$("#errorTxt").html(res.msg);
                        $("#edit_email_id").focus();
                        $("#edit_email_id").css('border','1px solid red');
                    }
                    else if(res.status=='faild'){
            $.growl.error({title:"FAILED",message:res.msg});
                        //$("#errorTxt").html(res.msg);
                        $("#email_id").focus();
                        $("#email_id").css('border','1px solid red');
                    }else{
             $.growl.notice({title:"SUCCESS",message:res.msg});
                    //$("#printReferralName").html(res.name);
                    //$("#referralId").val(res.id);}
                   var rowCount=$("#myTable tr").length;
                    var i=rowCount+1;
                     $("#row"+res.id).html("<td>"+res.name+"</td><td>"+res.mobile_no+"</td><td>"+res.username+"</td><td>"+res.email+"</td><td>"+res.type+"</td><td><button class='btn btn-sm btn-success btn-action' data-id='"+res.id+"' data-url='editUser.php?t="+res.id+"' value='"+res.id+"' name='user_edit' onclick='userEdit(this)' id='user_edit"+res.id+"' data-toggle='modal' >Edit</button> &nbsp; <button class='btn btn-sm btn-warning btn-action' data-id='"+res.id+"' data-url='deleteUser.php?t="+res.id+"' value='"+res.id+"' onclick='userDelete(this)' name='user_delete' id='user_delete"+res.id+"' data-toggle='modal' >Delete</button></td>");
                     $("#user_data")[0].reset();
                     $("#errorMsg").html('');
         $("#editUser .close").click();
         $('table').trigger('update');
         
                }

            }



        });

});

    // });



   });


 </script>

 <script id="js">
  $(function() {
$.fn.columnCount = function() {
    return $('th', $(this).find('thead')).length;
        };
       var count=$('table').columnCount();
//alert(count);

    $("table").tablesorter({
       theme : "bootstrap",

        widthFixed: true,

        // widget code contained in the jquery.tablesorter.widgets.js file
        // use the zebra stripe widget if you plan on hiding any rows (filter widget)
        // the uitheme widget is NOT REQUIRED!
        //widgets : [ "filter"],
        headers: {
        5: { sorter: false, filter: false },
        7: { sorter: false, filter: false },
        //5: { sorter: false, filter: false },
        //8: { sorter: false, filter: false },
        //9: { sorter: false, filter: false },
        10: { sorter: false, filter: false }
        },
        widgetOptions : {
            // using the default zebra striping class name, so it actually isn't included in the theme variable above
            // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
            zebra : ["even", "odd"],

            // class names added to columns when sorted
            // columns: [ "primary", "secondary", "tertiary" ],

            // reset filters button
            filter_reset : ".reset",

            // extra css class name (string or array) added to the filter element (input or select)
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

        // target the pager markup - see the HTML block below
        container: $(".ts-pager"),

        // target the pager page select dropdown - choose a page
        cssGoto  : ".pagenum",

        // remove rows from the table to speed up the sort of large tables.
        // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
        removeRows: false,

        // output string - default is '{page}/{totalPages}';
        // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
        output: '{startRow} to {endRow} of {filteredRows} ({totalRows})'

    });
    

});



</script>