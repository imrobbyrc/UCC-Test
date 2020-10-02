import axios from "axios";

export default axios.create({
    withCredentials: true,
    baseURL: 'http://ucc-test.localhost',
    // headers: {
    //     'Content-type': 'application/json'
    // }
});