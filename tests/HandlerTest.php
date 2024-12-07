<?php

namespace Thariq\PhpLogging;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class HandlerTest extends TestCase
{
  public function testHandler()
  {
    $logger = new Logger(HandlerTest::class);

    $logger->pushHandler(new StreamHandler('php://stderr'));
    $logger->pushHandler(new StreamHandler(__DIR__ . '../log/app.log'));
    
    self::assertEquals(2, sizeof($logger->getHandlers()));
  }
}