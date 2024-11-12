<?php

function reformatInput($userInput) {
    if ($userInput == "") {
        return "null";
    }
    else {
        $returnVar = str_replace("_", " ", $userInput);
        return $returnVar;
    }
}

$username = $_GET["verifiedUsername"];

$temp_directory2 = "mytemp2";
$command_mkdir = escapeshellcmd("mkdir " . $temp_directory2);
$output_mkdir = shell_exec($command_mkdir);

// TODO: Change <PATH_TO_getAccounts.cpp>
$command_cp_ga = escapeshellcmd("cp <PATH_TO_getAccounts.cpp> " . $temp_directory2);
$output_cp_ga = shell_exec($command_cp_ga);

$output_ga = shell_exec("cd " . $temp_directory2 . ";g++ -std=c++1y -o getAccounts.exe getAccounts.cpp;./getAccounts.exe " . $username . ";cd ..");

$output_ga = reformatInput($output_ga);

$accountList = explode(",", $output_ga);

foreach ($accountList as $account) {
    echo '<tr>';
    $accountData = explode(":", $account);
    echo '<td>' . $accountData[0] . '</td>';
    echo '<td>' . $accountData[1] . '</td>';
    echo '<td>' . $accountData[2] . '</td>';
    echo '</tr>';
}

array_map("unlink", glob($temp_directory2 . "/*"));
rmdir($temp_directory2);
?>