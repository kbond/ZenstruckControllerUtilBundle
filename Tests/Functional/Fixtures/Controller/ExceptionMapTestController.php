<?php

namespace Zenstruck\ControllerUtilBundle\Tests\Functional\Fixtures\Controller;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class ExceptionMapTestController
{
    public function mappedExceptionAction()
    {
        throw new \InvalidArgumentException();
    }

    public function nonMappedExceptionAction()
    {
        throw new \RuntimeException();
    }
}
