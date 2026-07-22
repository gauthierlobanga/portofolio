<?php $json = json_decode(file_get_contents("test_results.txt"), true); if($json && isset($json["failures"])) { foreach ($json["failures"] as $f) { echo $f["test"] . PHP_EOL; } }
