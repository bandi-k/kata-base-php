<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel    = $connection->channel();

$channel->queue_declare('rpc_queue', false, false, false, false);

function fib($n)
{
	if ($n == 0)
	{
		return 0;
	}
	if ($n == 1)
	{
		return 1;
	}

	return fib($n-1) + fib($n-2);
}

echo " [x] Awaiting RPC requests\n";
$callback = function (AMQPMessage $request)
{
	$n = intval($request->body);
	echo ' [.] fib(', $n, ")\n";

	$message = new AMQPMessage(
		(string) fib($n),
		array('correlation_id' => $request->get('correlation_id'))
	);

	$request->delivery_info['channel']->basic_publish(
		$message,
		'',
		$request->get('reply_to')
	);
	$request->delivery_info['channel']->basic_ack(
		$request->delivery_info['delivery_tag']
	);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('rpc_queue', '', false, false, false, false, $callback);

while ($channel->is_consuming())
{
	$channel->wait();
}

$channel->close();
$connection->close();