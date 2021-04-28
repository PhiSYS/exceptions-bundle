<?php
declare(strict_types=1);

namespace PhiSYS\ExceptionsBundle\Http\Service;

use Symfony\Component\HttpFoundation\Response;

interface ApiResponseLoader
{
    public function __invoke(\Throwable $throwable): Response;
}
