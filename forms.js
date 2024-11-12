function closeForm(event) {
    document.getElementByClassName("dropDownContent").classList.remove('show');
}

function dropDownFormDeposit() {
    document.getElementById("depositForm").classList.toggle('show');
}


function dropDownFormWithdraw() {
    document.getElementById("withdrawForm").classList.toggle('show');
}

function dropDownFormTransfer() {
    document.getElementById("transferForm").classList.toggle('show');
}

function dropDownFormWireTransfer() {
    document.getElementById("wireTransferForm").classList.toggle('show');
}

function dropDownFormCreateNewAccount() {
    document.getElementById("createNewAccountForm").classList.toggle('show');
}

function dropDownFormDeleteAccount() {
    document.getElementById("deleteAccountForm").classList.toggle('show');
}

window.onclick = function(event) {
    if (!event.target.matches('.dropForm')) {
        document.getElementsByClassName("dropDownContent").classList.remove('show');
    }
}