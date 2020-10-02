import api from "../api";

class VechicleService {
    getData(){
        console.log('Fetching..')
        return api.get("/?url=vehicle");
    }

    insertData(data){
        return api.post("/?url=vehicle/save",data);
    }
}

export default new VechicleService();