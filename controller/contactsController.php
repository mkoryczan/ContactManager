<?php

class ContactsController extends Controller {

    public function __construct($action) {

        $this->action = $action;

        if (!empty($action)) {

            switch ($action) {

                case 'add':
                    $this->addAction();
                    break;

                case 'display':
                    break;
            }
        }
    }

    public function addAction() {
        $view = new ContactsView();
        try{ 
            $model = new ContactsModel();
           }
        catch(Exception $e){
            $view->msgBox('msgBad',$e->getMessage()); 
            $view->newContactForm();
            $view->displayView();
            return false;
        }
        
        
        if (isset($_POST['submit_add'])) {
            
            $valuesArray=$_POST;
            try{ 
            $model->createContact($valuesArray);
            $view->msgBox('msgGood','You have added a new contact');
            }
            catch(Exception $e){
            $view->msgBox('msgBad',$e->getMessage());    
            }
        }

        
        $view->newContactForm();
        $view->displayView();
        return true;
    }

    public function displayAction() {
        
    }

    public function editAction() {
        
    }


}

$action = $_GET['action'];
$controller = new ContactsController($action);
