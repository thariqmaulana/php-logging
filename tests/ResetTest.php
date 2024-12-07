<?php

namespace Thariq\PhpLogging;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\GitProcessor;
use Monolog\Processor\HostnameProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\WebProcessor;
use PHPUnit\Event\Telemetry\MemoryUsage;
use PHPUnit\Framework\TestCase;

class ResetTest extends TestCase
{
  public function testReset()
  /**
   * untuk long running job
   */
  {
    $logger = new Logger(ResetTest::class);

    $logger->pushHandler(new StreamHandler('php://stderr'));
    $logger->pushHandler(new StreamHandler(__DIR__ . '../../log/app.log'));
    $logger->pushProcessor(new MemoryUsageProcessor());
    $logger->pushProcessor(new HostnameProcessor());
    
    for ($i=0; $i < 10000; $i++) { 
      $logger->info("perulangan ke $i");
      if ($i % 100 == 0) {
        $logger->reset();
        // jadi tiap kelipatan 100 dia direset dari memory
      }
    }
    
    self::assertEquals(2, sizeof($logger->getHandlers()));
  }
}