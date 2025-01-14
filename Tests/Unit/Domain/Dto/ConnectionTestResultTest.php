<?php

declare(strict_types=1);

/*
 * This file is part of the "jobrouter_connector" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\JobRouterConnector\Tests\Unit\Domain\Dto;

use Brotkrueml\JobRouterConnector\Domain\Dto\ConnectionTestResult;
use PHPUnit\Framework\TestCase;

final class ConnectionTestResultTest extends TestCase
{
    /**
     * @test
     */
    public function toJsonReturnsCorrectJsonWhenNoErrorMessageIsGiven(): void
    {
        $subject = new ConnectionTestResult('');

        self::assertJsonStringEqualsJsonString('{"check": "ok"}', $subject->toJson());
    }

    /**
     * @test
     */
    public function toJsonReturnsCorrectJsonWhenErrorMessageIsGiven(): void
    {
        $subject = new ConnectionTestResult('some error message');

        self::assertJsonStringEqualsJsonString('{"error": "some error message"}', $subject->toJson());
    }
}
