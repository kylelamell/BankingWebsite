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
                // TODO: Change <PATH_TO_deposit.cpp>
                $command_cp_d = escapeshellcmd("cp <PATH_TO_deposit.cpp> " . $temp_directory);
                $output_cp_d = shell_exec($command_cp_d);
                $output_d = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o deposit.exe deposit.cpp;./deposit.exe " . $username . " " . $userAccount . " " . $userFunds . ";cd ..");
                $outputData = explode(";", $output_d);
            }
            elseif ($userAction == "Withdraw") {
                // TODO: Change <PATH_TO_withdraw.cpp>
                $command_cp_w = escapeshellcmd("cp <PATH_TO_withdraw.cpp> " . $temp_directory);
                $output_cp_w = shell_exec($command_cp_w);
                $output_w = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o withdraw.exe withdraw.cpp;./withdraw.exe " . $username . " " . $userAccount . " " . $userFunds . ";cd ..");
                $outputData = explode(";", $output_w);
            }
            elseif ($userAction == "Transfer") {
                // TODO: Change <PATH_TO_transfer.cpp>
                $command_cp_t = escapeshellcmd("cp <PATH_TO_transfer.cpp> " . $temp_directory);
                $output_cp_t = shell_exec($command_cp_t);
                $output_t = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o transfer.exe transfer.cpp;./transfer.exe " . $username . " " . $userAccount . " " . $userFunds . " " . $userTransferAccount . ";cd ..");
                $outputData = explode(";", $output_t);
            }
            elseif ($userAction == "WireTransfer") {
                // TODO: Change <PATH_TO_wireTransfer.cpp>
                $command_cp_wt = escapeshellcmd("cp <PATH_TO_wireTransfer.cpp> " . $temp_directory);
                $output_cp_wt = shell_exec($command_cp_wt);
                $output_wt = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o wireTransfer.exe wireTransfer.cpp;./wireTransfer.exe " . $username . " " . $userAccount . " " . $userFunds . " " . $otherUsername . " " . $otherUserAccount . ";cd ..");
                $outputData = explode(";", $output_wt);
            }
            elseif ($userAction == "CreateNewAccount") {
                // TODO: Change <PATH_TO_createNewAccount.cpp>
                $command_cp_cna = escapeshellcmd("cp <PATH_TO_createNewAccount.cpp> " . $temp_directory);
                $output_cp_cna = shell_exec($command_cp_cna);
                $output_cna = shell_exec("cd " . $temp_directory . ";g++ -std=c++1y -o createNewAccount.exe createNewAccount.cpp;./createNewAccount.exe " . $username . " " . $newAccountName . " " . $newAccountType . ";cd ..");
                $outputData = explode(";", $output_cna);
            }
            elseif ($userAction == "DeleteAccount") {
                // TODO: Change <PATH_TO_deleteAccount.cpp>
                $command_cp_da = escapeshellcmd("cp <PATH_TO_deleteAccount.cpp> " . $temp_directory);
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
