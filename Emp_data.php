<?php
$employess_data = file_get_contents('employees.txt');
$employess_data = explode("\n", $employess_data);

$emp_set = [];
$emp_set_retirement = [];
$emp_retirement = [];

$age = 0;
$retirement_age = 60;


foreach ($employess_data as $data) {
    //print_r(explode(',', $data));
    $each_data = explode(',', $data);

    $emp_age = $each_data[count($each_data) - 1];
    /*  foreach ($each_data as $key => $value) {
          
      }*/
    // print_r($emp_age);
    if ($emp_age > $age) {
        $age = $emp_age;
        $emp_id = $each_data[0];
        $emp_f_name = $each_data[1];
        $emp_l_name = $each_data[2];

        $emp_set_highAge = array('emp_id' => $emp_id, 'empf_name' => $emp_f_name, 'empl_name' => $emp_l_name, 'emp_age' => $age);
    } elseif ($emp_age == $age) {
        $age = $emp_age;
        $emp_id = $each_data[0];
        $emp_f_name = $each_data[1];
        $emp_l_name = $each_data[2];
        $f_sh_name = strtoupper($emp_f_name[0]);
        $emp_name = $f_sh_name . '.' . $emp_l_name;
        print_r($emp_name);
        $emp_set_du = array('emp_id' => $emp_id, 'empf_name' => $emp_f_name, 'empl_name' => $emp_l_name, 'emp_age' => $age);
        $emp_set_highAge = array($emp_set_highAge, $emp_set_du);
    }
    if ($emp_age >= $retirement_age) {
        $emp_id = $each_data[0];
        $emp_f_name = $each_data[1];
        $emp_l_name = $each_data[2];
        $emp_set_retirement = array(
            'emp_id' => $emp_id,
            'empf_name' => $emp_f_name,
            'empl_name' => $emp_l_name,
            'emp_age' => $emp_age
        );
        $emp_retirement[] = $emp_set_retirement;
    }

}
//print_r($emp_set_highAge);
$new_data_1 = "Emp_id,Emp_first_name,Emp_last_name, Emp_age\n";
$new_data_2 = "Emp_id,Emp_first_name,Emp_last_name, Emp_age\n";
$file_1 = 'high_age_details.txt';
$file_3 = 'retirement_age_details.txt';

foreach ($emp_set_highAge as $highagedata) {
    $new_data_1 .= implode(", ", $highagedata) . "\n";

}
if (file_put_contents($file_1, $new_data_1) !== false) {
    echo "File Write Sucessfully";
} else {
    echo "Some Error in File Write";
}
foreach ($emp_retirement as $highagedata) {
    $new_data_2 .= implode(", ", $highagedata) . "\n";

}
if (file_put_contents($file_3, $new_data_2) !== false) {
    echo "File Write Sucessfully";
} else {
    echo "Some Error in File Write";
}