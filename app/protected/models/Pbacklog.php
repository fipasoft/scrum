<?php

/**
 * This is the model class for table "pbacklog".
 *
 * The followings are the available columns in table 'pbacklog':
 * @property integer $id
 * @property integer $project_id
 * @property integer $story_id
 * @property string $saved_at
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property Story $story
 */
class Pbacklog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Pbacklog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pbacklog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, story_id, saved_at', 'required'),
			array('project_id, story_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, project_id, story_id, saved_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'story' => array(self::BELONGS_TO, 'Story', 'story_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'project_id' => 'Project',
			'story_id' => 'Story',
			'saved_at' => 'Saved At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('story_id',$this->story_id);
		$criteria->compare('saved_at',$this->saved_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}