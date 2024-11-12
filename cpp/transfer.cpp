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

void writeAccountToFile(string &filename, string &username, vector<bankAccount> & bankAccounts) {
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
    string userTransferAccount = argv[4];

    string filename = "User_" + username + ".txt";

    cout << "<p>Transfer: " << username << ", " << "(" << userAccount << ")" << ", " << userFunds << ", " << "(" << userTransferAccount << ")" << "</p>" << endl;

    vector<bankAccount> bankAccounts;
    readAccountsFromFile(filename, bankAccounts);

    bool foundAccount = false;
    bool foundTransferAccount = false;
    int accountIndex;
    int transferAccountIndex;
    for (int i = 0; i < bankAccounts.size(); i++) {
        if (bankAccounts[i].accountName == userAccount) {
            foundAccount = true;
            accountIndex = i;
        }
        if (bankAccounts[i].accountName == userTransferAccount) {
            foundTransferAccount = true;
            transferAccountIndex = i;
        }
    }

    if (foundAccount && foundTransferAccount) {
        bankAccounts[accountIndex].accountBalance -= userFunds;
        bankAccounts[transferAccountIndex].accountBalance += userFunds;
        writeAccountToFile(filename, username, bankAccounts);

        cout << "True;";
    }
    else {
        if (!foundAccount) {
            cout << "False;cannot transfer: account not found";
        }
        else if (!foundTransferAccount) {
            cout << "False;cannot transfer: transfer account not found";
        }
        else {
            cout << "False;cannot transfer: erroe processing request";
        }
    }
    return 0;
}