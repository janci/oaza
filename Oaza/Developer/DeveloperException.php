<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */


namespace Oaza\Developer;

/**
 * Exception for developers
 *
 * @author  Jan Svantner
 */
class DeveloperException  extends \Exception
{
   public function __construct($message="", $code=0){
        return parent::__construct($message, $code);
   }

}
