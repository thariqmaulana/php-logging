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

class ProcessorTest extends TestCase
{
  public function testProcessor()
  /**
   * Apa beda dengan context? 
   * context itu untuk spesifik
   * processor general. di exec terus
   */
  {
    $logger = new Logger(ProcessorTest::class);

    $logger->pushHandler(new StreamHandler('php://stderr'));
    // $logger->pushProcessor(new GitProcessor());
    // $logger->pushProcessor(new WebProcessor());
    $logger->pushProcessor(new MemoryUsageProcessor());
    $logger->pushProcessor(new HostnameProcessor());
    $logger->pushProcessor(function ($record) {
      $record['extra']['extranya'] = 'tinggal ditimpa saja';
      $record['extra']['author'] = 'Thariq';
      var_dump($record);
      return $record;
    });

    $logger->info('log message', ['username' => 'thariq']);
    
    
    self::assertEquals(1, sizeof($logger->getHandlers()));
  }
}