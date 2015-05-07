<?php

namespace BugTower\BugTowerLaravel;

class BugTowerClient {
	
	public function notifyException(\Exception $e, $type) {
		$data = [
			'api_key' => config('services.bugtower.key'),
			'message' => $e->__toString(),
			'type' => $type,
			'status_code' => $e->getStatusCode(),
		];
		$this->send($data);
	}
	
	private function send($data = []) {
		$curl = curl_init ();
		curl_setopt_array ( $curl, [
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => config ( 'services.bugtower.endpoint' ) . '?api_key=' . config ( 'services.bugtower.key' ),
				CURLOPT_USERAGENT => 'PHP Laravel 1',
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => $data 
		] );
		curl_exec ( $curl );
		curl_close ( $curl );
	}
}