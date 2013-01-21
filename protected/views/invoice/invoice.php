<header>
			<h1><?php echo $header ?></h1>
			
			<?php echo CHtml::image(Yii::app()->baseUrl."/images/hzlogo_small.jpg",'Logo'); ?>
			<div id="info_wrapper">
				<div id="comp_info">
					<address>
						<p><?php echo $company['company_name'] . '  ('. $company['co_registration_no'] . ')';?> </p>
						<p><?php  echo $company['co_address1'] ?></p>
						<p><?php  echo $company['co_address2'] ?></p>
						<p><?php  echo $company['co_zipcode'] ." ";
								  echo $company['co_city']; ?></p>
						<p>Email: <?php  echo $company['co_email'] ?></p>
						<p>Phone: <?php  echo $company['co_phone'] ?></p>
					</address>
				</div>
				<div id="receiver">
					<table class="billto">
						<tr>
	                         <th><?php echo $header ;?> No:</th>
	                         <td><?php echo $model->invoice_number;  ?></td>
                     	</tr>
                        <tr>
                             <th><?php echo $header ;?> Date:</th>
                             <td><?php echo $model->date_entered;  ?></td>
                        </tr>
                        <tr>
                             <th>Bill To:</th>
                             <td><?php echo $model->contact->name ?></td>
                        </tr>
                        <tr>
                                 <th>Address</th>
                                 <td><?php echo $model->client->name ?></td>
                             </tr>
							<tr>
                                 <th></th>
                                 <td><?php echo $model->client->address ?></td>
                             </tr>
							 <tr>
                                 <th></th>
                                 <td><?php echo $model->client->address2 ?></td>
                             </tr>
							 <tr>
                                 <th></th>
                        <td><?php echo $model->client->zipcode . " " . $model->client->city ?></td>
                             </tr>
							 <tr>
                                 <th></th>
                                 <td><?php echo $model->client->state; ?></td>
                             </tr>
                             <tr>
                                 <th>Phone:</th>
                                 <td><?php $model->contact->phone ?></td>
                             </tr>

				
				</table>																																						
				
				</div>
			</div>
		</header>
		<article>
			
			<table class="inventory">
				<thead>
					<tr>
						<th>Date</th>
						<th>Description</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Amount</th>
					</tr>
				</thead>
				<?php foreach($model->invoiceItem as $i=>$item): ?>
				<tbody>
					<tr>
						<td><?php echo $item['item_date'];?></td>
						<td><?php echo ($item['item_name']=='' ? '&nbsp' :$item['item_name']) ; ?>
						</td>
						<td><?php echo $item['item_quantity']; ?></td>
						<td style="text-align:right"><?php 
							if ($item['item_price'] != null){
								echo Setting::model()->getCurrencySymbol();		
								echo " ";
								echo $item['item_price'];} ?>
								
						</td>
						<td style="text-align:right"><?php
							if ($item['item_sub_total'] != null){
								echo $curr;	
								echo " ";
								echo $item['item_sub_total']; }?>
						</td>
					</tr>
					
					<?php endforeach; ?>
				</tbody>
			</table>
			
			<table class="balance">
				<tr>
					<th>Total</th>
					<td><?php echo Setting::model()->getCurrencySymbol();
							 echo $model->invoiceAmount->invoice_subtotal;?>
				    </td>
				</tr>
				<tr>
					<th>Amount Paid</th>
					<td>
						<?php echo $curr . ' ' .$model->invoiceAmount->invoice_paid; ?>
					</td>
				</tr>
				<tr>
					<th>Balance Due</th>
					<td><?php echo Setting::model()->getCurrencySymbol();
						      echo $model->invoiceAmount->invoice_balance; ?></td>
				</tr>
			</table>
		</article>
		<aside>
			<strong>Terms and Condition</strong>
			<div class="tc">
				<p><?php
			echo nl2br ($model->terms);
		  
		  ?></p>
			</div>
		</aside>

