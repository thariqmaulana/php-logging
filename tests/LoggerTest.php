<?php

namespace Thariq\PhpLogging;

use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
  public function testLogger()
  {
    // Kebiasaan membuat nama logger dengan nama lokasi class logger dibuat
    $logger = new Logger(LoggerTest::class);

    self::assertNotNull($logger);
  }
}