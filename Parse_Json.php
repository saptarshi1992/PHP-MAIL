<?php
//$author_names = file_get_contents('name.txt');
$students_records = file_get_contents('student-scores.json');
$students_records_de = json_decode($students_records, TRUE);
$absance_day = 0;
$student_details = [];

//print_r($students_records_de);
foreach ($students_records_de as $student_record) {
    foreach ($student_record as $key => $value) {
        if ($key == 'id') {
            $id = $value;

        } elseif ($key == 'first_name') {
            $first_name = $value;
        } elseif ($key == 'last_name') {
            $last_name = $value;
        } elseif ($key == 'email') {
            $email = $value;
        } elseif ($key == 'absence_days') {
            if ($value > $absance_day) {
                $absance_day = $value;
                $student_details = array(
                    'id' => $id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'absance_day' => $absance_day
                );
            }
        }
    }

}
print_r(json_encode($student_details));

/*$auth_name = [];
$set = [];
$author_names = explode("\n", $author_names);
foreach ($author_names as $name) {
    $auth_split = explode(' ', $name);
    if (count($auth_split) == 2) {
        $first_name = $auth_split[0];
        $first_name = strtoupper($first_name[0]);
        $last_name = $auth_split[1];
        $auth_name = $first_name . '.' . $last_name;
    } elseif (count($auth_split) == 3) {
        $first_name = $auth_split[0];
        $first_name = strtoupper($first_name[0]);
        $mid_name = $auth_split[1];
        $mid_name = strtoupper($mid_name[0]);
        $last_name = $auth_split[count($auth_split) - 1];
        $auth_name = $first_name . '.' . $mid_name . '.' . $last_name;
    }
    $set .= $auth_name . PHP_EOL;

}

print_r($set);*/

?>