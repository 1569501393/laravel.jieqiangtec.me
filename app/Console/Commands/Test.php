<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


/**
 * Class Test
 * @package App\Console\Commands
 *
 * 命令结构
 * https://learnku.com/docs/laravel/5.7/artisan/2276

命令生成后，应先填写类的 signature 和 description 属性，这会在使用 list 命令的时候显示出来。执行命令时会调用 handle 方法，你可以在这个方法中放置命令逻辑。
 *
 * {tip} 为了更好的代码复用，最好保持你的控制台代码轻量并让它们延迟到应用服务中完成。在下面的例子中，请注意，我们注入了一个服务类来完成发送邮件的「重任」。
让我们看一个简单的例子。注意，我们可以在 Command 的构造函数中注入我们需要的任何依赖项。Laravel 服务容器 将会自动注入所有在构造函数中的带类型约束的依赖：
 */
class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'Test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 测试数据库连接
        $this->testDb();
        // 测试
        $this->line('hello jieqiangtec.com');
    }

    function testDb(){
        $user = DB::table('user')->get();
        dd($user);
        $pdo = DB::connection()->getPdo();
        dd($pdo);


    }
}
