<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza;

use Oaza\Asset\AssetsLoader;
use Oaza\Asset\JavascriptLibrary;

/**
 * Oaza framework service
 */
class Oaza extends Object
{
    const VERSION = "20121118";

    /** @var string */
    private $oazaRootdir;

    /** @var string */
    private $oazaPublicDir;

    /** @var \Oaza\Asset\AssetsLoader */
    private $assetLoader;

    /** @var array */
    private $javascriptLibraries;

    /** @var \Oaza\Application\Adapter\IDriver */
    private $databaseAdapter;

    public function __construct(\Oaza\Application\Adapter\IDriver $databaseAdapter){
         $this->databaseAdapter = $databaseAdapter;
         $this->oazaRootdir = dirname(dirname(__FILE__));
         $this->oazaPublicDir = $this->oazaRootdir.DIRECTORY_SEPARATOR."public";

         $tmpDir = $this->oazaRootdir.DIRECTORY_SEPARATOR."temp";
         $cacheDir = $tmpDir.DIRECTORY_SEPARATOR."cache";

         if(!file_exists($tmpDir)) mkdir($tmpDir);
         if(!file_exists($cacheDir)) mkdir($cacheDir);

         $this->assetLoader = new AssetsLoader($cacheDir);
    }

    /**
     * Add javascript library or framework
     * @param $library
     */
    public function addJavascriptLibrary($library){
        if(!isset($this->javascriptLibraries[$library])) {
            $ds = DIRECTORY_SEPARATOR;
            $source = $this->oazaPublicDir."{$ds}javascript{$ds}{$library}";
            $this->assetLoader->addDirectory(AssetsLoader::JAVASCRIPT, $source);
        }

        $this->javascriptLibraries[$library] = true;
    }

    /**
     * Returns current database adapter
     * @return Application\Adapter\IDriver
     */
    public function getDatabaseAdapter(){
        return $this->databaseAdapter;
    }

    /**
     * Load javascript and cascades styles for Oaza framework
     */
    public function registerExternalSources(){

        $ds = DIRECTORY_SEPARATOR;
        if(defined(APP_DIR)) {
            //if(file_exists(APP_DIR).$ds."controls".$ds."*");
        }

        $this->assetLoader->addDirectory(AssetsLoader::COFFEE, $this->oazaPublicDir."{$ds}coffee{$ds}*.coffee");
        $this->assetLoader->addDirectory(AssetsLoader::CSS, $this->oazaPublicDir."{$ds}css{$ds}*.css");

        $this->addJavascriptLibrary(JavascriptLibrary::JQUERY);
        $this->addJavascriptLibrary(JavascriptLibrary::JQUERY_UI);
        $this->addJavascriptLibrary(JavascriptLibrary::JQUERY_TOOLS);
    }

    public function buildExternalSources(){
        $this->assetLoader->build();
    }

    /**
     * Install Oaza framework to your application
     */
    public function install(){

    }

    /**
     * Update Oaza framework database to any version, default is current version
     */
    public function update($toVersion = self::VERSION){

    }

}