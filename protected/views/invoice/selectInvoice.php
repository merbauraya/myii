<?php $this->widget('zii.widgets.grid.CGridView', array(
							'dataProvider'=>Invoice::model()->getOpenQuotations(),
									'columns'=>array(
										array('name'=>'is_quote','header'=>'Quote/Invoice','value'=>'$data->is_quote==0 ? "Invoice": "Quotation"'),
										array('name'=>'invoice_number','header'=>'Quote/Invoice Number'),
										array('name'=>'date_entered','header'=>'Quote Date'),
																				array('name'=>'client.name','header'=>'Client'),
																				array('name'=>'invoiceAmount.invoice_subtotal','header'=>'Total'),
																				

									/* Action BUttons */
									array(
										'class'=>'CButtonColumn',
										'template'=>'{print}', 
										'buttons'=>array(
											'print'=>array(
														'label'=>'Print',
														'imageUrl'=>Yii::app()->baseUrl.'/images/print.png',
														'url'=>'Yii::app()->createUrl("invoice/print",
																array("id" => $data->id))',
														),
														)
										)
													)
												)
					); 
?>


