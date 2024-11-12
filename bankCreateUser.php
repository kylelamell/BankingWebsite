<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Kyle Lamell">
        <meta name="description" content="Kyle Lamell">
    </head>
    <body>
        <header>
            <h1>this is the bankCreateUser.php page</h1>
        </header>
        
        <?php

        function formatInput($userInput) {
            if ($userInput == "") {
                return "null";
            }
            else {
                $returnVar = str_replace(" ", "_", $userInput);
                return $returnVar;
            }
        }

        $newUsername = $_POST["newUsername"];
        $newUsername = formatInput($newUsername);

        $newAccountName = $_POST["newAccountName"];
        $newAccountName = formatInput($newAccountName);

        $newAccountType = $_POST["newAccountType"];
        
        $temp_directory3 = "mytemp3";
        $command_mkdir = escapeshellcmd("mkdir " . $temp_directory3);
        $output_mkdir = shell_exec($command_mkdir);

        // TODO: change <PATH_TO_isUser.cpp>
        $command_cp_iu = escapeshellcmd("cp <PATH_TO_isUser.cpp> " . $temp_directory3);
        $output_cp_iu = shell_exec($command_cp_iu);

        $output_iu = shell_exec("cd " . $temp_directory3 . ";g++ -std=c++1y -o isUser.exe isUser.cpp;./isUser.exe " . $newUsername . ";cd ..");

        $returnedValidationValues = explode(";", $output_iu);
        $isUser = $returnedValidationValues[0];
        $errorMessage = $returnedValidationValues[1];

        if ($isUser == "True") {
            header("Location: bankNewUser.html?errorMessage=" . urlencode($errorMessage));
        }
        elseif ($isUser == "False") {
            $filename = "User_" . $newUsername . ".txt";
            $command_mkfile = escapeshellcmd("cd users;echo " . $newUsername . " > " . $filename . ";echo '0' >> " . $filename . ";cd ..");
            $output_mkfile = shell_exec($command_mkfile);

            // TODO: change PATH_TO_<createNewUser.cpp>
            $command_cp_cnu = escapeshellcmd("cp PATH_TO_<createNewUser.cpp> " . $temp_directory3);
            $output_cp_cnu = shell_exec($command_cp_cnu);

            $output_cnu = shell_exec("cd " . $temp_directory3 . ";g++ -std=c++1y -o createNewUser.exe createNewUser.cpp;./createNewUser.exe " . $newUsername . " " . $newAccountName . " " . $newAccountType . ";cd ..");

            $returnedValues = explode(";", $output_cnu);
            $isCreated = $returnedValues[0];
            $stateMessage = $returnedValues[1];

            if ($isCreated == "True") {
                header("Location: bankLogin.html?stateMessage=" . urlencode($stateMessage));
            }
            elseif ($isCreated == "False") {
                header("Location: bankNewUser.html?errorMessage=" . urlencode($stateMessage));
            }
            else {
                echo "(" . $output_cnu . ")" .'<br>';
                echo "There was an createing the user error please close the window" . '<br>';
            }
        }
        else {
            echo "(" . $output_iu . ")" .'<br>';
            echo "There was an error please close the window" . '<br>';
        }

        array_map("unlink", glob($temp_directory3 . "/*"));
        rmdir($temp_directory3);
        ?>
    </body>
</html>
