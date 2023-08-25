<?php
$emp_details = file_get_contents('salaries.json');
$emp_details = json_decode($emp_details, true);



$max_salary = [];
$salary = [];
$max_sal = 0;
$max_sal_emp_details = [];
$min_sal_emp_details = [];
$sw_less10 = [];
$sw_ageG60 = [];
print_r('Number of Employees::' . count($emp_details) . PHP_EOL);
foreach ($emp_details as $emp_detail) {
    foreach ($emp_detail as $key => $value) {
        if ($key == 'Name') {
            $name = $value;
        } elseif ($key == 'Age') {
            $age = $value;
        } elseif ($key == 'Salary') {
            $salary = $value;
            if ($value > $max_sal) {
                $max_sal = $value;
                $max_sal_emp_details = array(
                    'name' => $name,
                    'Salary' => $max_sal,
                    'Age' => $age

                );
            } elseif ($value < $max_sal) {
                $min_sal = $value;
                $min_sal_emp_details = array(
                    'name' => $name,
                    'Salary' => $min_sal,
                    'Age' => $age

                );
            }
        } elseif ($key == 'Job') {
            $salary = $emp_detail['Salary'];
            $age = $emp_detail['Age'];
            if (trim(strtolower($value)) == 'software engineer') {
                if ($salary <= 10000) {
                    $sw_less10[] = array(
                        'name' => $name,
                        'Salary' => $salary,
                        'Age' => $age,
                        'Job' => $value
                    );
                }
                if ($age >= 60) {
                    $sw_ageG60[] = array(
                        'name' => $name,
                        'Salary' => $salary,
                        'Age' => $age,
                        'Job' => $value
                    );
                }
            }

        }
    }
}

foreach ($sw_ageG60 as &$sw_data) {
    if ($sw_data['Age'] >= 60) {
        $sw_data['Salary'] *= 1.15;
        $sw_data['Salary'] = intval($sw_data['Salary']);
    }
}
unset($sw_data);

/*print_r('Min salary::' . PHP_EOL);
print_r(json_encode($min_sal_emp_details) . PHP_EOL);
print_r('Max salary::' . PHP_EOL);
print_r(json_encode($max_sal_emp_details). PHP_EOL);
print_r('SE with salary<10K::' . PHP_EOL);*/
//print_r(json_encode($sw_less10));
print_r(json_encode($sw_ageG60));