<?php
/**
 * The following variables are available in this template:
 * - $this: the BootstrapCode object
 * @author Marcin Misiak 2mmarcinmisiak@gmail.com
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @author Marcin Misiak 2mmarcinmisiak@gmail.com */

<?php
echo "\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Zarządzaj',
);\n";

?>

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'Lista <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Utwórz <?php echo $this->modelClass; ?>', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#<?php echo $this->class2id($this->modelClass); ?>-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo "<?php echo BsHtml::pageHeader('Zarządzaj','$label') ?>\n"; ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo "<?php echo BsHtml::button('Zaawansowane szukanie',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?>"; ?></h3>
    </div>
    <div class="panel-body">
       

        <div class="search-form" style="display:none">
            <?php echo "<?php \$this->renderPartial('_search',array(
                'model'=>\$model,
            )); ?>\n"; ?>
        </div>
        <!-- search-form -->

        <?php echo "<?php"; ?> $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        <?php
        $count = 0;
        foreach ($this->tableSchema->columns as $column) {
            if (++$count == 7) {
                echo "\t\t/*\n";
            }
            echo "\t\t'" . $column->name . "',\n";
        }
        if ($count >= 7) {
            echo "\t\t*/\n";
        }
        ?>
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




