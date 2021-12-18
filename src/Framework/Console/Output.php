<?php

namespace Framework\Console;

class Output
{
    public function write(string $message): void
    {
        echo $message;
    }

    public function writeLn(string $message): void
    {
        echo $message . PHP_EOL;
    }

    public function process($message): string
    {
        return strtr($message, [
            '<comment>' => "\033[33m", '</comment>' => "\033[0m",
            '<info>' => "\033[32m", '</info>' => "\033[0m",
        ]);
    }

    public function comment($message): void
    {
        $this->writeLn("\033[33m" . $message . "\033[0m");
    }

    public function info($message): void
    {
        $this->writeLn("\033[32m" . $message . "\033[0m");
    }
}