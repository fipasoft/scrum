<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $id
 * @property integer $stask_id
 * @property integer $story_id
 * @property integer $ttask_id
 * @property string $summary
 * @property string $description
 * @property integer $estimated
 * @property string $starts
 * @property string $ends
 * @property string $saved_at
 * @property string $modified_in
 *
 * The followings are the available model relations:
 * @property Assigned[] $assigneds
 * @property Stask $stask
 * @property Story $story
 * @property Ttask $ttask
 * @property Tbacklog[] $tbacklogs
 */
class Task extends CActiveRecord
{
	public $filters;
    public $team_id;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Task the static model class
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
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stask_id, story_id, ttask_id, summary, saved_at', 'required'),
			array('stask_id, story_id, ttask_id, estimated', 'numerical', 'integerOnly'=>true),
			array('summary', 'length', 'max'=>256),
			array('description, starts, ends, modified_in', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, stask_id, story_id, ttask_id, summary, description, estimated, starts, ends, saved_at, modified_in', 'safe', 'on'=>'search'),
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
			'assigneds' => array(self::HAS_MANY, 'Assigned', 'task_id'),
			'stask' => array(self::BELONGS_TO, 'Stask', 'stask_id'),
			'story' => array(self::BELONGS_TO, 'Story', 'story_id'),
			'ttask' => array(self::BELONGS_TO, 'Ttask', 'ttask_id'),
			'tbacklogs' => array(self::HAS_MANY, 'Tbacklog', 'task_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'stask_id' => 'Stask',
			'story_id' => 'Story',
			'ttask_id' => 'Ttask',
			'summary' => 'Summary',
			'description' => 'Description',
			'estimated' => 'Estimated',
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
		$criteria->compare('stask_id',$this->stask_id);
		$criteria->compare('story_id',$this->story_id);
		$criteria->compare('ttask_id',$this->ttask_id);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('estimated',$this->estimated);
		$criteria->compare('starts',$this->starts,true);
		$criteria->compare('ends',$this->ends,true);
		$criteria->compare('saved_at',$this->saved_at,true);
		$criteria->compare('modified_in',$this->modified_in,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
   /**
    * Obtiene las tareas que componen la historia
    * @param INT $story_id ID de la historia
    */
    public function tasksPerStory($story_id){
        $criteria = new CDbCriteria();
        $criteria->select = "t.*";
        $criteria->join = " INNER JOIN assigned ON t.id = assigned.task_id";
        $criteria->order = "id";
        
        $this->id = trim($_GET['Task']['id']);
        if($this->id!='') {
            $criteria->compare('t.id',$this->id);
            $this->filters = true;
        }
        
        $this->stask_id = trim($_GET['Task']['stask_id']);
        if($this->stask_id!='') {
            $criteria->compare('t.stask_id',$this->stask_id);
            $this->filters = true;
        }
        
        $this->story_id = trim($story_id);
        if($this->story_id!='') {
            $criteria->compare('t.story_id',$this->story_id);
            $this->filters = true;
        }        

        $this->ttask_id = trim($_GET['Task']['ttask_id']);
        if($this->ttask_id!='') {
            $criteria->compare('t.ttask_id',$this->ttask_id);
            $this->filters = true;
        }
        
        $this->summary = trim($_GET['Task']['summary']);
        if($this->summary!='') {
            $criteria->compare('t.summary',$this->summary,true);
            $this->filters = true;
        }
        
        $this->description = trim($_GET['Task']['description']);
        if($this->description!='') {
            $criteria->compare('t.description',$this->description,true);
            $this->filters = true;
        }
        
        $this->team_id = trim($_GET['Task']['team_id']);
        if($this->team_id!='') {
            $criteria->compare('assigned.team_id',$this->team_id,true);
            $this->filters = true;
        }
        
        return Task::model()->findAll($criteria);
    }
}