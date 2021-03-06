--TEST--
Test unfinished fiber
--SKIPIF--
<?php include __DIR__ . '/include/skip-if.php';
--FILE--
<?php

$fiber = new Fiber(function (): void {
    try {
        echo "fiber\n";
        echo Fiber::suspend();
        echo "after suspend\n";
    } catch (Throwable $exception) {
        echo "exit exception caught!\n";
    }

    echo "end of fiber should not be reached\n";
});

$fiber->start();

echo "done\n";

--EXPECT--
fiber
done
