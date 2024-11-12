#include <string>
#include <iostream>
#include <fstream>
#include <vector>
#include <ctime>

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

void readAccountsFromFile(string &filename, vector<bankAccount> &bankAccounts) {
    // TODO: Change <PATH_TO_users>
    ifstream inFile("<PATH_TO_users>" + filename);

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
    // TODO: Change <PATH_TO_users>
    ofstream myFile("<PATH_TO_users>" + filename);

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

    string username = argv[1];
    string newAccountName = argv[2];
    string newAccountType = argv[3];

    string filename = "User_" + username + ".txt";

    vector<bankAccount> bankAccounts;
    readAccountsFromFile(filename, bankAccounts);

    bool isValidAccountName = true;
    for (int i = 0; i < bankAccounts.size(); i++) {
        if (bankAccounts[i].accountName == newAccountName) {
            isValidAccountName = false;
        }
    }

    if (isValidAccountName) {
        time_t timestamp;
        time(&timestamp);
        string newAccountAge = ctime(&timestamp);
        eraseNewline(newAccountAge);

        bankAccount newBankAccount;
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

        writeAccountToFile(filename, username, bankAccounts);

        cout << "True;";
    }
    else {
        cout << "False;cannot create new account: account name already is use";
    }

    return 0;
}