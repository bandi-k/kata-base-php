<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'bandi', 'pwd123');
$channel    = $connection->channel();

$channel->exchange_declare('topic_logs', 'topic', false, false, false);

list($queueName) = $channel->queue_declare("", false, false, true, false);

$bindingKeys = array_slice($argv, 1);

if (empty($bindingKeys))
{
	file_put_contents('php://stderr', "Usage: $argv[0] [binding_key]\n");
	exit(1);
}

foreach ($bindingKeys as $bindingKey)
{
	$channel->queue_bind($queueName, 'topic_logs', $bindingKey);
}

echo " [*] Waiting for logs. To exit press CTRL+C\n";

$callback = function ($message)
{
	echo ' [x] ', $message->delivery_info['routing_key'], ':', $message->body, "\n";
};

$channel->basic_consume($queueName, '', false, true, false, false, $callback);

while ($channel->is_consuming())
{
	$channel->wait();
}

$channel->close();
$connection->close();