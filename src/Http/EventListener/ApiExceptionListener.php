<?php
declare(strict_types=1);

namespace DosFarma\ExceptionsBundle\Http\EventListener;

use DosFarma\ExceptionsBundle\Http\Service\JsonApiResponseLoader;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ApiExceptionListener
{
    private JsonApiResponseLoader $responseLoader;

    public function __construct(JsonApiResponseLoader $responseLoader)
    {
        $this->responseLoader = $responseLoader;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();

        $event->setResponse(($this->responseLoader)($throwable));
    }
}
