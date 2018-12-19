<?php
namespace App\Console\Commands;
use Workerman\Worker;
use Illuminate\Console\Command;
class WorkermanCommand extends Command {
    private $server;
    protected $signature = 'z:ws1 {action} {-d?}';
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

        $this->server = new Worker("websocket://0.0.0.0:9011");

        $this->server->count = 1;
        $this->server->onWorkerStart = function($worker)
        {
            // 开启一个内部端口，方便内部系统推送数据，Text协议格式 文本+换行符
            $inner_text_worker = new Worker('text://0.0.0.0:5678');
            $inner_text_worker->onMessage = function($connection, $buffer)
            {
                // $data数组格式，里面有uid，表示向那个uid的页面推送数据
                $data = json_decode($buffer, true);
                $uid = $data['uid'];
                // 通过workerman，向uid的页面推送数据
                $ret = $this->sendMessageByUid($uid, $buffer);
                // 返回推送结果
                $connection->send($ret ? 'ok' : 'fail');
            };
            // ## 执行监听 ##
            $inner_text_worker->listen();
        };
        // 新增加一个属性，用来保存uid到connection的映射
        $this->server->uidConnections = array();
        // 当有客户端发来消息时执行的回调函数
        $this->server->onMessage = function($connection, $data)
        {
            global $worker;
            // 判断当前客户端是否已经验证,既是否设置了uid
            if(!isset($connection->uid))
            {
                // 没验证的话把第一个包当做uid（这里为了方便演示，没做真正的验证）
                $connection->uid = $data;
                /* 保存uid到connection的映射，这样可以方便的通过uid查找connection，
                 * 实现针对特定uid推送数据
                 */
                $worker->uidConnections[$connection->uid] = $connection;
                return;
            }
        };

        // 当有客户端连接断开时
        $this->server->onClose = function($connection)
        {
            global $worker;
            if(isset($connection->uid))
            {
                // 连接断开时删除映射
                unset($worker->uidConnections[$connection->uid]);
            }
        };
        // 运行worker
        Worker::runAll();
    }




    // 向所有验证的用户推送数据
    function broadcast($message)
    {
        global $worker;
        foreach($worker->uidConnections as $connection)
        {
            $connection->send($message);
        }
    }

    // 针对uid推送数据
    function sendMessageByUid($uid, $message)
    {
        global $worker;
        if(isset($worker->uidConnections[$uid]))
        {
            $connection = $worker->uidConnections[$uid];
            $connection->send($message);
            return true;
        }
        return false;
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
    private function reload() {
        $worker = new Worker('websocket://0.0.0.0:9011');
        // 设置此实例收到reload信号后是否reload重启
        $worker->reloadable = false;
        $worker->onWorkerStart = function($worker)
        {
            echo "Worker reload...\n";
        };
        // 运行worker
        Worker::runAll();
    }
}