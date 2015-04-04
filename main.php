<?php

require_once dirname(__FILE__).'/core.php';
$flashbang = new Flashbang\Program($argv);
$ec = $flashbang->process();
exit($ec);