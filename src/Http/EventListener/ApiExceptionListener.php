<?php
declare(strict_types=1);

namespace PhiSYS\ExceptionsBundle\Http\EventListener;

use PhiSYS\ExceptionsBundle\Http\Service\ApiResponseLoader;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApiExceptionListener
{
    private ApiResponseLoader $responseLoader;

    public function __construct(ApiResponseLoader $responseLoader)
    {
        $this->responseLoader = $responseLoader;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();

        $event->setResponse(($this->responseLoader)($throwable));
    }
}
