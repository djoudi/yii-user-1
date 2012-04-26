<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");?>

<h1><?php echo UserModule::t("Reset password"); ?></h1>

<div class="form">
<?php echo CHtml::beginForm(); ?>

	<div class="row">
		<p class="hint"><?php echo CHtml::link('Back to login', '/login'); ?></p>
	</div>
	
	<div class="row">
		<?php echo CHtml::activeLabel($form,'login_or_email'); ?>
		<?php echo CHtml::activeTextField($form,'login_or_email') ?>
		<p class="hint"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
	</div>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Restore")); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->