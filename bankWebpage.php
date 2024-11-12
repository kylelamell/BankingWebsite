<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Kyle Lamell">
        <meta name="description" content="This is the banking app user interface">
        <link href="stylesheet.css" rel="stylesheet" type="text/css" media="screen">
        <title>Banking App Landing Page</title>
    </head>
    <body>
        <div class="displayAccountContainer">
            <table>
                <tr>
                    <th>Account</th>
                    <th>Account Type</th>
                    <th>Balance</th>
                </tr>
                <?php include 'accountData.php' ?>
            </table>
        </div>

        <script src="forms.js"></script>
        <div class="dropDown">
            <button onClick="dropDownFormDeposit()" class="dropForm">Deposit</button>
            <div id="depositForm" class="dropDownContent">
                <form name="deposit" enctype="mutipart/form-data" action="bankProcess.php" method="POST" onclick="event.stopPropagation()" onsubmit="closemenu(event)">

                    <label for="userAccount">Which account do you wish to deposit into</label></br>
                    <input type="text" id="account" name="userAccount" value=""><br>

                    <label for="userFunds">Enter the amount you wish to deposit</label></br>
                    <input type="text" id="funds" name="userFunds" value=""><br>

                    <input type="hidden" id="username" name="username" value=<?php echo $_GET["verifiedUsername"] ?>>
                    <input type="hidden" id="deposit" name="userAction" value="Deposit" checked/>
                    <input type="hidden" id="transferAccount" name="userTransferAccount" value="">
                    <input type="hidden" id="otherUsername" name="otherUsername" value="">
                    <input type="hidden" id="otherUserAccount" name="otherUserAccount" value="">
                    <input type="hidden" id="newAccount" name="newAccountName" value=""><br>
                    <input type="hidden" id="checking" name="newAccountType" value="checking" checked>
                    <input type="hidden" id="deleteAccount" name="deleteAccountName" value="">
        
                    <input type="submit" value="Confirm" />
                </form>
            </div>
            

            <button onClick="dropDownFormWithdraw()" class="dropForm">Withdraw</button>
            <div id="withdrawForm" class="dropDownContent">
                <form enctype="mutipart/form-data" action="bankProcess.php" method="POST" onclick="event.stopPropagation()" onsubmit="closemenu(event)">

                    <label for="userAccount">Which account do you wish to withdraw from</label></br>
                    <input type="text" id="account" name="userAccount" value=""><br>

                    <label for="userFunds">Enter the amount you wish to Withdraw</label></br>
                    <input type="text" id="funds" name="userFunds" value=""><br>

                    <input type="hidden" id="username" name="username" value=<?php echo $_GET["verifiedUsername"] ?>>
                    <input type="hidden" id="withdraw" name="userAction" value="Withdraw" checked/>
                    <input type="hidden" id="transferAccount" name="userTransferAccount" value="">
                    <input type="hidden" id="otherUsername" name="otherUsername" value="">
                    <input type="hidden" id="otherUserAccount" name="otherUserAccount" value="">
                    <input type="hidden" id="newAccount" name="newAccountName" value=""><br>
                    <input type="hidden" id="checking" name="newAccountType" value="checking" checked>
                    <input type="hidden" id="deleteAccount" name="deleteAccountName" value="">
        
                    <input type="submit" value="Confirm" />
                </form>
            </div>

            <button onClick="dropDownFormTransfer()" class="dropForm">Transfer</button>
            <div id="transferForm" class="dropDownContent">
                <form enctype="mutipart/form-data" action="bankProcess.php" method="POST" onclick="event.stopPropagation()" onsubmit="closemenu(event)">

                    <label for="userAccount">Which account do you wish to transfer from</label></br>
                    <input type="text" id="account" name="userAccount" value=""><br>

                    <label for="userTransferAccount">Which account do you wish to transfer to</label><br>
                    <input type="text" id="transferAccount" name="userTransferAccount" value=""><br>

                    <label for="userFunds">Enter the amount you wish to transfer</label></br>
                    <input type="text" id="funds" name="userFunds" value=""><br>

                    <input type="hidden" id="username" name="username" value=<?php echo $_GET["verifiedUsername"] ?>>
                    <input type="hidden" id="transfer" name="userAction" value="Transfer" checked/>
                    <input type="hidden" id="otherUsername" name="otherUsername" value="">
                    <input type="hidden" id="otherUserAccount" name="otherUserAccount" value="">
                    <input type="hidden" id="newAccount" name="newAccountName" value="">
                    <input type="hidden" id="checking" name="newAccountType" value="checking" checked>
                    <input type="hidden" id="deleteAccount" name="deleteAccountName" value="">
        
                    <input type="submit" value="Confirm" />
                </form>
            </div>

            <button onClick="dropDownFormWireTransfer()" class="dropForm">Wire Transfer</button>
            <div id="wireTransferForm" class="dropDownContent">
                <form enctype="mutipart/form-data" action="bankProcess.php" method="POST" onclick="event.stopPropagation()" onsubmit="closemenu(event)">

                    <label for="userAccount">Which account do you wish to transfer from</label></br>
                    <input type="text" id="account" name="userAccount" value=""><br>

                    <label for="otherUsername">Enter target users username</label></br>
                    <input type="text" id="otherUsername" name="otherUsername" value=""><br>
                    <label for="otherUserAccount">Enter target users account name</label></br>
                    <input type="text" id="otherUserAccount" name="otherUserAccount" value=""><br>

                    <label for="userFunds">Enter the amount you wish to transfer</label></br>
                    <input type="text" id="funds" name="userFunds" value=""><br>

                    <input type="hidden" id="username" name="username" value=<?php echo $_GET["verifiedUsername"] ?>>
                    <input type="hidden" id="wireTransfer" name="userAction" value="WireTransfer" checked/>
                    <input type="hidden" id="transferAccount" name="userTransferAccount" value="">
                    <input type="hidden" id="newAccount" name="newAccountName" value="">
                    <input type="hidden" id="checking" name="newAccountType" value="checking" checked>
                    <input type="hidden" id="deleteAccount" name="deleteAccountName" value="">
        
                    <input type="submit" value="Confirm" />
                </form>
            </div>

            <button onClick="dropDownFormCreateNewAccount()" class="dropForm">Create New Account</button>
            <div id="createNewAccountForm" class="dropDownContent">
                <form enctype="mutipart/form-data" action="bankProcess.php" method="POST" onclick="event.stopPropagation()" onsubmit="closemenu(event)">

                    <label for="newAccountName">Enter the name for your new account</label><br>
                    <input type="text" id="newAccount" name="newAccountName" value=""><br>
                    <input type="radio" id="checking" name="newAccountType" value="checking" checked>
                    <label for="checking">Checking</label><br>
                    <input type="radio" id="withdraw" name="newAccountType" value="savings">
                    <label for="savings">Savings</label><br>

                    <input type="hidden" id="username" name="username" value=<?php echo $_GET["verifiedUsername"] ?>>
                    <input type="hidden" id="createAccount" name="userAction" value="CreateNewAccount" checked/>
                    <input type="hidden" id="funds" name="userFunds" value="">
                    <input type="hidden" id="account" name="userAccount" value="">
                    <input type="hidden" id="transferAccount" name="userTransferAccount" value="">
                    <input type="hidden" id="otherUsername" name="otherUsername" value="">
                    <input type="hidden" id="otherUserAccount" name="otherUserAccount" value="">
                    <input type="hidden" id="deleteAccount" name="deleteAccountName" value="">
        
                    <input type="submit" value="Confirm" />
                </form>
            </div>

            <button onClick="dropDownFormDeleteAccount()" class="dropForm">Delete Account</button>
            <div id="deleteAccountForm" class="dropDownContent">
                <form enctype="mutipart/form-data" action="bankProcess.php" method="POST" onclick="event.stopPropagation()" onsubmit="closemenu(event)">

                    <label for="deleteAccountName">Enter the account you want to delete</label><br>
                    <input type="text" id="deleteAccount" name="deleteAccountName" value=""><br>

                    <input type="hidden" id="username" name="username" value=<?php echo $_GET["verifiedUsername"] ?>>
                    <input type="hidden" id="deleteAccount" name="userAction" value="DeleteAccount" checked/>
                    <input type="hidden" id="funds" name="userFunds" value="">
                    <input type="hidden" id="account" name="userAccount" value="">
                    <input type="hidden" id="transferAccount" name="userTransferAccount" value="">
                    <input type="hidden" id="otherUsername" name="otherUsername" value="">
                    <input type="hidden" id="otherUserAccount" name="otherUserAccount" value="">
        
                    <input type="submit" value="Confirm" />
                </form>
            </div>
        </div>
        <div>
            <?php 
            $errorMessage = $_GET["errorMessage"];
            echo '<p>' . $errorMessage . '</p>';
            ?>
        </div>
        <div>
            <a href="bankLogin.html">return to login</a><br>
        </div>
    </body>
</html>
