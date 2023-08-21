<?php
$author_names = file_get_contents('name.txt');
$auth_name = [];
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
        $last_name = $auth_split[count($auth_split)-1];
        $auth_name = $first_name . '.' . $mid_name . '.' . $last_name;
    }
    $set .= $auth_name . PHP_EOL;

}
print_r($set);
?>