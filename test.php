<?php
$array = [
    "name" => "",
    "email" => "",
    "gender" => "",
    "job" => "",
    "comment" => ""
];
var_dump($array);

$is_empty = true;
foreach ($array as $key => $value)
    if ($value != '')
        $is_empty = false;

if ($is_empty)
    echo 'array is empty';
else
    echo 'array is not empty';