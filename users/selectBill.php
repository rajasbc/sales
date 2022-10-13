<?php
include'../includes/config.php';

$billId=$_GET['t'];

$bill = new Sales();
$result = $bill->get_bill($billId);

?>

<div class="container">

	<button type='button' class='close text-danger font-weight-bold' data-dismiss='modal'>&times;</button><br /><br />

	<div class="form-row">
			<input type="hidden" id="cust_id" name="cust_id" value="<?=$result['customer']?>">
			<input type="hidden" id="bill_id" name="bill_id" value="<?=$billId?>">
			<input type="hidden" id="invoice_no" name="invoice_no" value="<?=$result['invoice_no']?>">
				<table class="table">
					<thead>
						<tr>
							<th>S.No</th>
							<th>Date & Time</th>
							<th>Description</th>
							<!-- <th>Mode of Payment</th> -->
							<th>Amount</th>
							<th>Balance</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=1;
						$balance=0;
						$paid=0;
						echo"<tr><td>".$i."</td><td>".date('d-M-Y h:i:s a',strtotime($result['created_at']))."</td>
						<td>Total Bill Amount</td>
						<td class='text-right'>".$result['grandtotal']."</td>
						<td class='text-right'>".$result['grandtotal']."</td></tr>";

						$balance=$balance+$result['grandtotal'];

						$payment_details=$bill->getreceiptdetails($billId);

						foreach($payment_details as $payment){
						$i++;
						
						$balance=$balance-$payment['pay'];
						
						$paid=$paid+$payment['pay'];

						echo"<tr><td>".$i."</td><td>".date('d-M-Y h:i:s', strtotime($payment['created_at']))."</td><td>Payment</td><td class='text-right'>".$payment['pay']."</td><td class='text-right'>".number_format($balance,2,'.','')."</td></tr>";
						}


						// $balance=$result['grandtotal'];
						?>
					</tbody>
					<tfoot>
					<tr>
						<th colspan="3">Total Paid (&#8377;)</th><th class='text-right'><?=$paid?></th><th></th></tr>
					</tr>
					<tr>
						<th colspan="3">Balance Amount (&#8377;)</th><th colspan="2" class='text-right'><input type="hidden" name="balance" id="balance" value=<?=$balance?>><?=$balance?></th>
					</tr>
					</tfoot>
				</table>
			</div>

		<div class="row mb-2">
			<div class="col-lg-4 col-sm-4 col-md-4">
				<div class="input-group input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Amt Receive</span>
					</div>
					
					<input name="balance_received" id="balance_received" class="form-control" placeholder="0" onkeypress="if(this.value.length==10)return false" value="<?=$balance?>">

				</div>
			</div>
			<div class="col-lg-4 col-sm-4 col-md-4">
				<div class="input-group input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Bal</span>
					</div>
					<input type="number" name="balance_amt" id="balance_amt" class="form-control" value='' placeholder="0" readonly>
				</div>
			</div>
		</div>

	<div class="form-row">
		
		<div class="col-lg-2 mt-2"><button class="btn btn-sm btn-warning btnupdate btn-block" onclick="postValue()" id='add_balance'>Pay</button></div>
		<div class="form-group col-lg-10">
			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
// 		$('#chequeid').hide();
// 		$("#payment_mode").on('change', function(){
// 		var payment_mode=$("#payment_mode").val();

// if(payment_mode=='Cheque'){
// $('#chequeid').show();
// }
// else{
// $('#chequeid').hide();
// }
// });

		var credit=[];
		var balance=$("#balance").val();
		var deposit_credit=$('#deposit_credit').text();
		var business_type='<?=$business_type?>';

		$("#balance_received").keyup(function(){
		var balance_received=$(this).val();
		if(Number(balance_received)>Number(balance))
			{
			$('#remain_balance_div').hide();
			var change=balance_received-balance;
			$('#change').val(change);
			$('#balance_amt').val('0');
			}
			else
			{
			$('#remain_balance_div').show();
			credit=deposit_credit.split(":");

			if(business_type=='bill'){
			$('#credit_check').hide();
			if(Number(credit[1])>0 && $('#is_silver_shop').val()=='no'){
			$('#deposit_credit_confirm').show();
			if ($("#remain_balance_check").prop('checked')==true) {
				$('#deposit_credit_confirm').hide();
			}
			}
			}
			$("#balance_received").css('border','1px solid #ced4da');
			}
			if(Number(balance_received)<Number(balance))
			{
				var balance_amt=balance-balance_received;
				$('#change').val('0');
				$('#balance_amt').val(balance_amt);
			}
			if(Number(balance_received)==Number(balance))
			{
				$('#change').val('0');
				$('#balance_amt').val('0');
			}

	});
		$("#remain_balance_check").on('click',function(){
			if ($("#remain_balance_check").prop('checked')==true) {
				$("#deposit_credit_confirm").css('display','none');
				if ($("#is_credit_amount_checked").prop('checked')==true) {
					$("#is_credit_amount_checked").prop('checked',false);
				}
			}else{
				if ($("#balance_received").val()!=0) {
					$("#deposit_credit_confirm").css('display','');
				}
				
			}
		})
	$("#balance_received").bind("keypress", function(event) {
//this.value=this.value.replace(/[^0-9]/g)
if (event.charCode!=0) {
var regex = new RegExp("^[0-9.]+$");
var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
if (!regex.test(key)) {
event.preventDefault();
return false;
}
}
});
});
</script>