<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login"); ?>

<h1><?php echo UserModule::t("Login"); ?></h1>

<div class="form">
<?php echo CHtml::beginForm(); ?>
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username') ?>
		<?php echo CHtml::error($model,'username'); ?>
	</div>
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password') ?>
		<?php echo CHtml::error($model,'password'); ?>
	</div>
	
	<div class="row">
		<p class="hint"><?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?></p>
	</div>
	
	<div class="row rememberMe checkbox">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
		<?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Login")); ?>
	</div>
	
<?php echo CHtml::endForm(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>