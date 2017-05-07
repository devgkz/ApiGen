<?php declare(strict_types=1);

namespace ApiGen\Tests\Generator\Resolvers\ElementResolver;

use ApiGen\Reflection\Contract\Reflection\ReflectionInterface;
use ApiGen\Reflection\Contract\Reflection\MethodReflectionInterface;
use ApiGen\Tests\MethodInvoker;
use PHPUnit_Framework_MockObject_MockObject;

final class ResolveIfParsedTest extends AbstractElementResolverTest
{
    public function test(): void
    {
        $methodReflectionMock = $this->createMethodReflectionMock();
        $this->parserStorage->setFunctions([
            'SomeFunction' => $methodReflectionMock
        ]);

        $resolvedElement = MethodInvoker::callMethodOnObject(
            $this->elementResolver,
            'resolveIfParsed',
            ['SomeFunction()', $methodReflectionMock]
        );

        $this->assertInstanceOf(ReflectionInterface::class, $resolvedElement);
    }

    public function testMissingElement(): void
    {
        $reflectionMock = $this->createMethodReflectionMock();

        $resolvedElement = MethodInvoker::callMethodOnObject(
            $this->elementResolver,
            'resolveIfParsed',
            ['NotPresent', $reflectionMock]
        );

        $this->assertNull($resolvedElement);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|MethodReflectionInterface
     */
    private function createMethodReflectionMock()
    {
        $methodReflectionMock = $this->createMock(MethodReflectionInterface::class);
        $methodReflectionMock->method('getName')
            ->willReturn('SomeFunction');
        $methodReflectionMock->method('isDocumented')
            ->willReturn(true);

        return $methodReflectionMock;
    }
}
