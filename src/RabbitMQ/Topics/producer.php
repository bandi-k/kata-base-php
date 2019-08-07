<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'bandi', 'pwd123');
$channel    = $connection->channel();

$channel->exchange_declare('topic_logs', 'topic', false, false, false);

$routingKey = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'anonymous.notice';

$data = implode(' ', array_slice($argv, 2));

if (empty($data))
{
	$data = "Hello World!";
}

$message = new AMQPMessage($data);

$channel->basic_publish($message, 'topic_logs', $routingKey);

echo ' [x] Sent ', $routingKey, ':', $data, "\n";

$channel->close();
$connection->close();