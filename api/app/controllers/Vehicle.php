<?php

class Vehicle extends Controller {

    public function __construct(){

        $this->volume = ['cc','l','cid','cu in','in3'];
        $this->cubicInch = ['cid','cu in','in3'];
        $this->ccToLiter = 1000;
        $this->cidToLiter = 61.024;
        $this->cors();
    }

    function cors() {
        
        header("Access-Control-Allow-Origin:".SPA_URL);
        header('Access-Control-Allow-Credentials: true');
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Allow-Origin:'.SPA_URL);
            header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
            header('Access-Control-Allow-Headers: token, Content-Type,origin');
            header('Access-Control-Max-Age: 1728000');
            header('Content-Length: 0');
            die();
        }
    }
    
	public function index(){
        
        $vehicle = $this->model('Vehicle_Models')->getData();

		if(count($vehicle) > 0){
			header('Content-Type: application/json');
			echo json_encode(
					array(
						'total' => count($vehicle), 
						'code' => 200, 
						'message' => 'Vehicle Found!', 
						'vehicle' => $vehicle
					)
				);
			http_response_code(200);
			die;
		} else {
			header('Content-Type: application/json');
			echo json_encode(array('code' => 404, 'message' => 'Vehicle Not Found!'));
			http_response_code(404);
			die;
		}
	}

	public function save(){
        

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = json_decode(file_get_contents("php://input"));

            $err = 0;
            foreach($data as $key => $val){
                if(isset($key) && $val = ""){
                    $err++;
                } 
            }
            if($err > 0){
                header('Content-Type: application/json');
                echo json_encode(array('code' => 500, 'message' => 'No Data Inserted!'));
                http_response_code(500);
                die;
            }
            

            if(empty($data)){
                header('Content-Type: application/json');
                echo json_encode(array('code' => 500, 'message' => 'No Data Inserted!'));
                http_response_code(500);
                die;
            }
            
            $volumes = str_replace(" ","",$data->engine_displacement);
            $volumes = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$volumes);
            if(!in_array(strtolower($volumes[1]),$this->volume)){

                header('Content-Type: application/json');
                echo json_encode(array('code' => 500, 'message' => 'Invalid Engine Displacement!'));
                http_response_code(500);
                die;
            }

            
            if(isset($volumes[0]) && strtolower($volumes[1]) == "cc"){
                $newVolume = $volumes[0] / $this->ccToLiter;
            }elseif(isset($volumes[0]) && in_array(strtolower($volumes[1]), $this->cubicInch)){
                $newVolume = $volumes[0] / $this->cidToLiter;
            }else{
                $newVolume = $volumes[0];
            }

            $data->engine_displacement = $newVolume."L";

            //check uid exist
            $check = $this->model('Vehicle_Models')->findByUid($data->unique_identifier);
            if($check > 0){

                header('Content-Type: application/json');
                echo json_encode(array('code' => 500, 'message' => 'The UID already Exist!'));
                http_response_code(500);
                die;
            }

            $save_vehicle = $this->model('Vehicle_Models')->insertData($data);
            if($save_vehicle > 0){

                header('Content-Type: application/json');
                echo json_encode(array('code' => 200, 'message' => 'Vehicle Successfully Saved!'));
                http_response_code(200);
                die;
            } else {

                header('Content-Type: application/json');
                echo json_encode(array('code' => 500, 'message' => 'Vehicle Failed Saved!'));
                http_response_code(500);
                die;
            }
            

		} else {
			exit('Invalid Request');
		}

	}


}