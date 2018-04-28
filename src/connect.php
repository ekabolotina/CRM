<?php

use Symfony\Component\Yaml\Yaml;

$configuration = Yaml::parseFile(constant('CONFIG_PATH'))['database'];

$link = new mysqli($configuration['hostname'], $configuration['username'], $configuration['password'], $configuration['name']);
$link->query('SET NAMES utf8');
