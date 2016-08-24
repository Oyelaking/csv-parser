<?php

/**
 * Description of Author
 *
 * @author Oyelaking
 */
class Employee {
    
    protected $idNumber;
    protected $firstName;
    protected $lastName;    
    protected $title;
    protected $department;
    protected $dateEmployed;
    
    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getDepartment() {
        return $this->department;
    }

    public function getIdNumber() {
        return $this->idNumber;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDateEmployed() {
        return $this->dateEmployed;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
        return $this;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
        return $this;
    }

    public function setDepartment($department) {
        $this->department = $department;
        return $this;
    }

    public function setIdNumber($idNumber) {
        $this->idNumber = $idNumber;
        return $this;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setDateEmployed($dateEmployed) {
        $this->dateEmployed = $dateEmployed;
        return $this;
    }

}
