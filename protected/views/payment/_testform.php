<form class="form-horizontal" id="payment-form" action="/myii/index.php?r=payment/create" method="post">	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	
	
		<div class="control-group "><label class="control-label" for="Payment_invoice_id">Invoice</label><div class="controls"><select name="Payment[invoice_id]" id="Payment_invoice_id">
<option value="">--Select Invoice--</option>
<option value="97">I2012-12-00055 - Maybank Malaysia Berhad</option>
<option value="99">I2012-12-00057 - School of Engineering</option>
</select></div></div>		   
		   
    <div class="control-group "><label class="control-label" for="Payment_outstanding_amount">Outstanding Amount</label><div class="controls"><div class="input-prepend"><span class="add-on"><i class="myicon-rm"></i></span><input disabled="disabled" class="span2" name="Payment[outstanding_amount]" id="Payment_outstanding_amount" type="text" /></div></div></div>   	
	<div class="control-group "><label class="control-label" for="Payment_amount">Amount</label><div class="controls"><div class="input-prepend"><span class="add-on"><i class="myicon-rm"></i></span><input class="span2" name="Payment[amount]" id="Payment_amount" type="text" maxlength="8" /></div></div></div>	<div class="control-group "><label class="control-label" for="Payment_method_id">Method</label><div class="controls"><select name="Payment[method_id]" id="Payment_method_id">
<option value="1">Cash</option>
<option value="2">Cheque</option>
<option value="3">Bank Transfer</option>
<option value="4">Credit</option>
</select></div></div>	
	<div class="control-group "><label class="control-label" for="Payment_pay_date">Pay Date</label><div class="controls"><div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input class="span2" type="text" autocomplete="off" name="Payment[pay_date]" id="Payment_pay_date" /></div></div></div>	<div class="control-group "><label class="control-label" for="Payment_note">Note</label><div class="controls"><textarea class="span6" name="Payment[note]" id="Payment_note"></textarea></div></div>	
	
	
<div class="form-actions">
		<button class="btn btn-primary" id="createquote" type="submit" name="yt0">Create Payment</button>		
		
	</div>
		
</form>