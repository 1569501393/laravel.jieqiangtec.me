<?php

namespace App\Console\Commands;

use App\Http\Model\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * Class Test
 * @package App\Console\Commands
 *
 * 命令结构
 * https://learnku.com/docs/laravel/5.7/artisan/2276
 *
 * 命令生成后，应先填写类的 signature 和 description 属性，这会在使用 list 命令的时候显示出来。执行命令时会调用 handle 方法，你可以在这个方法中放置命令逻辑。
 *
 * {tip} 为了更好的代码复用，最好保持你的控制台代码轻量并让它们延迟到应用服务中完成。在下面的例子中，请注意，我们注入了一个服务类来完成发送邮件的「重任」。
 * 让我们看一个简单的例子。注意，我们可以在 Command 的构造函数中注入我们需要的任何依赖项。Laravel 服务容器 将会自动注入所有在构造函数中的带类型约束的依赖：
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

        $credentials['status'] = 1;
        $res = Auth::attempt($credentials);
        dd($res);

        // compact 函数测试
        $data = [1,2,3];
        dd(count($data));
        dd(compact('data'));
        // 测试数据库连接
        $this->testDb();

        // 测试
        $this->line('hello jieqiangtec.com');
    }

    function testDb()
    {
        // $testArr = \App\Http\Model\Test::query()->first();
        // $userArr = User::query()->first();
        // dd($testArr);exit;

        $test         = \App\Http\Model\Test::find(1);
        $test->remark = 'John';
        $res          = $test->save();

        $arr = ['remark' => '111'];
        $res = \App\Http\Model\Test::where('id', 1)->update($arr);


        $res = \App\Http\Model\Test::insert($arr);

        /*其实laravel 的 model 会自动维护时间戳字段
新增可以写成如下
        作者：胡知鱼
链接：https://www.jianshu.com/p/36eb88bec9e9
来源：简书
简书著作权归作者所有，任何形式的转载都请联系作者获得授权并注明出处。
        */
        $test = new \App\Http\Model\Test();
        $test->fillable(array_keys($arr));
        $test->fill($arr);
        $test->save();

        /*created_at字段就有了-----------.
更新操作也可以换成如下写法*/
        $test         = \App\Http\Model\Test::find(1);
        $test->remark = 'John';
        $res          = $test->save();


        dd($res);


        // $user = DB::table('user')->get();
        // $user = DB::table('user')->where('user_id', 1)->get();
        $user = DB::table('user')->where('user_name', 'admin')->get();
        dd($user);
        $pdo = DB::connection()->getPdo();
        dd($pdo);


    }
}
