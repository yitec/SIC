<?php

// open in read-only mode
$db = dbase_open('/proximal2011.dbf', 0);

if ($db) {
	echo "entro";
  // read some data ..
dbase_close($db);
}
?>