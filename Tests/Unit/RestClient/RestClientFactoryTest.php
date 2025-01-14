<?php

declare(strict_types=1);

/*
 * This file is part of the "jobrouter_connector" extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

namespace Brotkrueml\JobRouterConnector\Tests\Unit\RestClient;

use Brotkrueml\JobRouterConnector\Domain\Entity\Connection;
use Brotkrueml\JobRouterConnector\Domain\Repository\ConnectionRepository;
use Brotkrueml\JobRouterConnector\Exception\CryptException;
use Brotkrueml\JobRouterConnector\RestClient\RestClientFactory;
use Brotkrueml\JobRouterConnector\Service\Crypt;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

final class RestClientFactoryTest extends TestCase
{
    private ConnectionRepository&Stub $connectionRepositoryStub;
    private Crypt&Stub $cryptServiceStub;
    private RestClientFactory $subject;

    protected function setUp(): void
    {
        $this->connectionRepositoryStub = $this->createStub(ConnectionRepository::class);
        $this->cryptServiceStub = $this->createStub(Crypt::class);
        $this->subject = new RestClientFactory($this->connectionRepositoryStub, $this->cryptServiceStub);
    }

    /**
     * @test
     */
    public function createThrowsAuthenticationExceptionWhenPasswordCannotBeDecrypted(): void
    {
        $this->expectException(CryptException::class);
        $this->expectExceptionCode(1636467052);
        $this->expectExceptionMessage('The password of the connection with the handle "some handle" cannot be decrypted!');

        $cryptException = new CryptException('some crypt exception');

        $connection = Connection::fromArray([
            'uid' => 1,
            'name' => '',
            'handle' => 'some handle',
            'base_url' => '',
            'username' => '',
            'password' => 'some password',
            'timeout' => 0,
            'verify' => true,
            'proxy' => '',
            'jobrouter_version' => '',
            'disabled' => false,
        ]);

        $this->cryptServiceStub
            ->method('decrypt')
            ->with('some password')
            ->willThrowException($cryptException);

        $this->subject->create($connection);
    }
}
