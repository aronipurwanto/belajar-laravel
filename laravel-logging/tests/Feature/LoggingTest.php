<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LoggingTest extends TestCase
{
    public function testLogging()
    {
        Log::info('Log info');
        Log::warning('Log warning');
        Log::error('Log Error');
        Log::critical('Log critical');

        self::assertTrue(true);
    }

    public function testContext()
    {
        Log::info('Log info',['user'=>'ahmadroni']);
        self::assertTrue(true);
    }

    public function testWithContext()
    {
        Log::withContext(['userId' => 'ahmadroni', 'isMember' => true, 'email'=>'ahmadroni@gmail.com']);
        Log::info('Log info with context');
        Log::warning('Log Warning with context');
        Log::error('Log Error with context');
        Log::critical('Log Critical with context');
        self::assertTrue(true);
    }

    public function testWithChannel()
    {
        Log::withContext(['userId' => 'ahmadroni', 'isMember' => true, 'email'=>'ahmadroni@gmail.com']);

        $stdLogger = Log::channel('stderr');
        $stdLogger->error('Log error with channel');

        self::assertTrue(true);
    }

    public function testFileHandler()
    {
        $file = Log::channel('file');
        $file->info('Log info with file handler');
        $file->warning('Log Warning with file handler');
        $file->error('Log Error with file handler');
        $file->critical('Log Critical with file handler');

        self::assertTrue(true);
    }


}
