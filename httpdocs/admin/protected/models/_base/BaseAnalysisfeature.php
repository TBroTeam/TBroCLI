<?php

/**
 * This is the model base class for the table "analysisfeature".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Analysisfeature".
 *
 * Columns in table "analysisfeature" available as properties of the model,
 * followed by relations of table "analysisfeature" available as properties of the model.
 *
 * @property integer $analysisfeature_id
 * @property integer $feature_id
 * @property integer $analysis_id
 * @property double $rawscore
 * @property double $normscore
 * @property double $significance
 * @property double $identity
 *
 * @property Analysis $analysis
 * @property Feature $feature
 * @property Analysisfeatureprop[] $analysisfeatureprops
 */
abstract class BaseAnalysisfeature extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'analysisfeature';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Analysisfeature|Analysisfeatures', $n);
	}

	public static function representingColumn() {
		return 'analysisfeature_id';
	}

	public function rules() {
		return array(
			array('feature_id, analysis_id', 'required'),
			array('feature_id, analysis_id', 'numerical', 'integerOnly'=>true),
			array('rawscore, normscore, significance, identity', 'numerical'),
			array('rawscore, normscore, significance, identity', 'default', 'setOnEmpty' => true, 'value' => null),
			array('analysisfeature_id, feature_id, analysis_id, rawscore, normscore, significance, identity', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'analysis' => array(self::BELONGS_TO, 'Analysis', 'analysis_id'),
			'feature' => array(self::BELONGS_TO, 'Feature', 'feature_id'),
			'analysisfeatureprops' => array(self::HAS_MANY, 'Analysisfeatureprop', 'analysisfeature_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'analysisfeature_id' => Yii::t('app', 'Analysisfeature'),
			'feature_id' => null,
			'analysis_id' => null,
			'rawscore' => Yii::t('app', 'Rawscore'),
			'normscore' => Yii::t('app', 'Normscore'),
			'significance' => Yii::t('app', 'Significance'),
			'identity' => Yii::t('app', 'Identity'),
			'analysis' => null,
			'feature' => null,
			'analysisfeatureprops' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('analysisfeature_id', $this->analysisfeature_id);
		$criteria->compare('feature_id', $this->feature_id);
		$criteria->compare('analysis_id', $this->analysis_id);
		$criteria->compare('rawscore', $this->rawscore);
		$criteria->compare('normscore', $this->normscore);
		$criteria->compare('significance', $this->significance);
		$criteria->compare('identity', $this->identity);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}