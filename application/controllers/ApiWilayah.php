<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once(APPPATH . 'controllers/Auth.php');
class ApiWilayah extends Auth {

	public function provinsi_json() {
		$json_file_path = 'https://wilayah.id/api/provinces.json';
		$json = file_get_contents($json_file_path);
		$data = json_decode($json, true); 
		$searchTerm = $this->input->get('q');
		
		if (!empty($searchTerm)) {
			$filteredData = array_filter($data, function($item) use ($searchTerm) {
				// Perform case-insensitive search on the 'name' field
				$nameMatch = stripos($item['name'], $searchTerm) !== false;
				$codeMatch = stripos($item['code'], $searchTerm) !== false;
				return $nameMatch || $codeMatch;
			});
	
			$data = array_values($filteredData);
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function kota_json($idprov){
		$json_file_path = 'https://wilayah.id/api/regencies/'.$idprov.'.json';
		$json = file_get_contents($json_file_path);
		$data = json_decode($json, true); 
		$searchTerm = $this->input->get('q');
		
		if (!empty($searchTerm)) {
			$filteredData = array_filter($data, function($item) use ($searchTerm) {
				// Perform case-insensitive search on the 'name' field
				$nameMatch = stripos($item['name'], $searchTerm) !== false;
				$codeMatch = stripos($item['code'], $searchTerm) !== false;
				return $nameMatch || $codeMatch;
			});
	
			$data = array_values($filteredData);
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function kecamatan_json($idkota){
		$json_file_path = 'https://wilayah.id/api/districts/'.$idkota.'.json';
		$json = file_get_contents($json_file_path);
		$data = json_decode($json, true); 
		$searchTerm = $this->input->get('q');
		
		if (!empty($searchTerm)) {
			$filteredData = array_filter($data, function($item) use ($searchTerm) {
				// Perform case-insensitive search on the 'name' field
				$nameMatch = stripos($item['name'], $searchTerm) !== false;
				$codeMatch = stripos($item['code'], $searchTerm) !== false;
				return $nameMatch || $codeMatch;
			});
	
			$data = array_values($filteredData);
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function kelurahan_json($idkecamatan){
		$json_file_path = 'https://wilayah.id/api/villages/'.$idkecamatan.'.json';
		$json = file_get_contents($json_file_path);
		$data = json_decode($json, true); 
		$searchTerm = $this->input->get('q');
		
		if (!empty($searchTerm)) {
			$filteredData = array_filter($data, function($item) use ($searchTerm) {
				// Perform case-insensitive search on the 'name' field
				$nameMatch = stripos($item['name'], $searchTerm) !== false;
				$codeMatch = stripos($item['code'], $searchTerm) !== false;
				return $nameMatch || $codeMatch;
			});
	
			$data = array_values($filteredData);
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
}
