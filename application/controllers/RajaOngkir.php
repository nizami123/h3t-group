<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class RajaOngkir extends Auth { 

    private $api_key = 'a30998a8efc9c1d1ee6d055b72dcc9db';

	public function getData($data = array())
	{
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $data['url'],
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: $this->api_key "
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $responseData = json_decode($response, true);

            if ($responseData === null) {
              echo "Gagal mengurai respons JSON.";
            } else {
              $results = $responseData["rajaongkir"]["results"];
              return $results;
            }
        }
	}

    public function getProvince($id = null){
        // $provinsi = $this->db->query("select * from PROVINSI")->result_array();
        // echo json_encode($provinsi);
        $data = array(
            'url' => 'https://pro.rajaongkir.com/api/province?id='.$id,
        );
        $results = $this->getData($data);
        echo json_encode($results);
    }

    public function getCity($id = null){
        $data = array(
            'url' => 'https://pro.rajaongkir.com/api/city?province='.$id,
        );
        $results = $this->getData($data);
        echo json_encode($results);
    }

    public function getKecamatan($id = null){
        $data = array(
            'url' => 'https://pro.rajaongkir.com/api/subdistrict?city='.$id,
        );
        $results = $this->getData($data);
        echo json_encode($results);
    }
}
