<?php

$last_line = system('/usr/local/nginx/html/yoyo_update_admin.sh', $retval);
echo '</pre><br />Return value: ' . $retval;
echo "<hr />";