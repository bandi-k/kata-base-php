<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'bandi', 'pwd123');
$channel    = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

$text = !empty($argv[1]) ? $argv[1] : 'Hello World!';

$message = new AMQPMessage($text);
$channel->basic_publish($message, '', 'hello');

echo " [x] Sent $text\n";

$channel->close();
$connection->close();
