<template>
    <div>
        <h1>testing</h1>
    </div>
</template>

<script setup>

import axios from 'axios';

var data = JSON.stringify({ registrationNumber: 'AA19AAA' });

console.log(data);

var config = {
    method: 'post',
    url:
        'https://driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles',
    headers: {
        'x-api-key': 'cJYFpTF7Db8zonDMVCaKuxS9N0OWFElaBq6kMcK5',
        'Content-Type': 'application/json',
    },
    data: data,
};
axios(config)
    .then(function (response) {
        console.log(JSON.stringify(response.data));
    })
    .catch(function (error) {
        console.log(error);
    });



</script>

<style lang="scss" scoped></style>
