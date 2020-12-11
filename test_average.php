<?php
//
// require('vendor/autoload.php');
// $client = new Predis\Client();
// $time_start = microtime(true);
//
// // Sleep for a while
// usleep(mt_rand(5000, 15000));
//
// $time_end = microtime(true);
// $time = $time_end - $time_start;
//
// $response = $client->zadd('process_time', date('YmdHis', strtotime('-7 minutes')), $time);
// var_dump($response);
//
// $time_start = microtime(true);
//
// // Sleep for a while
// usleep(mt_rand(5000, 15000));
//
// $time_end = microtime(true);
// $time = $time_end - $time_start;
//
// $response = $client->zadd('process_time', date('YmdHis', strtotime('-58 minutes')), $time);
// var_dump($response);
//
// $time_start = microtime(true);
//
// // Sleep for a while
// usleep(mt_rand(5000, 15000));
//
// $time_end = microtime(true);
// $time = $time_end - $time_start;
//
// $response = $client->zadd('process_time', date('YmdHis', strtotime('-3 hours')), $time);
// var_dump($response);
//
// $time_start = microtime(true);
//
// // Sleep for a while
// usleep(mt_rand(5000, 15000));
//
// $time_end = microtime(true);
// $time = $time_end - $time_start;
//
// $response = $client->zadd('process_time', date('YmdHis', strtotime('-39 minutes')), $time);
// var_dump($response);
//
// $response = $client->zrangebyscore('process_time', date('YmdHis', strtotime('-1 hour')), '+inf');
//
// $total = 0;
// foreach( $response as $proc ) {
// 	$total += floatval($proc);
// }
//
// echo floatval($total / count($response));
// // var_dump($response);
