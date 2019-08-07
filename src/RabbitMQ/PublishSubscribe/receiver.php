<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'bandi', 'pwd123');
$channel    = $connection->channel();

$channel->exchange_declare('logs', 'fanout', false, false, false);

list($queueName) = $channel->queue_declare("", false, false, true, false);

$channel->queue_bind($queueName, 'logs');

echo " [*] Waiting for logs. To exit press CTRL+C\n";

$callback = function ($message)
{
	echo ' [x] ', $message->body, "\n";
};

$channel->basic_consume($queueName, '', false, true, false, false, $callback);

while ($channel->is_consuming())
{
	$channel->wait();
}

$channel->close();
$connection->close();