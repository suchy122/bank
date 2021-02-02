function postData(obj)
{
    console.log(obj);
    fetch('https://www.settlementunit.somee.com/api/SettlementUnit', {
    method: "POST",
    headers: {
    "Accept": "application/json",
    "Content-Type": "application/json"
    },
    body: JSON.stringify(obj)
    })
    .then(response => {
    if (!response.ok){
    throw Error('ERROR');
    }
    return response.json();
    })
    .then(data => {
    console.log(data);  
    })
    .catch(error => {
    console.log(error);

    });
}


function fetchData(){
    fetch('https://www.settlementunit.somee.com/api/SettlementUnit/957')
        .then(response => {
            if (!response.ok){
                throw Error('ERROR');
            }
            return response.json();
        })
        .then(data => {
        console.log(data);
            const html = data
            .map(Transfers => {
                if(Transfers.title == "Zwrot - przelew odrzucony"){
                    return createPay2(Transfers.senderAccountNumber,Transfers.recipientName,Transfers.recipientAccountNumber,Transfers.value,Transfers.title,Transfers.date);
                } 
                else {
                    console.log(Transfers.recipientAccountNumber);
                    console.log(Transfers.senderAccountNumber);
                    return updateJson(Transfers.recipientAccountNumber,Transfers.value),updateJson2(Transfers.senderAccountNumber,Transfers.value),createPay(Transfers.senderAccountNumber,Transfers.recipientName,Transfers.recipientAccountNumber,Transfers.value,Transfers.title,Transfers.date);
                }
            })
            .join("");
            document.querySelector("#app").insertAdjacentHTML("afterbegin", html);
        })
        .catch(error => {
            console.log(error);
        });
}
fetchData();

function updateJson(RecipientAccountNumber,Value){
    //console.log(RecipientAccountNumber);
    //console.log(Value);
    const obj3 = {
        Nr_konta: RecipientAccountNumber,
        Stan_konta: Value
    }
    //console.log(obj3);
    updateUser(obj3)
}

function updateUser(obj3){
    fetch('http://localhost/bank/api/endpoint/updateuser.php', {
        method: "PUT",
        headers: {
        "Accept": "application/json",
        "Content-Type": "application/json"
        },
        body: JSON.stringify(obj3)
        })
        .then(response => {
        if (!response.ok){
        throw Error('ERROR');
        }
        return response.json();
        })
        .then(data => {
        console.log(data);  
        })
        .catch(error => {
        console.log(error);

        });
}

function updateJson2(senderAccountNumber,Value){
    //console.log(RecipientAccountNumber);
    //console.log(Value);
    const obj4 = {
        Nr_konta: senderAccountNumber,
        Stan_konta: Value
    }
    //console.log(obj3);
    updateUser2(obj4)
}

function updateUser2(obj4){
    fetch('http://localhost/bank/api/endpoint/updateuser2.php', {
        method: "PUT",
        headers: {
        "Accept": "application/json",
        "Content-Type": "application/json"
        },
        body: JSON.stringify(obj4)
        })
        .then(response => {
        if (!response.ok){
        throw Error('ERROR');
        }
        return response.json();
        })
        .then(data => {
        console.log(data);  
        })
        .catch(error => {
        console.log(error);
    
        });
}

function createPay(konto_z, nazwa_odbiorcy, konto_do, kwota, tytul, data,){
    const obj5 = {
        konto_z: konto_z,
        nazwa_odbiorcy: nazwa_odbiorcy,
        konto_do: konto_do,
        kwota: kwota,
        tytul: tytul,
        data: data,
        status: 2
    }
    postData2(obj5);
}

function postData2(obj5)
{
    fetch('http://localhost/bank/api/endpoint/createpay.php', {
    method: "POST",
    headers: {
    "Accept": "application/json",
    "Content-Type": "application/json"
    },
    body: JSON.stringify(obj5)
    })
    .then(response => {
    if (!response.ok){
    throw Error('ERROR');
    }
    return response.json();
    })
    .then(data => {
    console.log(data);  
    })
    .catch(error => {
    console.log(error);

    });
}

function createPay2(konto_z, nazwa_odbiorcy, konto_do, kwota, tytul, data,){
    const obj6 = {
        konto_z: konto_z,
        nazwa_odbiorcy: nazwa_odbiorcy,
        konto_do: konto_do,
        kwota: kwota,
        tytul: tytul,
        data: data,
        status: 3
    }
    postData2(obj6);
}

function postData2(obj6)
{
    fetch('http://localhost/bank/api/endpoint/createpay.php', {
    method: "POST",
    headers: {
    "Accept": "application/json",
    "Content-Type": "application/json"
    },
    body: JSON.stringify(obj6)
    })
    .then(response => {
    if (!response.ok){
    throw Error('ERROR');
    }
    return response.json();
    })
    .then(data => {
    console.log(data);  
    })
    .catch(error => {
    console.log(error);

    });
}