<?php
/**
 * Created by PhpStorm.
 * User: ds034_000
 * Date: 11/5/2015
 * Time: 7:53 PM
 */

//establish a connection
$conn = oci_connect('HR', 'hr', 'ORCL');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

//execute query to retrieve all department ids
$query1 = "select department_id from DEPARTMENTS";

$stid1 = oci_parse($conn,$query1);
oci_execute($stid1);

//store results in array
$departments = array();
while(($row = oci_fetch_array($stid1))){
    $dept_id = $row['department_id'];
    array_push($departments,$dept_id);
}

//write array into a JSON object
$fp = fopen('DeptID.json', 'w');
fwrite($fp, json_encode($departments));
fclose($fp);

oci_free_statement($stid1);
oci_close($conn);