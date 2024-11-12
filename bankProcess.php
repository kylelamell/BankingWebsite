<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Kyle Lamell">
        <meta name="description" content="Kyle Lamell">
    </head>
    <body>
        <header>
            <h1>this is the bankProcess.php page</h1>
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

        function validInput($username, $userAction) {
            if ($username == "" || (($userAction != "Deposit") && ($userAction != "Withdraw") && ($userAction != "Transfer") && ($userAction != "WireTransfer") && ($userAction != "CreateNewAccount") && ($userAction != "DeleteAccount"))) {
                return False;
            }
            else {
                return True;
            }
        }

        $username = $_POST["username"];
        $userAction = $_POST["userAction"];
        $userFunds = $_POST["userFunds"];
        $userAccount = $_POST["userAccount"];
        $userTransferAccount = $_POST["userTransferAccount"];
        $otherUsername = $_POST["otherUsername"];
        $otherUserAccount = $_POST["otherUserAccount"];
        $newAccountName = $_POST["newAccountName"];
        $newAccountType = $_POST["newAccountType"];
        $deleteAccountName = $_POST["deleteAccountName"];

        $username = formatInput($username);
        $userAccount = formatInput($userAccount);
        $userTransferAccount = formatInput($userTransferAccount);
        $otherUsername = formatInput($otherUsername);
        $otherUserAccount = formatInput($otherUserAccount);
        $newAccountName = formatInput($newAccountName);
        $deleteAccountName = formatInput($deleteAccountName);

        if (!validInput($username, $userAction)) {
            echo "Something went wrong and I dont know what";
        }
        else {
            $temp_directory = "mytemp";
            $command_mkdir = escapeshellcmd("mkdir " . $temp_directory);
            $output_mkdir = shell_exec($command_mkdir);

            if ($userAction == "Deposit") {
                $command_cp_d = escapeshellcmd("cp /users/k/l/klamell/www-root/cs2300/M3OEP/cpp/deposit.cpp " . $temp_directory);
                $output_cp_d = shell_exec($command_cp_d);
                $output_d = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o deposit.exe deposit.cpp;./deposit.exe " . $username . " " . $userAccount . " " . $userFunds . ";cd ..");
                $outputData = explode(";", $output_d);
            }
            elseif ($userAction == "Withdraw") {
                $command_cp_w = escapeshellcmd("cp /users/k/l/klamell/www-root/cs2300/M3OEP/cpp/withdraw.cpp " . $temp_directory);
                $output_cp_w = shell_exec($command_cp_w);
                $output_w = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o withdraw.exe withdraw.cpp;./withdraw.exe " . $username . " " . $userAccount . " " . $userFunds . ";cd ..");
                $outputData = explode(";", $output_w);
            }
            elseif ($userAction == "Transfer") {
                $command_cp_t = escapeshellcmd("cp /users/k/l/klamell/www-root/cs2300/M3OEP/cpp/transfer.cpp " . $temp_directory);
                $output_cp_t = shell_exec($command_cp_t);
                $output_t = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o transfer.exe transfer.cpp;./transfer.exe " . $username . " " . $userAccount . " " . $userFunds . " " . $userTransferAccount . ";cd ..");
                $outputData = explode(";", $output_t);
            }
            elseif ($userAction == "WireTransfer") {
                $command_cp_wt = escapeshellcmd("cp /users/k/l/klamell/www-root/cs2300/M3OEP/cpp/wireTransfer.cpp " . $temp_directory);
                $output_cp_wt = shell_exec($command_cp_wt);
                $output_wt = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o wireTransfer.exe wireTransfer.cpp;./wireTransfer.exe " . $username . " " . $userAccount . " " . $userFunds . " " . $otherUsername . " " . $otherUserAccount . ";cd ..");
                $outputData = explode(";", $output_wt);
            }
            elseif ($userAction == "CreateNewAccount") {
                $command_cp_cna = escapeshellcmd("cp /users/k/l/klamell/www-root/cs2300/M3OEP/cpp/createNewAccount.cpp " . $temp_directory);
                $output_cp_cna = shell_exec($command_cp_cna);
                $output_cna = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o createNewAccount.exe createNewAccount.cpp;./createNewAccount.exe " . $username . " " . $newAccountName . " " . $newAccountType . ";cd ..");
                $outputData = explode(";", $output_cna);
            }
            elseif ($userAction == "DeleteAccount") {
                $command_cp_da = escapeshellcmd("cp /users/k/l/klamell/www-root/cs2300/M3OEP/cpp/deleteAccount.cpp " . $temp_directory);
                $output_cp_da = shell_exec($command_cp_da);
                $output_da = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o deleteAccount.exe deleteAccount.cpp;./deleteAccount.exe " . $username . " " . $deleteAccountName . ";cd ..");
                $outputData = explode(";", $output_da);
            }

            array_map("unlink", glob($temp_directory . "/*"));
            rmdir($temp_directory);
        }

        $errorMessage = $outputData[1];

        header("Location: bankWebpage.php?verifiedUsername=" . $username . "&errorMessage=" . $errorMessage);

        ?>
    </body>
</html>
