<?php
/* @var $this RegistryController */
/* @var $model Registry */

$this->breadcrumbs=array(
	'Registries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('backend', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Manage Registry'), 'url'=>array('/registry/admin')),
	array('label'=>Yii::t('app','Create Registry'), 'url'=>array('/registry/create')),
	array('label'=>Yii::t('app','View Registry'), 'url'=>array('/registry/view', 'id'=>$model->id)),
);
?>

<h1><?php echo Yii::t('backend', 'Update Registry'); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>