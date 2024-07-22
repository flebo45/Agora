<?php
require __DIR__ . "/vendor/autoload.php";

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $users;

    public function __construct() {
        //all the user connected to the web socket
        $this->clients = new \SplObjectStorage;

        //all the user that have "Online status"
        $this->users = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    //we handle two types of packets: status (for updating the status of users) and check(for checking if a user is online or not)
    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        if ($data['type'] === 'status') {

            //if the user is online, the array users is populated
            if($data['status'] === 'online'){
                $this->users[$data['userId']] = [$data['userId'], $data['latitude'], $data['longitude']];
            }elseif($data['status'] === 'offline'){

                //if the user is offline, the user is unest from the array
                if(isset($this->users[$data['userId']])){
                    unset($this->users[$data['userId']]);
                }
            }

            //after the user updating, we sand the change of the user status over all the clients, that will be updated in real-time
            foreach ($this->clients as $client) {
                if ($from !== $client) {
                    $client->send(json_encode([
                        'type' => 'status',
                        'userId' => $data['userId'],
                        'status' => $data['status'],
                        'latitude' => $data['latitude'],
                        'longitude' => $data['longitude']
                    ]));
                }
            }
            var_dump($this->users);
        }elseif($data['type'] === 'check') {

            //if the user is in the users array, it means that the user is online; if not it means that the user is offline
            if(isset($this->users[$data['userId']])){
                $from->send(json_encode([
                    'type' => 'check',
                    'status' => 'online',
                    'latitude' => $this->users[$data['userId']][1],
                    'longitude' => $this->users[$data['userId']][2]
                ]));
            }else{
                $from->send(json_encode([
                    'type' => 'check',
                    'status' => 'offline'
                ]));
            }
        }
        

    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);

$server->run();