<?php
declare(strict_types=1);

namespace Tests\Unit\Common;

use Modules\Common\Domain\Exceptions\IncorrectEmailFormatException;
use Modules\Common\Domain\Types\Email;
use Tests\TestCase;

class EmailTest extends TestCase
{
    /** @test */
    public function it_creates_email_with_valid_format(): void
    {
        $email = new Email('valid@example.com');

        $this->assertInstanceOf(Email::class, $email);
        $this->assertEquals('valid@example.com', $email->jsonSerialize());
    }

    /** @test */
    public function it_throws_exception_for_invalid_email(): void
    {
        $this->expectException(IncorrectEmailFormatException::class);

        new Email('invalid-email');
    }

    /** @test */
    public function it_serializes_to_string(): void
    {
        $email = new Email('test@domain.com');

        $this->assertIsString($email->jsonSerialize());
        $this->assertSame('test@domain.com', $email->jsonSerialize());
    }
}
