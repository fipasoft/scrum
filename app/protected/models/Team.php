<?php

/**
 * This is the model class for table "team".
 *
 * The followings are the available columns in table 'team':
 * @property integer $id
 * @property integer $project_id
 * @property integer $role_id
 * @property integer $users_id
 * @property string $saved_at
 *
 * The followings are the available model relations:
 * @property Assigned[] $assigneds
 * @property Project $project
 * @property Role $role
 * @property Users $users
 */
class Team extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Team the static model class
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
		return 'team';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, role_id, users_id, saved_at', 'required'),
			array('project_id, role_id, users_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, project_id, role_id, users_id, saved_at', 'safe', 'on'=>'search'),
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
			'assigneds' => array(self::HAS_MANY, 'Assigned', 'team_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
			'users' => array(self::BELONGS_TO, 'Users', 'users_id'),
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
			'role_id' => 'Role',
			'users_id' => 'Users',
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
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('users_id',$this->users_id);
		$criteria->compare('saved_at',$this->saved_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}