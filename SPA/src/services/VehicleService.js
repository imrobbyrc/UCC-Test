import api from "../api";

class VechicleService {
    getData(){
        console.log('Fetching..')
        return api.get("/?url=vehicle");
    }

    insertData(data){
        console.log(JSON.stringify(data))
        return api.post("/?url=vehicle/save",JSON.stringify(data));
    }
}

export default new VechicleService();