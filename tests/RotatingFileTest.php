<?php

namespace Thariq\PhpLogging;

use Monolog\Formatter\HtmlFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\GitProcessor;
use Monolog\Processor\HostnameProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\WebProcessor;
use PHPUnit\Event\Telemetry\MemoryUsage;
use PHPUnit\Framework\TestCase;

class RotatingFileTest extends TestCase
{
  public function testRotatingFile()
  /**
   * tidak bisa ke console
   */
  {
    $logger = new Logger(RotatingFileTest::class);
    // hanya 10 hari terakhir. ke 11 dihapus
    $logger->pushHandler(new RotatingFileHandler(__DIR__ . '../../log/app.log', 10, Logger::INFO));
    $logger->pushHandler(new StreamHandler('php://stderr'));

    $logger->info('tes');
    $logger->info('tes');
    $logger->info('tes');
    $logger->info('tes');
    
    
    self::assertEquals(1, sizeof($logger->getHandlers()));
  }
}