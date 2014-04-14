<?php
$_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/../../../../..';

require_once __DIR__ . '/vendor/autoload.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';

define('BX_BUFFER_USED', true);
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);

set_time_limit(0);
ignore_user_abort(true);


foreach(ob_get_status(true) as $i) ob_end_clean();