<?php
/**
 * Created by PhpStorm.
 * User: ds034_000
 * Date: 10/13/2015
 * Time: 7:16 PM
 */
//retrieve dept id from form
if(isset($_POST['department_id'])) {
    $department_id = intval($_POST['department_id']);
}
else{
    $department_id = 60;
}


//establish a connection
$conn = oci_connect('HR', 'hr', 'ORCL');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

//create query
$query = "select street_address, postal_code, city, state_province
from locations
where location_id = (select location_id from departments where department_id = $department_id)";

$stid = oci_parse($conn, $query);

//define return variables
oci_define_by_name($stid, 'STREET_ADDRESS', $str_add);
oci_define_by_name($stid, 'POSTAL_CODE', $pos_cd);
oci_define_by_name($stid, 'CITY', $city);
oci_define_by_name($stid, 'STATE_PROVINCE', $st_pro);

//execute the sql statement
oci_execute($stid);

//output results
$table = "";

$table .= "<table class='table'>
       <tr>
        <th>Street Address</th>
        <th>Postal_Code</th>
        <th>City</th>
        <th>State_Province</th>
       </tr>";
while (($row = oci_fetch($stid))){
    $table .= "<tr>";
    $table .=  "<td>$str_add</td>";
    $table .=  "<td>$pos_cd</td>";
    $table .=  "<td>$city</td>";
    $table .=  "<td>$st_pro</td>";
    $table .=  "</tr>";
}
echo $table;

oci_free_statement($stid);
oci_close($conn);
