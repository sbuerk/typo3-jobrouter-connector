<?php

declare(strict_types=1);

/*
 * This file is part of the "jobrouter_connector" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\JobRouterConnector\Tests\Unit\Exception;

use Brotkrueml\JobRouterConnector\Exception\ConnectionNotFoundException;
use PHPUnit\Framework\TestCase;

final class ConnectionNotFoundExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function forUid(): void
    {
        $actual = ConnectionNotFoundException::forUid(42);

        self::assertInstanceOf(ConnectionNotFoundException::class, $actual);
        self::assertSame('Connection with uid "42" not found.', $actual->getMessage());
        self::assertSame(1672478103, $actual->getCode());
    }
}
