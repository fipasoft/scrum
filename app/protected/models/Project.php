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
	public $filters;
	public $year;
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
			array('sproject_id, key, name, saved_at', 'required'),
			array('sproject_id', 'numerical', 'integerOnly'=>true),
			array('key', 'length', 'max'=>12),
			array('name', 'length', 'max'=>45),
			array('starts, ends, modified_in', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sproject_id, key, name, starts, ends, saved_at, modified_in, year', 'safe', 'on'=>'search'),
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
		$criteria->order = "starts DESC";
		
		$this->filters = false;

	    $this->id = trim($this->id);
        if($this->id!='') {
            $criteria->compare('id',$this->id,true);
            $this->filters = true;
        }
        
        $this->sproject_id = trim($this->sproject_id);
        if($this->sproject_id!='') {
            $criteria->compare('sproject_id',$this->sproject_id);
            $this->filters = true;
        }
        
	    $this->key = trim($this->key);
        if($this->key!='') {
            $criteria->compare('`key`',$this->key,true);
            $this->filters = true;
        }
		
	    $this->name = trim($this->name);
        if($this->name!='') {
            $criteria->compare('name',$this->name,true);
            $this->filters = true;
        }
        
	    $this->starts = trim($this->starts);
        if($this->starts!='') {
            $criteria->compare('starts',Utils::convierteFechaMySql($this->starts),true);
            $this->filters = true;
        }		
	    
        $this->ends = trim($this->ends);
        if($this->ends!='') {
            $criteria->compare('ends',Utils::convierteFechaMySql($this->ends),true);
            $this->filters = true;
        }		
        
        $this->year = trim($this->year);
        if($this->year!='') {
            $criteria->compare('YEAR(starts)',$this->year,true);
            $this->filters = true;
        }   

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
     * Indica si la historia especificada ya existe en el proyecto
     * @param INTEGER $project_id Indica el ID del proyecto.
     * @param INTEGER $number Indica el número de la historia. 
     * @return Bool En caso de que exista True sino False
     */
	public static function existsStory($project_id, $number){
		$sql =    "SELECT ".
		          "story.* ".
		          "FROM pbacklog ".
		          "INNER JOIN story ON pbacklog.story_id = story.id ".
		          "WHERE ".
		          "pbacklog.project_id = '".$project_id."' AND story.number = '".$number."'";
		          
		$story = Story::model()->findBySql($sql);
		return ($story->id != "");
	}
	
	 /**
     * Obtiene las historias ligadas al proyecto 
     * @return Story[] lista con las historias
     */
	public function stories(){
		$sql =    "SELECT ".
                  "story.* ".
                  "FROM pbacklog ".
                  "INNER JOIN story ON pbacklog.story_id = story.id ".
                  "WHERE ".
                  "pbacklog.project_id = '".$this->id."' ".
		          "ORDER BY number";
                  
        return Story::model()->findAllBySql($sql);
        
	}
	
   public function TeamDropDownListElements(){
        $criteria = new CDbCriteria();
        $criteria->condition = "project_id = '".$this->id."'";
        $items = Team::model()->findAll($criteria);
        $lista = array();
        $lista[""] = "";
        foreach ($items as $item) {
            $lista[$item->id] = $item->users->login;
        }
        return $lista;
    }
}