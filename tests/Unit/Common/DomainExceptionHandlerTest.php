<?php

declare(strict_types=1);

namespace Tests\Unit\Common;

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Mockery;
use Modules\Common\Application\Exceptions\DomainException;
use Modules\Common\Application\Exceptions\DomainExceptionHandler;
use Modules\Common\Application\Exceptions\UnauthorizedException;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DomainExceptionHandlerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    private function createHandler(): DomainExceptionHandler
    {
        $container = Mockery::mock(Container::class);

        return new DomainExceptionHandler($container);
    }

    /** @test */
    public function it_handles_domain_exception_correctly(): void
    {
        $handler = $this->createHandler();
        $exception = new class extends DomainException
        {
            public function __construct()
            {
                parent::__construct('Test error', 418);
            }
        };

        $response = $handler->render(new Request, $exception);

        $this->assertEquals(418, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertEquals([
            'error' => 'Test error',
            'code' => 418,
        ], json_decode($response->getContent(), true));
    }

    /** @test */
    public function it_passes_other_exceptions_to_parent_handler(): void
    {
        $handler = $this->createHandler();
        $exception = new RuntimeException('Generic error');

        $response = $handler->render(new Request, $exception);

        $this->assertEquals(500, $response->getStatusCode());
    }

    /** @test */
    public function it_handles_unauthorized_exception_specific_status(): void
    {
        $handler = $this->createHandler();
        $exception = new UnauthorizedException;

        $response = $handler->render(new Request, $exception);

        $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
    }
}
