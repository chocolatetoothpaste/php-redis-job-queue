<?php

require('vendor/autoload.php');
// $client = new Predis\Client();
// // $response = $client->executeRaw(['ZADD', 'jobs', '1', '{"job_id":"job1"}']);
// $response = $client->zadd('jobs', '1', '{"job_id":"job1"}');
// var_dump($response);
// $response = $client->zadd('jobs', '114', '{"job_id":"job114"}');
// var_dump($response);
// $response = $client->zadd('jobs', '88', '{"job_id":"job369"}');
// var_dump($response);
// var_dump($response);
// $response = $client->zadd('jobs', '88', '{"job_id":"job246"}');
// var_dump($response);
// var_dump($response);
// $response = $client->zadd('jobs', '88', '{"job_id":"job88"}');
// var_dump($response);
// $response = $client->zadd('jobs', '34', '{"job_id":"job34"}');
// var_dump($response);
// //
// $response = $client->executeRaw(['ZPOPMAX', 'jobs', 1]);
// var_dump(json_decode($response[0],true));
// $response = $client->executeRaw(['ZPOPMAX', 'jobs', 1]);
// var_dump(json_decode($response[0],true));
// $response = $client->executeRaw(['ZPOPMAX', 'jobs', 1]);
// var_dump(json_decode($response[0],true));
// $response = $client->executeRaw(['ZPOPMAX', 'jobs', 1]);
// var_dump(json_decode($response[0],true));
// // // $response = $client->executeRaw(['ZRANGE', 'jobs', '0', '-1' ,'WITHSCORES']);
// // var_dump($response[0]);

//
require('Job.class.php');
require('Cache.class.php');

$job = new Job;
$job->cache = new Cache;

$job->save(['id' => 1, 'priority' => 4, 'submitter' => 1, 'processor' => 1, 'command' => 'test']);
$job->save(['id' => 2, 'priority' => 41, 'submitter' => 1, 'processor' => 1, 'command' => 'run']);
$job->save(['id' => 3, 'priority' => 24, 'submitter' => 1, 'processor' => 1, 'command' => 'cmd']);
var_dump($job->get());
var_dump($job->get());
var_dump($job->get());

var_dump($job->get(1));
var_dump($job->get(2));
var_dump($job->get(3));

echo $job->getProcAverage();

//
// switch ($request) {
//     case 'POST' :
//         $job->save($_POST['job_data']);
//         break;
//     case 'GET' :
//         $job->get();
//         break;
//     case '/about' :
//         require __DIR__ . '/views/about.php';
//         break;
//     default:
//         http_response_code(404);
//         require __DIR__ . '/views/404.php';
//         break;
// }
