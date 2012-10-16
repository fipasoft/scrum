<?php

/**
 * This is the model class for table "size".
 *
 * The followings are the available columns in table 'size':
 * @property integer $id
 * @property string $key
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Story[] $stories
 */
class Size extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Size the static model class
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
		return 'size';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key, name', 'required'),
			array('key', 'length', 'max'=>3),
			array('name', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, key, name', 'safe', 'on'=>'search'),
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
			'stories' => array(self::HAS_MANY, 'Story', 'size_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'key' => 'Key',
			'name' => 'Name',
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
		$criteria->compare('key',$this->key,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
   public static function DropDownListElements(){
        $criteria = new CDbCriteria();
        $criteria->order = "name ASC";
        $items = Size::model()->findAll($criteria);
        $lista = array();
        $lista[""] = "";
        foreach ($items as $item) {
            $lista[$item->id] = $item->name;
        }
        return $lista;
    }
}