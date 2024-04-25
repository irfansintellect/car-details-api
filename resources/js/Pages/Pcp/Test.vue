<template>
    <div>
        <h1>testing</h1>
    </div>
</template>

<script setup>

import axios from 'axios';

var data = JSON.stringify({ registrationNumber: 'AA19AAA' });

console.log(data);

let $url = 'https://driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles';

async function getData() {
    const { data } = await axios.post($url, {
        data: JSON.stringify({ registrationNumber: 'Kj16cnz' })
    }, {
        headers: {
            'Content-Type': 'application/json',
            'x-api-key': 'cJYFpTF7Db8zonDMVCaKuxS9N0OWFElaBq6kMcK5',
        }
    })
    console.log(data);
}
getData();

// var config = {
//     method: 'post',
//     url:
//         'https://driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles',
//     headers: {
//         'Access-Control-Allow-Origin': '*',
//         'Access-Control-Allow-Methods': 'GET,POST,OPTIONS,DELETE,PUT',
//         'x-api-key': 'cJYFpTF7Db8zonDMVCaKuxS9N0OWFElaBq6kMcK5',
//         'Content-Type': 'application/json',
//     },

//     data: data,
// };
// axios(config)
//     .then(function (response) {
//         console.log(JSON.stringify(response.data));
//     })
//     .catch(function (error) {
//         console.log(error);
//     });
// axios.defaults.withCredentials = true;
// axios.post($url, {
//     headers: {
//         'Access-Control-Allow-Origin': '*',
//         'Access-Control-Allow-Methods': 'GET,POST,OPTIONS,DELETE,PUT',
//         'x-api-key': 'cJYFpTF7Db8zonDMVCaKuxS9N0OWFElaBq6kMcK5',
//         'Content-Type': 'application/json',
//     },
//     data: JSON.stringify({ registrationNumber: 'Kj16cnz' }),
// })
//     .then((response) => {
//         console.log(response);
//     })
//     .catch((error) => {
//         console.log(error);
//     });


</script>

<style lang="scss" scoped></style>
