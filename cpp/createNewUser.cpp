#include <string>
#include <iostream>
#include <fstream>
#include <vector>

using std::string;
using std::cout;
using std::endl;
using std::ifstream;
using std::ofstream;
using std::vector;
using std::stof;

struct bankAccount {
    string accountName;
    string accountType;
    double accountBalance;
    string accountAge;
    double accountInterest;
};

void eraseNewline(string &myString) {
    char last = myString.back();
    if(!isalnum(last)) {
        myString.erase(myString.length()-1);
    }
}

void readUsersFromFile(vector<string> &users) {
    ifstream inFile("/users/k/l/klamell/www-root/cs2300/M3OEP/users/User.txt");

    string username;
    int numAccounts;

    string newline;
    if (inFile) {
        inFile >> numAccounts;
        getline(inFile, newline);
    }

    int currAccount = 0;
    while (inFile && currAccount != numAccounts) {
        currAccount += 1;
        getline(inFile, username);
        eraseNewline(username);
        users.push_back(username);
    }
    inFile.close();
}

void writeUsersToFile(vector<string> &users) {
    ofstream myFile("/users/k/l/klamell/www-root/cs2300/M3OEP/users/User.txt");

    myFile << users.size() << "\n";

    for (int i = 0; i < users.size(); i++) {
        myFile << users[i] << "\n";
    }
    myFile.close();
}

void readAccountsFromFile(string &filename, vector<bankAccount> &bankAccounts) {
    ifstream inFile("/users/k/l/klamell/www-root/cs2300/M3OEP/users/" + filename);

    string username;
    int numAccounts = 0;

    string newline;
    if (inFile) {
        getline(inFile,username);
        inFile >> numAccounts;
        getline(inFile, newline);
    }

    eraseNewline(username);

    bankAccount tempAccount;

    string accountName;
    string accountType;
    double accountBalance;
    string accountAge;
    string accountInterestString;
    double accountInterest;

    int currAccount = 0;
    while (inFile && currAccount != numAccounts) {
        currAccount += 1;
        getline(inFile, accountName);
        getline(inFile, accountType);
        inFile >> accountBalance;
        getline(inFile, newline);
        getline(inFile, accountAge);
        inFile >> accountInterest;
        getline(inFile, newline);

        eraseNewline(accountName);
        eraseNewline(accountType);
        eraseNewline(accountAge);

        tempAccount.accountName = accountName;
        tempAccount.accountType = accountType;
        tempAccount.accountBalance = accountBalance;
        tempAccount.accountAge = accountAge;
        tempAccount.accountInterest = accountInterest;

        bankAccounts.push_back(tempAccount);
    }
    inFile.close();
}

void writeAccountToFile(string &filename, string &username, vector<bankAccount> &bankAccounts) {
    ofstream myFile("/users/k/l/klamell/www-root/cs2300/M3OEP/users/" + filename);

    myFile << username << "\n";
    myFile << bankAccounts.size() << "\n";

    for (int i = 0; i < bankAccounts.size(); i++) {
        myFile << bankAccounts[i].accountName << "\n";
        myFile << bankAccounts[i].accountType << "\n";
        myFile << bankAccounts[i].accountBalance << "\n";
        myFile << bankAccounts[i].accountAge << "\n";
        myFile << bankAccounts[i].accountInterest << "\n";
    }
    myFile.close();
}

int main(int argc, char* argv[]) {

    string newUsername = argv[1];
    string newAccountName = argv[2];
    string newAccountType = argv[3];

    string filename = "User_" + newUsername + ".txt";

    vector<string> users;
    readUsersFromFile(users);

    bool foundUser = false;
    for (int i = 0; i < users.size(); i++) {
        if (users[i] == newUsername) {
            foundUser = true;
        }
    }
    
    if (foundUser) {
        cout << "False;Username already in use";
    }
    else {
        users.push_back(newUsername);
        writeUsersToFile(users);

        vector<bankAccount> bankAccounts;
        bankAccount newBankAccount;

        time_t timestamp;
        time(&timestamp);
        string newAccountAge = ctime(&timestamp);
        eraseNewline(newAccountAge);

        newBankAccount.accountName = newAccountName;
        newBankAccount.accountType = newAccountType;
        newBankAccount.accountBalance = 0;
        newBankAccount.accountAge = newAccountAge;

        if (newAccountType == "checking") {
            newBankAccount.accountInterest = 0;
        }
        else if (newAccountType == "savings") {
            newBankAccount.accountInterest = 0.05;
        }
        

        bankAccounts.push_back(newBankAccount);

        writeAccountToFile(filename, newUsername, bankAccounts);

        cout << "True;You have successfully created an account!";
    }
    
    return 0;
}