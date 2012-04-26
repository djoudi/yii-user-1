<h1><?php echo UserModule::t("Manage Users"); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->username),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->email), "mailto:".$data->email)',
		),
		array(
			'name' => 'createtime',
			'value' => 'date("m/d/Y",$data->createtime)',
			'visible' => Yii::app()->getModule('user')->isAdmin(),
		),
		array(
			'name' => 'lastvisit',
			'value' => '(($data->lastvisit)?date("m/d/Y",$data->lastvisit):UserModule::t("Not visited"))',
			'visible' => Yii::app()->getModule('user')->isAdmin(),
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'visible' => Yii::app()->getModule('user')->isAdmin(),
		),
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
			'visible' => Yii::app()->getModule('user')->isAdmin(),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
