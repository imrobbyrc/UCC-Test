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
        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin:".SPA_URL);
            header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
        }
    
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
    
            exit(0);
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

            $data = (object) $_POST;
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