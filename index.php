<?php
require('Job.class.php');
require('Cache.class.php');

$job = new Job;
$job->cache = new Cache;

switch($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		$id = (empty($_GET['id']) ? 0 : $_GET['id']);
		$job->get($id);
		break;

	case 'POST':
		$job->save($_POST);
		break;

	default:
		http_response_code(405);
		break;
}
