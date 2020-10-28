<?php
declare(strict_types=1);

namespace DosFarma\ExceptionsBundle\Http\EventListener;

use DosFarma\ExceptionsBundle\Http\Service\ApiResponseLoader;
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
