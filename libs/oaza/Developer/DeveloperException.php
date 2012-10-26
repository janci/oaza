<?php
/**
 * This file is part of the Oaza Framework (http://nette.org)
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */


namespace Oaza\Developer;
class DeveloperException  extends \Exception
{
   public function __construct($message="", $code=0){
        return parent::__construct($message, $code);
   }

}
