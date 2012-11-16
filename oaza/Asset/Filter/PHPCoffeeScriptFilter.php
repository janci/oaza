<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Asset\Filter;

use Assetic\Asset\AssetInterface;

/**
 * Coffee filter for Assetic with php library coffeescript
 */
class PHPCoffeeScriptFilter implements \Assetic\Filter\FilterInterface
{

    /**
     * Filters an asset after it has been loaded.
     *
     * @param AssetInterface $asset An asset
     */
    public function filterLoad(AssetInterface $asset)
    {

    }

    /**
     * Filters an asset just before it's dumped.
     *
     * @param AssetInterface $asset An asset
     */
    public function filterDump(AssetInterface $asset)
    {
        $filename = $asset->getSourceRoot().DIRECTORY_SEPARATOR.$asset->getSourcePath();
        $asset->setContent( \CoffeeScript\Compiler::compile($asset->getContent(), array('filename'=>$filename ) ));
    }
}
