<?php
include'../includes/config.php';
$userId=$_GET["t"];
?>
<div class="container"><div class="form-row"><div class="form-group col-lg-12">Are you sure want delete this User? <input type='hidden' id='userId' name='userId' value="<?=$userId?>"></div><div class="form-group col-lg-6 text-center"><input type="button" name="confirm" id='confirm' class="btn btn-danger" onClick="confirmDelete()"  value="confirm"></div><div class="col-lg-6 text-center"><input type="button" name="cancel" onClick="modalClose()" class="btn btn-primary" id='cancel' value="Cancel"></div>
</div></div>

<script type="text/javascript">
	
</script>