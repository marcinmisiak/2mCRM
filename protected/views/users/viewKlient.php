<?php
/* @var $this UsersController */
/* @var $model Users */
?>

<div class="panel panel-default">
<div class="panel-heading"><h4>Domeny przydzilone</h4><h5><?php echo $model->imie . " " . $model->nazwisko. " ". $model->email ?></h5></div>
<div class="panel-body">
<?php $this->widget('bootstrap.widgets.BsGridView',array(
		'id'=>'domenyPrzydzielone-grid',
		'dataProvider'=>$domains->search(),
		'filter'=>$domains,
		
		'columns'=>array(
		'name',
		'client',
		'expiry_date',
			
				
			),
));
?>
</div>
</div>
