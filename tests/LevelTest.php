<?php

namespace Thariq\PhpLogging;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class LevelTest extends TestCase
{
  public function testLevel()
  {
    $logger = new Logger(LevelTest::class);

    $logger->pushHandler(new StreamHandler('php://stderr'));
    $logger->pushHandler(new StreamHandler(__DIR__ . '../../log/app.log'));
    $logger->pushHandler(new StreamHandler(__DIR__ . '../../log/error.log', Logger::ERROR));

    $logger->debug('debug');
    $logger->info('info');
    $logger->notice('notice');
    $logger->warning('warning');
    $logger->error('error');
    $logger->critical('critical');
    $logger->alert('alert');
    $logger->emergency('emergency');

    self::assertNotNull($logger);
  }
}