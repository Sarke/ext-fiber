--TEST--
Immediate throw from fiber
--SKIPIF--
<?php include __DIR__ . '/include/skip-if.php';
--FILE--
<?php

require dirname(__DIR__) . '/scripts/bootstrap.php';

$loop = new Loop;

$fiber = Fiber::create(function (): void {
    throw new Exception('test');
});

$loop->defer(fn() => $fiber->start());

Fiber::suspend(new Promise($loop), $loop);

--EXPECTF--
Fatal error: Uncaught Exception: test in %s:%d
Stack trace:
#0 [fiber function](0): {closure}()
#1 {main}

Next FiberExit: Uncaught Exception thrown from Fiber::run(): test in %s:%d
Stack trace:
#0 %s(%d): Fiber->start()
#1 %s(%d): {closure}()
#2 %s(%d): Loop->tick()
#3 [fiber function](0): Loop->run()
#4 {main}
  thrown in %s on line %d
