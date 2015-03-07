<div class="row">
<div class="col-sm-8">
<div class="panel panel-default">
  <div class="panel-heading">Klient</div>
  <div class="panel-body">
   <?php 
   
   ?>
  </div>
</div>
</div>
<div class="col-sm-4">
<div class="panel panel-default">
  <div class="panel-heading">
  Kolejka klientów
    </div>
  <div class="panel-body">
  <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'tuslugi-grid',
			'dataProvider'=>$domains->searchPanel(),
			//'filter'=>$domains,
			
			'columns'=>array(
        		
		'name',
		'client',
		'expiry_date',
				
			),
        )); ?>

   
   
  </div>
</div>
</div>
</div>

