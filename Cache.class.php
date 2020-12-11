<?php

class Cache {
	protected static $instance = array();

	// manages singleton instances; creates one if it doesn't exist
	// returns instance of redis client
	public static function instance( array $conn = [ 'scheme' => 'tcp', 'host' => '127.0.0.1', 'port' => 6379 ] ) {
		// convert connection info into a string and create a unique hash
		$name = md5( implode( '', $conn ) );
		if( empty( self::$instance[$name] ) )
			self::$instance[$name] = new Predis\Client($conn);

		return self::$instance[$name];
	}

	public function getPriorityJob() {
		$client = self::instance();
		$response = $client->executeRaw(['ZPOPMAX', 'jobs', 1]);
		return json_decode($response[0], true);
	}

	public function saveJob($data) {
		$client = self::instance();
		$response = $client->zadd('jobs', $data['priority'], json_encode($data));
	}

	public function saveProcTime($time) {
		$client = self::instance();
		$response = $client->zadd('process_time', date('YmdHis'), $time);
	}

	public function getProcAverage($range = 0) {
		$client = self::instance();

		if( empty($range) ) {
			$range = date('YmdHis', strtotime('-1 hour'));
		}

		$response = $client->zrangebyscore('process_time', $range, '+inf');

		$total = 0;
		foreach( $response as $proc ) {
			$total += floatval($proc);
		}

		return floatval($total / count($response));
	}
}
