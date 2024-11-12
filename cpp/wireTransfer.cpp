#include <string>
#include <iostream>
#include <fstream>
#include <vector>;

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
    string userAccount = argv[2];
    double userFunds = stof(argv[3]);
    string otherUsername = argv[4];
    string otherUserAccount = argv[5];

    string filename = "User_" + username + ".txt";
    string otherFilename = "User_" + otherUsername + ".txt";

    cout << "<p>Wire Transfer: " << username << ", " << "(" << userAccount << ")" << ", " << userFunds << ", " << otherUsername << ", " << "(" << otherUserAccount << ")" << "</p>" << endl;

    vector<bankAccount> bankAccounts;
    readAccountsFromFile(filename, bankAccounts);
    vector<bankAccount> otherBankAccounts;
    readAccountsFromFile(otherFilename, otherBankAccounts);

    bool foundAccount = false;
    int accountIndex;
    for (int i = 0; i < bankAccounts.size(); i++) {
        if (bankAccounts[i].accountName == userAccount) {
            foundAccount = true;
            accountIndex = i;
        }
    }

    bool foundOtherAccount = false;
    int otherAccountIndex;
    for (int i = 0; i < otherBankAccounts.size(); i++) {
        if (otherBankAccounts[i].accountName == otherUserAccount) {
            foundOtherAccount = true;
            otherAccountIndex = i;
        }
    }

    if (foundAccount && foundOtherAccount) {
        bankAccounts[accountIndex].accountBalance -= userFunds;
        otherBankAccounts[otherAccountIndex].accountBalance += userFunds;

        writeAccountToFile(filename, username, bankAccounts);
        writeAccountToFile(otherFilename, otherUsername, otherBankAccounts);
        
        cout << "True;";
    }
    else {
        if (!foundAccount) {
            cout << "False;cannot wire transfer: account not found";
        }
        else if (!foundOtherAccount) {
            cout << "False;cannot wire transfer: error processing request";
        }
        else {
            cout << "False;cannot wire transfer: error processing request";
        }
    }
    return 0;
}