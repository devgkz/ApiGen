<?php declare(strict_types=1);

namespace ApiGen\Contracts\Parser\Reflection;

interface AbstractFunctionMethodReflectionInterface extends ReflectionInterface
{
    public function returnsReference(): bool;

    /**
     * @return ParameterReflectionInterface[]
     */
    public function getParameters(): array;
}
