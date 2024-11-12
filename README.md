# CS 2300 Module 3 Open-Ended Project: Bank Accounts

**Kyle Lamell**

# Program Objective
This project is a banking application that allows users to 
interact with their bank accounts by depositing, withdrawing, 
transferring, wire transferring, creating new account, and 
deleting accounts. 

The banking application is builds on my previous projects with 
improvements to user experience. It accomplishes this by changing the user input from being in the cLion terminal to a functional website. 

The programming languages used in this project are: c++, html, php, and javascript. The html programs and bankWebpage.php will be the modem of user input. The other php programs will serve to process the user input from these pages and call the correct c++ programs. The intention behind 
this is to have the actual process' of the banks webpages obscured from 
the user by having server side php script. The php programs* will be able to call the c++ programs from the command line giving values from user 
input and receiving their outputs. The javascript functionality will just 
be scripts that extend the functionality of the html and php programs to 
be more dynamic.

\* the exception being bankWebpage.php

## Text files
I should mention before anything else that users information is stored 
alongside the other files in its own directory (\users). So when I mention 
that a users account information is changed or accessed, I mean that the 
cpp program have interacted with these files and output a result from 
their interaction.
- User.txt holds the usernames of all the users, allowing for verification 
that a specific username exists.
- User_\<username\>.txt holds a users account information including number 
of account, account names, account types, account balances, account 
creation dates, and interest rates.
- currently there are three testing users

## C++
I am choosing to keep the majority of the program in c++ so that I can utilise the 
effectiveness of OOP and keep the speed of c++. I also wanted to utilise my previous 
project without completely rebasing it into another language, which would have taken forever.

All the backend computations are done with c++ programs. This will be the deposit, withdraw,
transfer, wire transfer, create new account, create new user, is account, is user, and get accounts.



## HTML / CSS
I want to choose HTML / CSS for the user input due to the ease that it provides when trying to 
create a user-friendly environment. It will also allow my to validate the user input a little easier, 
since it can be done on the webpage before it gets sent to the c++ program. Additionally, using 
HTML / CSS will allow for the program to function more similarly to a banking application, where the 
user usually interacts with a graphical interface (website, phone app).

## PHP
This will be the connection between HTML and the C++ programs. I am choosing php because of its ease to 
implement with HTML, and it is easy to connect with c++. It will also obscure the actual processes from the 
user since the php code is executed server side.


## JavaScript
This is needed to handle some more complex functions in the html. We can create drop down menus for the user 
actions which each have their own form. I chose javascript for this since it is easy to integrate with html 
as it is a staple in web development.


# Known Bugs
- The only bug I was able to catch was that when interacting 
with the action forms on bankWebpage.php (deposit, withdraw, 
etc.), the forms do not disappear when clicking another form. 
But they will disappear when clicking anything else. This bug is 
purely visual and just causes the forms to overlay on each-other. 
It is fixed by simply clicking the button for the form you want 
to go away.

# Resources
JAVASCRIPT DROPDOWN MENU (forms.js)
- https://www.w3schools.com/howto/howto_js_dropdown.asp
