<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * SAMPLE - Displays the available accounts
 */

// See login.php, it returns a FinTs instance that is already logged in.
/** @var \Fhp\FinTs $fints */
$fints = require_once 'login.php';

print_r($oneAccount = $fints->getAccounts());
