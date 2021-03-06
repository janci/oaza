--
-- This file is part of the Oaza Framework
--
-- Copyright (c) 2012 Jan Svantner (http://www.janci.net)
--
-- For the full copyright and license information, please view
-- the file license.txt that was distributed with this source code.
--
-- @author Filip Vozar

CREATE TABLE IF NOT EXISTS component (
    id INTEGER PRIMARY KEY,
    control_name TEXT NOT NULL,
    properties TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS translator (
    id INTEGER PRIMARY KEY,
    keyword TEXT NOT NULL,
    language TEXT NOT NULL,
    count INTEGER NOT NULL,
    translate TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS router (
    pageId INTEGER PRIMARY KEY,
    module TEXT,
    presenter TEXT NOT NULL,
    action TEXT NOT NULL,
    path TEXT NOT NULL,
    expire TEXT,
    previous_id INTEGER
);