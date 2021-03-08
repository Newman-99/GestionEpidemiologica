<?php

namespace PhpDbCloud\Filesystems;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem as Flysystem;

/**
 * Class LocalFilesystem.
 */
class LocalFilesystem implements Filesystem
{
    /**
     * Test fitness of visitor.
     *
     * @param $type
     *
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type) == 'local';
    }

    /**
     * @param array $config
     *
     * @return Flysystem
     */
    public function get(array $config)
    {
        return new Flysystem(new Local($config['root']));
    }
}
