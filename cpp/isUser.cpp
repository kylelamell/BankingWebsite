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
    // TODO: Change <PATH_TO_User.txt>
    ifstream inFile("<PATH_TO_User.txt>" + filename);

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

int main(int argc, char* argv[]) {

    string username = argv[1];

    vector<string> users;
    readUsersFromFile(users);

    bool foundUser = false;
    for (int i = 0; i < users.size(); i++) {
        if (users[i] == username) {
            foundUser = true;
        }
    }
    
    if (foundUser) {
        cout << "True;Username already in use";
    }
    else {
        cout << "False;User Not Found";
    }
    
    return 0;
}