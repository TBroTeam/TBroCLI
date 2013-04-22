<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
    array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
    array('label' => Yii::t('app', 'Update') . ' ' . $model->label(), 'url' => array('update', 'id' => $model->biomaterial_id)),
    array('label' => Yii::t('app', 'Delete') . ' ' . $model->label(), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->biomaterial_id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
    array('label' => Yii::t('app', 'Manage') . ' ' . BiomaterialRelationship::label(2), 'url' => array('biomaterialRelationship/admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'biomaterial_id',
        array(
            'name' => 'taxon',
            'type' => 'raw',
            'value' => $model->taxon !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->taxon)), array('organism/view', 'id' => GxActiveRecord::extractPkValue($model->taxon, true))) : null,
        ),
        array(
            'name' => 'biosourceprovider',
            'type' => 'raw',
            'value' => $model->biosourceprovider !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->biosourceprovider)), array('contact/view', 'id' => GxActiveRecord::extractPkValue($model->biosourceprovider, true))) : null,
        ),
        array(
            'name' => 'dbxref',
            'type' => 'raw',
            'value' => $model->dbxref !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->dbxref)), array('dbxref/view', 'id' => GxActiveRecord::extractPkValue($model->dbxref, true))) : null,
        ),
        'name',
        'description',
    ),
));
?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('biomaterialRelationships')); ?></h2>
<?php
echo GxHtml::openTag('ul');
foreach ($model->biomaterialRelationships as $relatedModel) {
    $child = Biomaterial::model()->findByAttributes(array('biomaterial_id' => $relatedModel->subject_id))->name;
    echo GxHtml::openTag('li');
    echo GxHtml::link($child, array('biomaterialRelationship/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
    echo GxHtml::closeTag('li');
}
echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('biomaterialRelationships1')); ?></h2>
<?php
echo GxHtml::openTag('ul');
foreach ($model->biomaterialRelationships1 as $relatedModel) {
    $parent = Biomaterial::model()->findByAttributes(array('biomaterial_id' => $relatedModel->object_id))->name;
    echo GxHtml::openTag('li');
    echo GxHtml::link($parent, array('biomaterialRelationship/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
    echo GxHtml::closeTag('li');
}
echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('assayBiomaterials')); ?></h2>
<?php
echo GxHtml::openTag('ul');
foreach ($model->assayBiomaterials as $relatedModel) {
    $assay = Assay::model()->findByAttributes(array('assay_id' => $relatedModel->assay_id))->name;
    echo GxHtml::openTag('li');
    echo GxHtml::link($assay, array('assayBiomaterial/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
    echo GxHtml::closeTag('li');
}
echo GxHtml::closeTag('ul');
?>