<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT);

class Model {

    protected $db_conn;

    public function __construct() {

        require_once __dir__ . '/config.php';
        $conn = $this->connect($db_server, $db_login, $db_pass, $db_name);

        if ($conn === true) {
            
        } else {
            throw new Exception($conn);
        }
    }

    protected function connect($db_server, $db_login, $db_pass, $db_name) {

        try {
            $this->db_conn = new PDO("mysql:host=$db_server;dbname=$db_name;charset=utf8mb4", $db_login, $db_pass);
            $this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db_conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $e) {

            return ("ERROR: Connection couldn't be established");
        }

        return true;
    }
    
    protected function insertQuery($tableName, $valuesArray){
        
        $columnsString='';
        $valuesString='';
        $params=array();
        
        $i=0;
       foreach($valuesArray as $columnName=>$value){
            if($i==0){
            $columnsString.="$columnName";
            $valuesString.=":$columnName";
            
            $i++;
            }
            else{
                $columnsString.=", $columnName";
                $valuesString.=", :$columnName";
                
            }
            $params[":$columnName"]=$value;
       }
        $query=$this->db_conn->prepare("INSERT INTO `$tableName` ($columnsString) VALUES ($valuesString)");
        
        if($query->execute($params)){
           return true;
        }
        else{ 
            return('Cannot add record');
        }
        
    }
    

}

class View {

    protected $html = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html>';
    protected $head = "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" /><meta charset=\"UTF-8\"><link rel='stylesheet' type='text/css' href='css/style.css' />\n<script type='text/javascript' src='lib/jquery-1.12.4.min.js'></script>";
    protected $title;
    protected $body = "<noscript><div>Page doesn't work corectelly without JavaScript turn on</div></noscript>";

    public function displayView() {

        echo $this->html;
        echo "<head><title>$this->title</title>$this->head</head>";
        echo "<body>$this->body</body>";
        echo "</html>";
    }

    public function newForm($formHeader, $formName, $fields) {

        $returnString = '';
        $returnString.="<div class='form-box'>";
        $returnString.="<div class='form-header'><p>$formHeader</p></div>";
        $returnString.="<form class='$formName' name='$formName' method='POST' action='' id='$formName'>";
        $returnString.="<ul class='form-list'>";

        foreach ($fields as $fields_list) {


            $returnString.="<li><label for=" . $fields_list['name'] . ">" . $fields_list['label'] . "</label>";
            $params = '';

            
            
            
            foreach ($fields_list as $field_key => $field_value) {

                if ($field_key == 'label')
                    continue;

                $params.=" $field_key='$field_value' ";
            }

            $returnString.="<div class='form-input-box'><input $params></div></li>";
        }
        $returnString.="</ul>";
        $returnString.="<p class='required_info'>* required</p>";
        $returnString.="</form>";
        $returnString.="</div>";


        return $returnString;
    }

}

class Controller {

    protected $action;
    
    public function getAction(){
        return $this->action;
    }

}

class App {

    private static $instance;
    private $module;
    

    protected function __construct() {
        
    }

    public function getInstance() {

        if (static::$instance === null) {

            static::$instance = new static();
        }

        return static::$instance;
    }

    public function init() {

        if (isset($_GET['mod'])) {

            $this->module = $_GET['mod'];

            if (file_exists(__DIR__ . "/model/" . $this->module . "Model.php")
                    and
                    file_exists(__DIR__ . "/view/" . $this->module . "View.php")
                    and
                    file_exists(__DIR__ . "/controller/" . $this->module . "Controller.php")
            ) {

                include_once __DIR__ . "/model/" . $this->module . "Model.php";
                include_once __DIR__ . "/view/" . $this->module . "View.php";
                include_once __DIR__ . "/controller/" . $this->module . "Controller.php";
            } else {

                echo ("This page doesn't exist");
            }
        } else {
            //Main page
            header('Location: ?mod=contacts&action=add');
        }
    }

}
