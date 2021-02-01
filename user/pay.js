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