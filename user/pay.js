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

function postData2(obj2)
{
    fetch('http://localhost/bank/api/endpoint/createpay.php', {
    method: "POST",
    headers: {
    "Accept": "application/json",
    "Content-Type": "application/json"
    },
    body: JSON.stringify(obj2)
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
                //console.log(Transfers.recipientAccountNumber);
                return postData2(data),updateJson(Transfers.recipientAccountNumber,Transfers.value);
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