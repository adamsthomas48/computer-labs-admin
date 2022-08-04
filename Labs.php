<?php
include 'DatabaseConnection.php';
include 'Lab.php';

class Labs
{
    private $arrLabs = array();

    /**
     * CONSTRUCTOR
     */
    public function __construct(){
        $dbResult = $this->getLabsFromDb();
        $this->setLabs($dbResult);
    }

    /**
     * getArrLabs
     * Used to obtain the array lf Labs received from the database.
     *
     * @return array
     */
    public function getArrLabs()
    {
        return $this->arrLabs;
    }

    /**
     * getLabsFromDb
     * Creates a connection with the Database and passes a query to return all labs from the Database
     *
     * @return array
     */
    private function getLabsFromDb(){
        $dbConnection = new DatabaseConnection();
        $dbConnection->setConnection();
        $sql = "SELECT id, lab_name, tech_frendly_name FROM computer_labs";
        $arrResult = $dbConnection->getData($sql);

        return $arrResult;
    }

    /**
     * addLab
     * Simply takes a lab object as a parameter and adds it to the $arrLabs for the Labs object
     *
     * @param $objlab
     * @return mixed
     */
    public function addLab($objlab){
        return $this->arrLabs[] = $objlab;
    }


    /**
     * setLabs
     * Takes the results of the database query, creates a Lab object for each row and adds them to the $arrLabs
     *
     * @param $dbResult
     * @return void
     */
    private function setLabs($dbResult){
        foreach(new RecursiveArrayIterator($dbResult) as $k=>$result){
            $lab = new Lab($result["id"], $result["lab_name"], $result["tech_frendly_name"]);
            $this->addLab($lab);
        }
    }


    /**
     * getSelectedLab
     * When a user clicks on a lab button, this function is run to grab the selected Lab object from the $arrLabs
     * using the id of the lab that was clicked on
     *
     * @param $id
     * @return mixed|void
     */
    public function getSelectedLab($id){
        foreach($this->arrLabs as $lab){
            if($lab->getId() == $id){
                return $lab;
            }
        }
    }

}