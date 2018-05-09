<?php

$status = [];

if($_SESSION['user'])
    unset($_SESSION['user']);
else
    die;
