<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
	<div class="col-lg-12">
		<div class="btn-group pull-right" role="group" aria-label="...">
        <?php
								// foreach ($this->menu as $m){
								// var_dump($m);
								// $params =array();
								// foreach ($m as $klucz=>$w) {
								// if($klucz!=0)
								// $params[$klucz]=$w;
								// }
								// echo "<a href=\"".$this->createUrl($m['url'][0], $params). "\" class=\"btn btn-primary btn-xs\" role=\"button\"><span class=\"". $m['icon'] ."\"></span> " .$m['label']."</a>";
								// }
								$this->widget ( 'bootstrap.widgets.BsNav', array (
										
										'items' => $this->menu,
										'htmlOptions' => array (
												'class' => 'operations' 
										),
										'type' => BsHtml::NAV_TYPE_PILLS 
								) );
								?>
     </div>
	</div>
      

        <?php
								
								// $this->beginWidget('zii.widgets.CPortlet', array(
								// 'title'=>'Operacje',
								// ));
								// $this->widget('bootstrap.widgets.BsNav', array(
								
								// 'items'=>$this->menu,
								// 'htmlOptions'=>array('class'=>'operations'),
								// ));
								// $this->endWidget();
								//								?>
<!--         </div> -->
	<!--     </div> -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div id="content">
            <?php echo $content; ?>
        </div>
	</div>
</div>
<?php $this->endContent(); ?>