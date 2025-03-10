<?php

declare(strict_types=1);

namespace Tests\Unit\Common;

use Illuminate\Support\Facades\Gate;
use Mockery;
use Modules\Common\Application\Exceptions\UnauthorizedException;
use Modules\Common\Infrastructure\Helpers\Authorization;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_throws_unauthorized_exception_when_gate_denies(): void
    {
        Gate::shouldReceive('denies')->once()->with('test-ability', [])->andReturn(true);

        $this->expectException(UnauthorizedException::class);

        Authorization::check('test-ability');
    }

    /** @test */
    public function it_allows_action_when_gate_allows(): void
    {
        Gate::shouldReceive('denies')->once()->with('test-ability', ['arg'])->andReturn(false);

        Authorization::check('test-ability', ['arg']);

        $this->assertTrue(true);
    }

    /** @test */
    public function it_throws_unauthorized_exception_when_condition_false(): void
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage('Custom message');

        Authorization::allowIf(false, 'Custom message');
    }

    /** @test */
    public function it_allows_action_when_condition_true(): void
    {
        Authorization::allowIf(true);

        $this->assertTrue(true);
    }
}
