<?php
$emp_details = file_get_contents('salaries.json');
$emp_details = json_decode($emp_details, true);


$max_salary = [];
$salary = [];
$max_sal = 0;
$max_sal_emp_details = [];
$min_sal_emp_details = [];
print_r('Number of Employees::' . count($emp_details) . PHP_EOL);
foreach ($emp_details as $emp_detail) {
    foreach ($emp_detail as $key => $value) {
        if ($key == 'Name') {
            $name = $value;
        } elseif ($key == 'Age') {
            $age = $value;
        } elseif ($key == 'Salary') {
            $salary[] = $value;
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
        }
    }
}
print_r('Min salary::' . PHP_EOL);
print_r(json_encode($min_sal_emp_details) . PHP_EOL);
print_r('Max salary::' . PHP_EOL);
print_r(json_encode($max_sal_emp_details));
