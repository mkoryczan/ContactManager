<?php

class ContactsView extends View {

    public function __construct() {
        
    }

    public function newContactForm() {

        $this->body.=$this->newForm('Add new contact', 'ContactForm', array(
            array('label' => 'First name*',
                'placeholder' => 'Type first name',
                'title' => 'Type first name',
                'type' => 'text',
                'name' => 'firstname',
                'id' => 'contactForm-firstname',
                'maxlength' => '128',
                'class' => 'form-input required'),
            array('label' => 'Last name*',
                'placeholder' => 'Type last name',
                'title' => 'Type last name',
                'type' => 'text',
                'name' => 'lastname',
                'id' => 'contactForm-lastname',
                'maxlength' => '128',
                'class' => 'form-input required'),
            array('label' => 'Phone',
                'placeholder' => 'Type phone number',
                'title' => 'Type phone number',
                'type' => 'text',
                'name' => 'phone',
                'id' => 'contactForm-phone',
                'maxlength' => '255',
                'class' => 'form-input'),
            array('label' => 'Mobile',
                'placeholder' => 'Type mobile number',
                'title' => 'Type mobile number',
                'type' => 'text',
                'name' => 'mobile',
                'id' => 'contactForm-mobile',
                'maxlength' => '255',
                'class' => 'form-input'),
            array('label' => 'E-mail',
                'placeholder' => 'Type e-mail adress',
                'title' => 'Type e-mail adress',
                'type' => 'text',
                'name' => 'email',
                'id' => 'contactForm-email',
                'maxlength' => '255',
                'class' => 'form-input'),
            array('label' => 'Homepage URI',
                'placeholder' => 'Type homepage URI',
                'title' => 'Type homepage URI',
                'type' => 'text',
                'name' => 'homepage_uri',
                'id' => 'contactForm-homepage_uri',
                'maxlength' => '255',
                'class' => 'form-input'),
            array('label' => 'Note',
                'placeholder' => 'Type note',
                'title' => 'Type note',
                'type' => 'text',
                'name' => 'note',
                'id' => 'contactForm-note',
                'maxlength' => '255',
                'class' => 'form-input'),
            array('value' => 'Submit',
                'type' => 'hidden',
                'name' => 'submit_add',
                'class' => 'form-input'),
            array('value' => 'Submit',
                'title' => 'Submit form',
                'type' => 'button',
                'name' => 'submit_button',
                'id' => 'contactForm-submit_add',
                'class' => 'form-submit',
                'onClick' => 'validForm("ContactForm")')
            
        ));
        $this->body.="<script type='text/javascript' src='js/contacts.js'></script>";
    }
    
    public function msgBox($type, $msg){
        
        $this->body.="<div class='msgBox' id=$type><p class='msgText'>$msg</p>"
                . "<a onclick='closeMsgBox();' class='msgBoxClose'>"
                . "<img src='img/close.ico'></a>"
                . "</div>";
        $this->body.="<script type='text/javascript' src='js/msgBox.js'></script>";

    }

}
