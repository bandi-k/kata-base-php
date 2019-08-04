<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel    = $connection->channel();

$channel->queue_declare('task_queue', false, true, false, false);

$text = !empty($argv[1]) ? implode(' ', array_slice($argv, 1)) : 'Hello World!';

$message = new AMQPMessage(
	$text,
	array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
);

$channel->basic_publish($message, '', 'task_queue');

echo " [x] Sent $text\n";

$channel->close();
$connection->close();

