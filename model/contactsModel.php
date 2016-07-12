<?php

class ContactsModel extends Model {

    private $contact_detail_elements = array('phone', 'mobile', 'email', 'homepage_uri', 'note');

    public function __construct() {

        parent::__construct();
    }

    public function createContact($contactData) {
        $this->db_conn->beginTransaction();
        $firstname = $contactData['firstname'];
        $lastname = $contactData['lastname'];

        $valuesArray = array('firstname' => $firstname, 'lastname' => $lastname);

        $tableName = 'contacts';

        $result = $this->insertQuery($tableName, $valuesArray);

        if ($result != true) {

            $this->db_conn->rollback();
            throw new Exception('Error: ' . $result);
        }

        $contactID = $this->db_conn->lastInsertId();

        foreach ($this->contact_detail_elements as $fieldType) {

            if (!empty($contactData[$fieldType])) {

                $result = $this->createContact_details($fieldType, $contactData[$fieldType], $contactID);
                if ($result != true) {
                $this->db_conn->rollback();
                throw new Exception('Error: '.$result);
                }
            }
        }

        $this->db_conn->commit();
        return true;
    }

    public function createContact_details($fieldType, $value, $contactID) {

        $rs = $this->db_conn->query("SELECT id, field_type FROM field_types");

        foreach ($rs as $row) {

            $fieldTypeID[$row['field_type']] = $row['id'];
        }

        $valuesArray = array('contact_id' => $contactID, 'field_type_id' => $fieldTypeID[$fieldType], 'value' => $value);
        $tableName = 'contact_details';

        return $this->insertQuery($tableName, $valuesArray);
    }

    public function readContact() {
        
    }

    public function updateContact() {
        
    }

    public function deleteContact() {
        
    }

}
