<?php

class Lab
{
    private $strName;
    private $strTechFriendlyName;
    public $intId;
    private $arrTodos;

    public function __construct($id, $strLabName, $strTechFriendlyName){
        $this->strName = $strLabName;
        $this->strTechFriendlyName = $strTechFriendlyName;
        $this->intId = $id;
        $this->setTodos();
    }

    private function setTodos(){
        $this->arrTodos = $this->queryTodos();
    }

    private function queryTodos(){
        $dbConnection = new DatabaseConnection();
        $dbConnection->setConnection();
        $select = " todo_items.id, labs_todo_junction.computer_labs_id, todo_items.short_name, todo_items.item_type ";
        $sql = "SELECT" . $select .  "FROM labs_todo_junction RIGHT JOIN todo_items ON labs_todo_junction.todo_items_id=todo_items.id WHERE computer_labs_id=" . $this->intId;
        $arrResult = $dbConnection->getData($sql);

        return $arrResult;
    }

    public function postSubmission($employeeName, $userIp, $arrCheckedTodos){
        $date = date("Y/m/d");
        $submission_id = $this->intId . "-" . $date . "-" . $this->getTodoType();
        $arrCols = array("`id`", "`submission_id`", "`lab_id`", "`todo_id`", "`employee_name`", "`ip`", "`timestamp`");

        $arrValues = array();
        foreach($arrCheckedTodos as $todoId){
            $row = array(null, "'$submission_id'", "'$this->intId'", "'$todoId'", "'$employeeName'", "'$userIp'", "CURRENT_TIMESTAMP");
            $arrValues[] = $row; //Add row array to array of values.
        }

        $dbConnection = new DatabaseConnection();
        $dbConnection->insertData("submissions", $arrCols, $arrValues);
    }

    public function getTodos(){
        return $this->arrTodos;    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->strName;
    }

    /**
     * @return mixed
     */
    public function getTechFriendlyName()
    {
        return $this->strTechFriendlyName;
    }

    public function getId()
    {
        return $this->intId;
    }

    public function getTodoType(){
        $currentTime = date('h');
        if($currentTime < 17) return "opening";
        else return "closing";
    }

    public function setDisplay($todo){
        $currentTime = date('h');
        if($todo["item_type"] == "opening" && $currentTime < 17){
            return true;

        }
        else if($todo["item_type"] == "closing" && $currentTime >= 17){
            return true;
        }
        return false;

    }

}