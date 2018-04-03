<?php
/**
 * 题：一个日志文件，获得最早的1000条日志，可能因为各种原因会导致日志文件记录有乱序（时间靠后的跑到了前面）
 * 答：我把问题简化下，假设日志文件中存储的是一行一个数字
 *
 */
$obj = new SplMaxHeap();

//test文件存储数字，一行一个数字
$hander = fopen('test', 'r');
$line = 0;
while (false !== ($content = fgets($hander))) {
    $content = trim($content);
    $line++;
    if ($line <= 1000) {
        $obj->insert($content);
    } else {
        $max = $obj->current();
        if ($content < $max) {
            $obj->extract();
            $obj->insert($content);
        }
    }

}
echo "\n\n\n";
foreach ($obj as $number) {
    echo $number . "\n";
}
fclose($hander);