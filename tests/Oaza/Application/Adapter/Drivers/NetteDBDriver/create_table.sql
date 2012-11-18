--
-- This file is part of the Oaza Framework
--
-- Copyright (c) 2012 Jan Svantner (http://www.janci.net)
--
-- For the full copyright and license information, please view
-- the file license.txt that was distributed with this source code.
--
-- @author Filip Vozar
--

CREATE TABLE component (
    'id' INTEGER PRIMARY KEY,
    'control_name' TEXT NOT NULL,
    'properties' TEXT NOT NULL
);