import axios from "axios";

export default axios.create({
   
    baseURL: 'http://ucc-test.localhost/public/',
    headers: {
        'Content-type': 'application/json'
    }
});