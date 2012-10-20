<?php

/**
 * This is the model class for table "story".
 *
 * The followings are the available columns in table 'story':
 * @property integer $id
 * @property integer $size_id
 * @property integer $sstory_id
 * @property integer $cstory_id
 * @property integer $number
 * @property string $description
 * @property integer $weight
 * @property string $saved_at
 * @property string $modified_in
 *
 * The followings are the available model relations:
 * @property Pbacklog[] $pbacklogs
 * @property Sbacklog[] $sbacklogs
 * @property Size $size
 * @property Cstory $cstory
 * @property Sstory $sstory
 * @property Task[] $tasks
 */
class Story extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Story the static model class
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
		return 'story';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('size_id, sstory_id, cstory_id, number, description, saved_at', 'required'),
			array('size_id, sstory_id, cstory_id, number, weight', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>768),
			array('modified_in', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, size_id, sstory_id, cstory_id, number, description, weight, saved_at, modified_in', 'safe', 'on'=>'search'),
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
			'pbacklogs' => array(self::HAS_MANY, 'Pbacklog', 'story_id'),
			'sbacklogs' => array(self::HAS_MANY, 'Sbacklog', 'story_id'),
			'size' => array(self::BELONGS_TO, 'Size', 'size_id'),
			'cstory' => array(self::BELONGS_TO, 'Cstory', 'cstory_id'),
			'sstory' => array(self::BELONGS_TO, 'Sstory', 'sstory_id'),
			'tasks' => array(self::HAS_MANY, 'Task', 'story_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'size_id' => 'Size',
			'sstory_id' => 'Sstory',
			'cstory_id' => 'Cstory',
			'number' => 'Number',
			'description' => 'Description',
			'weight' => 'Weight',
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
		$criteria->compare('size_id',$this->size_id);
		$criteria->compare('sstory_id',$this->sstory_id);
		$criteria->compare('cstory_id',$this->cstory_id);
		$criteria->compare('number',$this->number);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('saved_at',$this->saved_at,true);
		$criteria->compare('modified_in',$this->modified_in,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
   /**
    * Obtiene las tareas que componen la historia 
    */
	public function tasks(){
        $criteria = new CDbCriteria();
        $criteria->condition = "story_id = '".$this->id."'";
        $criteria->order = "id";
		
		return Task::model()->findAll($criteria);
	}
}