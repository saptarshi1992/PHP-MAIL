<?php
/* calculate age from dob
$bday = new DateTime('1992-07-01'); // Your date of birth
$today = new Datetime(date('y-m-d'));
$diff = $today->diff($bday);
print_r('AGE::'.PHP_EOL .$diff->y.'years '.$diff->m.'months'.$diff->d.'days');*/
$student_dataSet = file_get_contents('student-scores.json');
$student_dataSet = json_decode($student_dataSet, TRUE);
$student_info = [];

$student_result_dataset = [];
$count = 0;
foreach ($student_dataSet as $student_data) {

    $first_name = $student_data['first_name'];
    $f_name = strtoupper($first_name[0]);
    //unset($student_data['first_name']);
    $last_name = $student_data['last_name'];
    $l_name = ucfirst($last_name);
    //unset($student_data['last_name']);
    $name = $f_name . '.' . $l_name;
    $student_data['user-name'] = $name;
    // $student_info[] = $student_data;
    if (!filter_var($student_data['email'], FILTER_VALIDATE_EMAIL)) {
        $student_data['remarks'] = 'Check Your Email';
    }
    $math_score = $student_data['math_score'];
    $his_score = $student_data['history_score'];
    $phy_score = $student_data['physics_score'];
    $che_score = $student_data['chemistry_score'];
    $bio_score = $student_data['biology_score'];
    $english_score = $student_data['english_score'];
    $geo_score = $student_data['geography_score'];
    $total_score = $math_score + $his_score + $phy_score + $che_score + $english_score + $bio_score + $geo_score;
    $student_data['total_marks'] = $total_score;
    $science = array(
        'math' => $student_data['math_score'],
        'chemistry' => $student_data['chemistry_score'],
        'physics' => $student_data['physics_score'],
        'biology' => $student_data['biology_score']
    );
    $arts = array(
        'engllish' => $student_data['english_score'],
        'geography' => $student_data['geography_score'],
        'history' => $student_data['history_score']
    );
    $subj_wise_score = array('science-Group' => $science, 'arts-group' => $arts);
    $student_data['score'] = $subj_wise_score;


    $student_info[] = $student_data;
}

array_multisort(array_column($student_info, 'total_marks'), SORT_DESC, $student_info);
print_r(json_encode($student_info));
exit();
foreach ($student_info as $rank_data) {
    if ($rank_data['total_marks'] == $prev_marks) {
        $rank_data['rank'] = $count;
        $student_result_dataset[] = $rank_data;
    } else {
        $rank_data['rank'] = ++$count;
        $student_result_dataset[] = $rank_data;
        $prev_marks = $rank_data['total_marks'];
    }
}
$student_result = [];

foreach ($student_result_dataset as $result) {
    $student_result[$result['rank']] = $result;
}
print_r($student_result);
//print_r(json_encode($student_result_dataset,true));

?>