<?php
use Prosper\Query;
require_once('simpletest/autorun.php');
require_once('../lib/Query.php');
require_once('../lib/adapters/_common_.php');

$parts = explode('/', $_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF']);
array_pop($parts);
define('ROOT', implode('/', $parts) . '/');

class AllTests extends TestSuite {

  function AllTests() {
    $this->TestSuite('All Tests');
    $this->addFile(ROOT . 'mysql/mysql_suite.php');
  }

}



?>