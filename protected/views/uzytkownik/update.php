<?php
/* @var $this UzytkownikController */
/* @var $model Uzytkownik */
?>

<?php
$this->breadcrumbs=array(
	'Uzytkowniks'=>array('index'),
	$model->iduzytkownik=>array('view','id'=>$model->iduzytkownik),
	'Update',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Uzytkownik', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Uzytkownik', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Uzytkownik', 'url'=>array('view', 'id'=>$model->iduzytkownik)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Uzytkownik', 'url'=>array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Update','Uzytkownik '.$model->iduzytkownik) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>