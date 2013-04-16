<?php

/**
 * This is the model base class for the table "biomaterial_dbxref".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "BiomaterialDbxref".
 *
 * Columns in table "biomaterial_dbxref" available as properties of the model,
 * followed by relations of table "biomaterial_dbxref" available as properties of the model.
 *
 * @property integer $biomaterial_dbxref_id
 * @property integer $biomaterial_id
 * @property integer $dbxref_id
 *
 * @property Biomaterial $biomaterial
 * @property Dbxref $dbxref
 */
abstract class BaseBiomaterialDbxref extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'biomaterial_dbxref';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'BiomaterialDbxref|BiomaterialDbxrefs', $n);
	}

	public static function representingColumn() {
		return 'biomaterial_dbxref_id';
	}

	public function rules() {
		return array(
			array('biomaterial_id, dbxref_id', 'required'),
			array('biomaterial_id, dbxref_id', 'numerical', 'integerOnly'=>true),
			array('biomaterial_dbxref_id, biomaterial_id, dbxref_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'biomaterial' => array(self::BELONGS_TO, 'Biomaterial', 'biomaterial_id'),
			'dbxref' => array(self::BELONGS_TO, 'Dbxref', 'dbxref_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'biomaterial_dbxref_id' => Yii::t('app', 'Biomaterial Dbxref'),
			'biomaterial_id' => null,
			'dbxref_id' => null,
			'biomaterial' => null,
			'dbxref' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('biomaterial_dbxref_id', $this->biomaterial_dbxref_id);
		$criteria->compare('biomaterial_id', $this->biomaterial_id);
		$criteria->compare('dbxref_id', $this->dbxref_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}