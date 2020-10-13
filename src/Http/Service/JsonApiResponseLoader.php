<?php
declare(strict_types=1);

namespace DosFarma\ExceptionsBundle\Http\Service;

use DosFarma\Exceptions\Api\Domain\ApiException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class JsonApiResponseLoader implements ApiResponseLoader
{
    public function __invoke(\Throwable $throwable): JsonResponse
    {
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        $content = [
            'message' => $throwable->getMessage(),
            'error_code' => $throwable->getCode(),
        ];

        if ($throwable instanceof ApiException) {
            $statusCode = $throwable->statusCode();
            $content = $throwable;
        }

        return new JsonResponse(
            $content,
            $statusCode,
            [],
            false,
        );
    }
}
