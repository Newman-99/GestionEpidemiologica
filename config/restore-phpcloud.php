<?php
$sync = require '../config/boostrap-phpcloud.php';
$sync->makeRestore()->run('local',$nameFileRestore, 'production', 'gzip');
