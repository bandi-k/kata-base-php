<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class FibonacciRpcClient
{
	private $connection;
	private $channel;
	private $callbackQueue;
	private $response;
	private $correlationId;

	public function __construct()
	{
		$this->connection = new AMQPStreamConnection('localhost', 5672, 'bandi', 'pwd123');
		$this->channel    = $this->connection->channel();

		list($this->callbackQueue) = $this->channel->queue_declare("", false, false, true, false);

		$this->channel->basic_consume(
			$this->callbackQueue,
			'',
			false,
			true,
			false,
			false,
			array(
				$this,
				'onResponse'
			)
		);
	}

	public function onResponse(AMQPMessage $response)
	{
		if ($response->get('correlation_id') == $this->correlationId)
		{
			$this->response = $response->body;
		}
	}

	public function call($number)
	{
		$this->response       = null;
		$this->correlationId  = uniqid();

		$message = new AMQPMessage(
			(string) $number,
			array(
				'correlation_id' => $this->correlationId,
				'reply_to'       => $this->callbackQueue
			)
		);

		$this->channel->basic_publish($message, '', 'rpc_queue');

		while (!$this->response)
		{
			$this->channel->wait();
		}

		return intval($this->response);
	}
}

$client   = new FibonacciRpcClient();
$response = $client->call(30);

echo ' [.] Got ', $response, "\n";
