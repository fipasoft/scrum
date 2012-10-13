<?php

/**
 * This is the model class for table "historical".
 *
 * The followings are the available columns in table 'historical':
 * @property integer $id
 * @property string $user
 * @property string $description
 * @property string $controller
 * @property string $action
 * @property string $model
 * @property string $record
 * @property string $saved_at
 */
class Historical extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Historical the static model class
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
		return 'historical';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, user, description, controller, action, model, record, saved_at', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('user', 'length', 'max'=>20),
			array('description', 'length', 'max'=>768),
			array('controller, action, model, record', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user, description, controller, action, model, record, saved_at', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user' => 'User',
			'description' => 'Description',
			'controller' => 'Controller',
			'action' => 'Action',
			'model' => 'Model',
			'record' => 'Record',
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
		$criteria->compare('user',$this->user,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('controller',$this->controller,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('record',$this->record,true);
		$criteria->compare('saved_at',$this->saved_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}