<?php

/* 
 * Data file that contains sample employee data
 */

$employees = [];

$employeeSource = [
    ["00001", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00002", "Avon", "McRoyce", "Operations Manager", "Operations Department" , "1999-09-24"],
    ["00003", "Elizabeth", "Stone", "Operations Analyst", "Operations Department" , "2013-01-15"],
    ["00004", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00005", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00006", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00007", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00008", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00009", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00010", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00011", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00012", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00013", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00014", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00015", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00016", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00017", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00018", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00019", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00020", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
    ["00021", "James", "Sparling", "Creative Director", "Creative Department" , "1995-05-11"],
];

$employeeArrayLength = count($employeeSource);

for($i = 0; $i < $employeeArrayLength; $i++){
    $employee = new Employee();
    $employee->setIdNumber($employeeSource[$i][0]);
    $employee->setFirstName($employeeSource[$i][1]);
    $employee->setLastName($employeeSource[$i][2]);
    $employee->setTitle($employeeSource[$i][3]);
    $employee->setDepartment($employeeSource[$i][4]);
    $employee->setDateEmployed($employeeSource[$i][5]);
    $employees[] = $employee;
}
