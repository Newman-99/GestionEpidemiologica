<?php
$sync = require '../config/boostrap-phpcloud.php';
$sync->makeRestore()->run('local', 'gestionEpidemi-02-12-28_01-12-2020.sql.gz', 'production', 'gzip');
