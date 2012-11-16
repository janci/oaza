<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Asset;


use Assetic\Asset\AssetCache;
use Assetic\Asset\FileAsset;
use Assetic\Cache\FilesystemCache;
use Assetic\Filter\Yui;

/**
 * Asset loader
 */
class AssetsLoader extends \Oaza\Object
{
    const DEVELOPMENT='dev';
    const PRODUCTION='prod';

    const COFFEE = 0x001;
    const JAVASCRIPT = 0x010;
    const CSS = 0x100;

    /** @var string */
    private $mode;

    /** @var array */
    private $dirs;

    /** @var string */
    private $cacheDir;

    /** @var string */
    private $wwwDir;

    public function __construct($cacheDir="/tmp", $wwwDir=""){
        $this->cacheDir = $cacheDir;
        $this->wwwDir = $wwwDir;
    }

    /**
     * Register new directory for asset type
     * @param $type
     * @param $directory
     */
    public function addDirectory($type, $directory){
        if($type & self::COFFEE) {
            $this->dirs[self::COFFEE][] = $directory;
        }

        if( $type & self::JAVASCRIPT) {
            $this->dirs[self::JAVASCRIPT][] = $directory;
        }

        if( $type & self::CSS) {
            $this->dirs[self::CSS][] = $directory;
        }

    }

    /**
     * Sets environment
     * @param $environment
     */
    public function setEnvironment($environment){
        $this->mode = $environment;
    }

    /**
     * Build public files to www directory
     */
    public function build(){
        if($this->mode == self::DEVELOPMENT) return;

        if(isset($this->dirs[self::COFFEE])) {
            \CoffeeScript\Init::load();

            foreach($this->dirs[self::COFFEE] as $file )
                $assetFiles[] = new \Assetic\Asset\GlobAsset($file);

            $coffeeCollection = new \Assetic\Asset\AssetCollection(
                $assetFiles,
                array(new \Oaza\Asset\Filter\PHPCoffeeScriptFilter())
            );

            $coffee = new AssetCache(
                $coffeeCollection,
                new FilesystemCache($this->cacheDir)
            );
        }

        $assetFiles = array();
        if(isset($this->dirs[self::CSS])) {
            foreach($this->dirs[self::CSS] as $file )
                $assetFiles[] = new \Assetic\Asset\GlobAsset($file);

            $cssCollection = new \Assetic\Asset\AssetCollection(
                $assetFiles,
                array() //new \Assetic\Filter\CssMinFilter()
            );

            $css = new AssetCache(
                $cssCollection,
                new FilesystemCache($this->cacheDir)
            );
        }

        $assetFiles = array();
        if(isset($this->dirs[self::JAVASCRIPT])) {
            foreach($this->dirs[self::JAVASCRIPT] as $file )
                $assetFiles[] = new \Assetic\Asset\GlobAsset($file);

            $javascriptCollection = new \Assetic\Asset\AssetCollection(
                $assetFiles,
                array() //new \Assetic\Filter\JSMinFilter()
            );

            $js = new AssetCache(
                $javascriptCollection,
                new FilesystemCache($this->cacheDir)
            );
        }

        if(isset($js))  {
            $cjs = $js->dump();
            if(!file_exists("javascript.build.css") ||  md5(file_get_contents("javascript.build.js")) != md5($cjs) )
                file_put_contents("javascript.build.js", $cjs);
        }

        if(isset($coffee)) {
            $ccoffee = $coffee->dump();
            if(!file_exists("coffee.build.css") || md5(file_get_contents("coffee.build.js")) != md5($ccoffee) )
                file_put_contents("coffee.build.js", $ccoffee);
        }

        if(isset($css)) {
            $ccss = $css->dump();
            if(!file_exists("css.build.css") || md5(file_get_contents("css.build.css")) != md5($ccss) )
                file_put_contents("css.build.css", $css->dump());
        }

    }

}
