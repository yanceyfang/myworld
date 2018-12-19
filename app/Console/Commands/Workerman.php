<?php
namespace App\Console\Commands;
use function foo\func;
use Workerman\Worker;
use Illuminate\Console\Command;
class Workerman extends Command {
    private $server1;
    protected $signature = 'z:ws2 {action} {-d?}';
    protected $description = 'Start a Workerman server.';
    public function __construct() {
        parent::__construct();
    }

    /** * Execute the console command. * * @return mixed */
    public function handle() {
        global $argv;
        $arg = $this->argument('action');
        $argv[1] = $argv[2];
        $argv[2] = isset($argv[3]) ? "-{$argv[3]}" : '';

        switch ($arg) {
            case 'start':
                $this->start();
                break;
            case 'stop':
                $this->stop();
                break;
            case 'restart':
                $this->restart();
                break;
            case 'reload':
                $this->reload();
                break;
        }
    }
    private function start() {

        $this->server1 = new Worker("websocket://0.0.0.0:9011");

        $this->server1->count = 1;

        $this->server1->onWorkerStart       = function($worker){

        };

        $this->server1->onConnect           = function($connection){

        };

        $this->server1->onMessage           = function($connection, $data){

        };

        $this->server1->onClose             = function($connection){

        };
        // 运行worker
        Worker::runAll();
    }
    private function stop() {
        $worker = new Worker('websocket://0.0.0.0:9011');
        // 设置此实例收到reload信号后是否reload重启
        $worker->reloadable = false;
        $worker->onWorkerStop = function($worker)
        {
            echo "Worker reload...\n";
        };
        // 运行worker
        Worker::runAll();
    }
    private function restart() {
        $worker = new Worker('websocket://0.0.0.0:9011');
        // 设置此实例收到reload信号后是否reload重启
        $worker->reloadable = true;
        $worker->onWorkerStart = function($worker)
        {
            echo "Worker restart...\n";
        };
        // 运行worker
        Worker::runAll();
    }
}