#!/usr/bin/env php
<?php
/**

title=count_of_monthly_finished_task
timeout=0
cid=1

*/
include dirname(__FILE__, 7) . '/test/lib/init.php';
include dirname(__FILE__, 4) . '/calc.class.php';

zdTable('project')->config('project_close', true, 4)->gen(10);
zdTable('project')->config('execution', true, 4)->gen(20, false);
zdTable('task')->config('task', true, 4)->gen(1000);

$metric = new metricTest();
$calc   = $metric->calcMetric(__FILE__);

r(count($calc->getResult())) && p('') && e('84'); // 测试分组数。

r($calc->getResult(array('year' => '2014', 'month' => '10'))) && p('0:value') && e('2'); // 测试2014年10月。
r($calc->getResult(array('year' => '2014', 'month' => '11'))) && p('0:value') && e('3'); // 测试2014年11月。
r($calc->getResult(array('year' => '2017', 'month' => '02'))) && p('0:value') && e('3'); // 测试2017年2月。
r($calc->getResult(array('year' => '2017', 'month' => '03'))) && p('0:value') && e('3'); // 测试2017年3月。
r($calc->getResult(array('year' => '2021', 'month' => '04'))) && p('')        && e('0'); // 测试不存在。
