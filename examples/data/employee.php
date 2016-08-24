<?php

/* 
 * Data file that contains sample employee data
 */

$employees = [];

$employeeSource = [
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "Avon", "McRoyce", "Operations Manager", "Operations Department" , "1999-09-24"],
    ["00001", "Elizabeth", "Stone", "Operations Analyst", "Operations Department" , "2013-01-15"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
];

$employeeArrayLength = count($employeeSource);

for($i = 0; $i < $employeeArrayLength; $i++){
    $employee = new Employee();
    $employee->setIdNumber($employeeSource[$i][0]);
    $employee->setFirstName($employeeSource[$i][1]);
    $employee->setLastName($employeeSource[$i][2]);
    $employee->setTitle($employeeSource[$i][3]);
    $employee->setDateEmployed($employeeSource[$i][4]);
    $employee->setDateEmployed($employeeSource[$i][5]);
    $employees[] = $employee;
}
