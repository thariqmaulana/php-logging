<?php

namespace Thariq\PhpLogging;

use Monolog\Formatter\HtmlFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\GitProcessor;
use Monolog\Processor\HostnameProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\WebProcessor;
use PHPUnit\Event\Telemetry\MemoryUsage;
use PHPUnit\Framework\TestCase;

class FormatterTest extends TestCase
{
  public function testFormatter()
  /**
   * line formatter defaultnya
   * cuma bisa 1 formatter
   */
  {
    $logger = new Logger(FormatterTest::class);

    $handler = new StreamHandler(__DIR__ . '../../html.html');
    $handler->setFormatter(new HtmlFormatter());
    $logger->pushHandler($handler);

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