# DLog 

A desired log library for PHP

## 配置
```
    // 日志级别
    //  1：打印FATAL
    //  2：打印FATAL和WARNING
    //  4：打印FATAL、WARNING、NOTICE（线上程序正常运行时的配置）
    //  8：打印FATAL、WARNING、NOTICE、TRACE（线上程序异常时使用该配置）
    // 16：打印FATAL、WARNING、NOTICE、TRACE、DEBUG（测试环境配置）
    public static $level = 8;

    // 是否按小时自动分日志，设置为1时，日志被打在xx.log.2011010101
    public static $auto_rotate = 1;

    // 日志文件路径是否增加一个基于app名称的子目录，例如：log/app1/app1.log
    // 该配置对于default app同样生效
    public static $use_sub_dir = 1;

    // 日志格式
    public static $format = '%L: %{%y-%m-%d %H:%M:%S}t %{app}x * %{pid}x [logid=%l filename=%f lineno=%N uri=%U errno=%{err_no}x %{encoded_str_array}x] %{err_msg}x';

    // 提供绝对路径，日志存放的默认根目录
    public static $log_path = '/tmp/dlog';
    // 提供绝对路径，日志格式数据存放的默认根目录
    public static $data_path = '/tmp/dlog/.data';
```

## 示例 
```
// 指定当前loger为app1, 日志会打印到app1/app1.log[.wf]
DLog::setLogger('app1');

$log_args = array(
    'key1' => 'value1',
    'key2' => 'value2',
);
DLog::debug("this is debug");
DLog::trace("this is trace");
DLog::notice("this is notice");
DLog::warning("this is warning", '404');
DLog::fatal("this is fatal", '500', $log_args);


DLog::pushKey("newkey",'xxx');
DLog::notice("this is notice app1, with newkey");

DLog::setLogger('app2');
DLog::notice("this is notice app2");

DLog::setLogger('app1');
DLog::notice("this is notice back to app1, still with newkey :)");
```
output
```
TRACE: 15-06-07 16:22:37 app1 * 68337 [logid=3507556553 filename=/Users/work/git/DLog/examples/error_log.php lineno=21 uri= errno=0 ] this is trace
NOTICE: 15-06-07 16:22:37 app1 * 68337 [logid=3507556553 filename=/Users/work/git/DLog/examples/error_log.php lineno=22 uri= errno=0 ] this is notice
WARNING: 15-06-07 16:22:37 app1 * 68337 [logid=3507556553 filename=/Users/work/git/DLog/examples/error_log.php lineno=23 uri= errno=404 ] this is warning
FATAL: 15-06-07 16:22:37 app1 * 68337 [logid=3507556553 filename=/Users/work/git/DLog/examples/error_log.php lineno=24 uri= errno=500 key1=value1 key2=value2] this is fatal
NOTICE: 15-06-07 16:22:37 app1 * 68337 [logid=3507556553 filename=/Users/work/git/DLog/examples/error_log.php lineno=28 uri= errno=0 newkey=xxx] this is notice app1, with newkey
NOTICE: 15-06-07 16:22:37 app2 * 68337 [logid=3507556553 filename=/Users/work/git/DLog/examples/error_log.php lineno=31 uri= errno=0 ] this is notice app2
NOTICE: 15-06-07 16:22:37 app1 * 68337 [logid=3507556553 filename=/Users/work/git/DLog/examples/error_log.php lineno=34 uri= errno=0 newkey=xxx] this is notice back to app1, still with newkey :)
```
