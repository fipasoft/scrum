<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property integer $sproject_id
 * @property string $key
 * @property string $name
 * @property string $starts
 * @property string $ends
 * @property string $saved_at
 * @property string $modified_in
 *
 * The followings are the available model relations:
 * @property Pbacklog[] $pbacklogs
 * @property Sproject $sproject
 * @property Sprint[] $sprints
 * @property Team[] $teams
 */
class Project extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Project the static model class
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
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, sproject_id, key, name, saved_at', 'required'),
			array('id, sproject_id', 'numerical', 'integerOnly'=>true),
			array('key', 'length', 'max'=>12),
			array('name', 'length', 'max'=>45),
			array('starts, ends, modified_in', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sproject_id, key, name, starts, ends, saved_at, modified_in', 'safe', 'on'=>'search'),
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
			'pbacklogs' => array(self::HAS_MANY, 'Pbacklog', 'project_id'),
			'sproject' => array(self::BELONGS_TO, 'Sproject', 'sproject_id'),
			'sprints' => array(self::HAS_MANY, 'Sprint', 'project_id'),
			'teams' => array(self::HAS_MANY, 'Team', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sproject_id' => 'Sproject',
			'key' => 'Key',
			'name' => 'Name',
			'starts' => 'Starts',
			'ends' => 'Ends',
			'saved_at' => 'Saved At',
			'modified_in' => 'Modified In',
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
		$criteria->compare('sproject_id',$this->sproject_id);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('starts',$this->starts,true);
		$criteria->compare('ends',$this->ends,true);
		$criteria->compare('saved_at',$this->saved_at,true);
		$criteria->compare('modified_in',$this->modified_in,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}