<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Kyle Lamell">
        <meta name="description" content="Kyle Lamell">
    </head>
    <body>
        <header>
            <h1>this is the bankLogin.php page</h1>
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

        $username = $_POST["username"];
        $username = formatInput($username);

        echo "these are the user inputs" . '<br>';
        echo "username: " . $username . '<br>';
        
        $temp_directory = "mytemp";
        $command_mkdir = escapeshellcmd("mkdir " . $temp_directory);
        $output_mkdir = shell_exec($command_mkdir);

        $command_cp_iu = escapeshellcmd("cp /users/k/l/klamell/www-root/cs2300/M3OEP/cpp/isUser.cpp " . $temp_directory);
        $output_cp_iu = shell_exec($command_cp_iu);

        $output_iu = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o isUser.exe isUser.cpp;./isUser.exe " . $username . ";cd ..");

        array_map("unlink", glob($temp_directory . "/*"));
        rmdir($temp_directory);

        $returnedValues = explode(";", $output_iu);
        $isUser = $returnedValues[0];
        $errorMessage = $returnedValues[1];

        if ($isUser == "True") {
            header("Location: bankWebpage.php?verifiedUsername=" . $username);
        }
        elseif ($isUser == "False") {
            header("Location: bankLogin.html?errorMessage=" . urlencode($errorMessage));
        }
        else {
            echo "(" . $output_iu . ")" .'<br>';
            echo "There was an error please close the window" . '<br>';
        }
        ?>
    </body>
</html>
