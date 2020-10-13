<?php
declare(strict_types=1);

namespace DosFarma\ExceptionsBundle\Http\DependencyInjection\Compiler;

use DosFarma\ExceptionsBundle\Http\EventListener\ApiExceptionListener;
use DosFarma\ExceptionsBundle\Http\Service\JsonApiResponseLoader;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

final class ApiExceptionListenerPass implements CompilerPassInterface
{
    const API_RESPONSE_LOADER_SERVICE_ID = 'DosFarma\ExceptionsBundle\Http\Service\ApiResponseLoader';

    public function process(ContainerBuilder $container)
    {
        if (false === $container->has(self::API_RESPONSE_LOADER_SERVICE_ID)) {
            $responseLoaderDefinition = new Definition(JsonApiResponseLoader::class, []);

            $container->addDefinitions(
                [
                    self::API_RESPONSE_LOADER_SERVICE_ID => $responseLoaderDefinition,
                ],
            );
        }

        $apiExceptionListener = new Definition(
            ApiExceptionListener::class,
            [
                new Reference(self::API_RESPONSE_LOADER_SERVICE_ID),
            ],
        );
        $apiExceptionListener
            ->addTag('kernel.event_listener')
            ->addTag('kernel.exception')
        ;

        $container->addDefinitions(
            [
                ApiExceptionListener::class => $apiExceptionListener,
            ],
        );
    }
}
