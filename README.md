# CS 2300 Module 3 Open-Ended Project: Bank Accounts

**Kyle Lamell**

# Program Objective
This project is a banking application that allows users to 
interact with their bank accounts by depositing, withdrawing, 
transfering, wire transfering, creating new account, and 
deleting accounts. 

The banking application is builds on my previous projects with 
imporovements to user experience. It accomplishes this by changing the user input from being in the cLion terminal to a functional website. 

The programming languages used in this project are: c++, html, php, and javascript. The html programs and bankWebpage.php will be the modem of user input. The other php programs will serve to process the user input from these pages and call the correct c++ programs. The intention behind 
this is to have the actual process' of the banks webpages obscured from 
the user by having server side php script. The php programs* will be able to call the c++ programs from the command line giving values from user 
input and recieving their outputs. The javascript functionality will just 
be scripts that extend the functionality of the html and php programs to 
be more dynamic.

\* the exception being bankWebpage.php.

## Text files
I should mention before anything else that users information is stored 
alongside the other files in its own directory (\users). So when I mention 
that a users account information is changed or accessed, I mean that the 
cpp program have interacted with these files and output a result from 
their interaction.
- User.txt holds the usernames of all the users, allowing for verification 
that a specific username exists.
- User_\<username\>.txt holds a users account information including number 
of account, account names, account types, accoutn balances, account 
creation dates, and interest rates.

## C++
I am choosing to keep the majority of the program in c++ so that I can utilise the 
effectiveness of OOP and keep the speed of c++. I also wanted to utilise my previous 
project without completely rebasing it into another language, which would have taken forever.
### deposit.cpp
Deposits funds into the users account
- takes in the users username, account name, and funds to deposit
### withdraw.cpp
Withdraws funds from a users account
- takes in the users username, account name, and funds to withdraw
### transfer.cpp
Transfers funds between two of the users accounts
- takes in the users username, account name to transfer from, funds to transfer, and account name to transfer to
- cannot transfer to the same account
### wireTransfer.cpp
Tramsfer funds between the users account and a target users account
- takes in the users username, account name, funds to transfer, the target users username, and the target users account name
- the transfer only deposits into another users account
### createNewAccount.cpp
Creates a new account for the user
- takes in the users username, new account name, and new account type
### createNewUser.cpp
Creates a new user and forces them to make an account
- takes in the new users username, new account name, new account type
### deleteAccount.cpp
Delete a users account
- takes in the users username, and account name tp be deleted
### getAccounts.cpp
Returns the users accoutn along with their balances
- takes in the users username
### isAccount.cpp
Returns true or false depending if an account exists or not. This
is used when the user is tryin to create an account.
- takes in the users username, and account name to be checked
### isUser.cpp
Returns true or false depening if a user is using a username or not. User when creating an account.
- take in a username

## HTML / CSS
I want to choose HTML / CSS for the user input due to the ease that it provides when trying to 
create a user friendly enviornment. It will also allow my to validate the user input a little easier, 
since it can be done on the webpage before it gets sent to the c++ program. Additionally, using HTML / CSS will allow for the program to function more similarly to an banking application, where the 
user usually interacts with a grpahical interface (website, phone app).
### bankLogin.html
This is the page that users start on, it contains a submission 
form to log the user in. Also links to the create new user page.
### bankNewUser.html
This is the pae that allows users to create an account. It
contains a form that allows the user to create an account.

## PHP
This will be the connection between HTML and the C++ programs. I am choosing php because of its ease to 
implement with HTML and it is easy to connect with c++. It will also obscure the actual processes from the 
user since the php code is executed server side.

### bankWebpage.php
This is the landing page for the banking app, once the user for
once the user has logged in. It displays the users accounts 
information and allows them to deposit, withdraw, transfer, 
wire transfer, create an account, or delete an account. This was 
suppossed to be an html program but the needs such as ensuring 
that username was valid required some php, and converting to a 
php program was easier.
### bankLogin.php
This is the backend of bankLogin.html. It 
verifies that the username given by the user exists, then will 
either boot them back to bankLogin.html or pass them to 
bankWebpage.php. This action was the reason why bankWebpage.php 
needed to be php, in order to pass the username so that 
bankWebpage could automatically display the user account 
information, it needed to be a php script.
### accountData.php
This is a helper script for bankWebpage.php to minimize the 
amount of inline php. It creates an element to display the users
accounts information such as the account name, account type, and 
account balance.
### bankCreateNewUser.php
This is the back end of bankNewUser.html. It verifies that the username is not in use and either displays that the username 
is already used or passes them back to bankLogin.html and 
displays that the account was created.
### bankProcess.php
This is the back end of bankWebpage.php. It takes the users 
action and other relevant information and calls the correct cpp 
program. It will then redirect the user back to bankWebpage.php 
along with any error messages generated from the cpp programs.

## JavaScript
This is needed to handle some more complex functions in the html. We can create drop down menus for the user 
actions which each have their own form. I chose java script for this since it is easy to integrate with html 
as it is a staple in web developement.

### forms.js
This is more of a helper program so that the user doesnt have to 
look at every form at the same time. It allows bankWebpage.php to
hide forms that are not in use.
 - note that this has a bug that I was not able to hammer out.

# Bugs
- The only bug I was able to catch was that when interacting 
with the action forms on bankWebpage.php (deposit, withdraw, 
etc.), the forms do not disappear when clicking another form. 
But they will disappear when clicking anything else. This bug is 
purely visual and just causes the forms to overlay on eachother. 
It is fixed by simply clicking the button for the form you want 
to go away.

# Citations
JAVASCRIPT DROPDOWN MENU (forms.js)
- https://www.w3schools.com/howto/howto_js_dropdown.asp
