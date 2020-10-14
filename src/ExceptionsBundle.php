<?php
declare(strict_types=1);

namespace DosFarma\ExceptionsBundle;

use DosFarma\ExceptionsBundle\Http\DependencyInjection\Compiler\ApiExceptionListenerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class ExceptionsBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container
            ->addCompilerPass(new ApiExceptionListenerPass())
        ;
    }
}
