<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $name
 * @property string $lastName
 * @property string $email
 * @property string $group
 * @property string $saved_at
 * @property string $modified_in
 *
 * The followings are the available model relations:
 * @property Team[] $teams
 */
class Users extends CActiveRecord
{
	public $filtros;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, login, password, saved_at', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('login', 'length', 'max'=>20),
			array('password', 'length', 'max'=>40),
			array('name, lastName', 'length', 'max'=>50),
			array('email', 'length', 'max'=>100),
			array('group', 'length', 'max'=>32),
			array('modified_in', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login, password, name, lastName, email, group, saved_at, modified_in', 'safe', 'on'=>'search'),
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
			'teams' => array(self::HAS_MANY, 'Team', 'users_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'password' => 'Password',
			'name' => 'Name',
			'lastName' => 'Last Name',
			'email' => 'Email',
			'group' => 'Group',
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('group',$this->group,true);
		$criteria->compare('saved_at',$this->saved_at,true);
		$criteria->compare('modified_in',$this->modified_in,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}