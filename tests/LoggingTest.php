<?php

namespace Thariq\PhpLogging;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class LoggingTest extends TestCase
{
  public function testLogging()
  {
    $logger = new Logger(LoggingTest::class);

    $logger->pushHandler(new StreamHandler('php://stderr'));
    $logger->pushHandler(new StreamHandler(__DIR__ . '../../log/app.log'));

    $logger->info('Sedang belajar php logging coyy');
    $logger->info('Info bos');
    
    self::assertEquals(2, sizeof($logger->getHandlers()));
  }
}