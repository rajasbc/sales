<?php
include'../includes/config.php';

$billId=$_GET['t'];

error_reporting(E_ALL);

$bill = new Purchase();
$result = $bill->get_bill($billId);

?>

<div class="container">

	<button type='button' class='close text-danger font-weight-bold' data-dismiss='modal'>&times;</button><br /><br />

	<div class="form-row">
			<input type="hidden" id="vend_id" name="vend_id" value="<?=$result['vendor']?>">
			<input type="hidden" id="bill_id" name="bill_id" value="<?=$billId?>">
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
						<td class='text-right'>".round($result['grandtotal']).".00</td></tr>";


						$balance=$balance+$result['grandtotal'];

						$payment_details=$bill->getpaymentdetails($billId);

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
						<th colspan="3">Total Paid (&#8377;)</th><th class='text-right'><?=$paid?>.00</th><th></th></tr>
					</tr>
					<tr>
						<th colspan="3">Balance Amount (&#8377;)</th><th colspan="2" class='text-right'><input type="hidden" name="balance" id="balance" value=<?=$balance?>><?=round($balance)?>.00</th>
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

		var credit=[];
		var balance=$("#balance").val();


		$("#balance_received").keyup(function(){

			
			var balance_received=$(this).val();
		
			
			if(Number(balance_received)<Number(balance))
			{
				var balance_amt=balance-balance_received;
				$('#change').val('0');
				$('#balance_amt').val(balance_amt);
			}
			else if(Number(balance_received)==Number(balance))
			{
				$('#change').val('0');
				$('#balance_amt').val('0');
			}

			else if(Number(balance_received)>Number(balance))
			{
			$('#change').val(change);
			$('#balance_amt').val('0');

			alert("amount is greater than balance");
			}

	});
		
});

</script>