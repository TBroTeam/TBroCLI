<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'analysis-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model, 'description'); ?>
		<?php echo $form->error($model,'description'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'program'); ?>
		<?php echo $form->textField($model, 'program', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'program'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'programversion'); ?>
		<?php echo $form->textField($model, 'programversion', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'programversion'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'algorithm'); ?>
		<?php echo $form->textField($model, 'algorithm', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'algorithm'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sourcename'); ?>
		<?php echo $form->textField($model, 'sourcename', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'sourcename'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sourceversion'); ?>
		<?php echo $form->textField($model, 'sourceversion', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'sourceversion'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sourceuri'); ?>
		<?php echo $form->textArea($model, 'sourceuri'); ?>
		<?php echo $form->error($model,'sourceuri'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'timeexecuted'); ?>
		<?php echo $form->textField($model, 'timeexecuted'); ?>
		<?php echo $form->error($model,'timeexecuted'); ?>
		</div><!-- row -->

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->