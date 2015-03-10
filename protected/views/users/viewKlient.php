<?php
/* @var $this UsersController */
/* @var $model Users */
?>

<h5><?php echo $model->imie . " " . $model->nazwisko. " ". $model->email ?></h5
<?php $this->widget('bootstrap.widgets.BsGridView',array(
		'id'=>'domenyPrzydzielone-grid',
		'dataProvider'=>$przydzielenie->search(),
		'filter'=>$przydzielenie,
		
		'columns'=>array(
		'domains.name',
		'domains.client',
		'domains.expiry_date',
			
				
			),
));

?>




