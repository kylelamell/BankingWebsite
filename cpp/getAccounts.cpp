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

int main(int argc, char* argv[]) {

    string username = argv[1];

    string filename = "User_" + username + ".txt";

    vector<bankAccount> bankAccounts;
    readAccountsFromFile(filename, bankAccounts);

    for (int i = 0; i < bankAccounts.size(); i++) {
        if (i != bankAccounts.size() - 1) {
            cout << bankAccounts[i].accountName << ":" << bankAccounts[i].accountType << ":" << bankAccounts[i].accountBalance << ",";
        }
        else {
            cout << bankAccounts[i].accountName << ":" << bankAccounts[i].accountType << ":" << bankAccounts[i].accountBalance;
        }
    }
    
    return 0;
}