<?php

namespace Thariq\PhpLogging;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class ContextTest extends TestCase
{
  public function testContext()
  {
    $logger = new Logger(ContextTest::class);

    $logger->pushHandler(new StreamHandler('php://stderr'));
    
    // biasanya data untuk tracking
    $logger->info('Log message', ['username' => 'thariq']);
    $logger->info('try to login', ['username' => 'thariq']);
    $logger->info('successful login', ['username' => 'thariq']);

    
    self::assertEquals(1, sizeof($logger->getHandlers()));
  }
}