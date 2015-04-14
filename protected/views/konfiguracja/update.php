<?php
/* @var $this KonfiguracjaController */
/* @var $model Konfiguracja */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */
?>

<?php


$this->menu=array(
   // array('icon' => 'glyphicon glyphicon-list','label'=>'Lista Konfiguracja', 'url'=>array('index')),
	// array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz Konfiguracja', 'url'=>array('create')),
  //  array('icon' => 'glyphicon glyphicon-list-alt','label'=>'Podgląd Konfiguracja', 'url'=>array('view', 'id'=>$model->id)),
  //  array('icon' => 'glyphicon glyphicon-tasks','label'=>'Zarządzaj Konfiguracja', 'url'=>array('admin')),
);
?>

<?php echo "<h3>Konfiguracja</h3>"; ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>