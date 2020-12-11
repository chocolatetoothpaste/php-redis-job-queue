<?php
// For this job system I have decided that 1 will be the lowest
// priority so job priorities can be infinitely higher

// status would have theoretical values of:
// 1 for active (meaning not complete)
// 2 for processing
// 3 for completed

class Job {
	private $db;
	public $cache;
	private $db_fields = array(
		'id' => 'integer',
		'status' => 'integer',
		'priority' => 'integer',
		'submitter' => 'integer',
		'processor' => 'integer',
		'command' => 'string',
		'process_time' => 'double'
	);

	function __construct() {
		// the connection data should come from a config file, preferrably
		// injected by a docker container
		$dsn = 'mysql:dbname=jobs;host=127.0.0.1';
		$user = 'root';
		$password = 'rooster1';

		try {
		    $this->db = new PDO($dsn, $user, $password);
		} catch (PDOException $e) {
		    error_log('Connection failed: ' . $e->getMessage());
		}
	}

	public function get($id = 0) {
		$data = [];
		$query = 'SELECT
			id,
			submitter,
			processor,
			command,
			status,
			priority,
			proc_time
				FROM jobs';

		if( $id === 0 ) {
			// get highest priority job from the queue and updating it's status in the db
			// it is assumed the command
			$job = $this->cache->getPriorityJob();
			$proc_time = $this->run($job['command']);

			$stmt = $this->db->prepare('UPDATE jobs SET status = 2, proc_time = ? WHERE id = ?');
			$stmt->execute([$proc_time, $job['id']]);

			$this->cache->saveProcTime($proc_time);
		}
		else {
			$query .= ' WHERE id = :id';
			$data['id'] = $id;

			$stmt = $this->db->prepare($query);
			$stmt->execute($data);
			$job = $stmt->fetch(PDO::FETCH_ASSOC);
		}

		return ['success' => true, 'data' => $job];
	}

	public function save(array $data) {
		$query = '';
		$fields = [];
		$vals = [];

		foreach( $this->db_fields as $field => $type ) {
			// making sure the field being passed in is allowed and is the correct type
			if( ! empty($data[$field]) && $type === gettype($data[$field]) ) {
				$fields[$field] = "$field = :$field";
				$vals[$field] = $data[$field];
			}
		}

		$query_fields = implode(', ', $fields);
		$query = "INSERT INTO jobs SET $query_fields ON DUPLICATE KEY UPDATE $query_fields";

		$stmt = $this->db->prepare($query);
		if( $stmt->execute($vals) ) {
			$this->cache->saveJob($data);
			return ['success' => true];
		} else {
			return ['success' => false, 'error' => 'Unable to create job'];
		}
	}

	public function run($cmd) {
		$time_start = microtime(true);

		// Sleep for a while
		usleep(mt_rand(5000, 15000));

		$time_end = microtime(true);
		return $time_end - $time_start;
	}

	public function getProcAverage($range = 0) {
		if( empty($range) ) {
			$range = date('YmdHis', strtotime('-1 hour'));
		}

		return $this->cache->getProcAverage($range);
	}

	public function rebuildQueue() {
		$query = 'SELECT * FROM jobs WHERE status = 1';
		$stmt = $this->db->query($query);
		$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach($jobs as $job) {
			$this->cache->saveJob($data);
		}
	}
}
