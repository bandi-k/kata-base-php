<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'bandi', 'pwd123');
$channel    = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($message)
{
	echo ' [x] Received ', $message->body, "\n";
};

$channel->basic_consume('hello', '', false, true, false, false, $callback);

while ($channel->is_consuming())
{
	$channel->wait();
}

$channel->close();
$connection->close();