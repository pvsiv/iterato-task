<?php

declare(strict_types=1);

namespace App\Tests\Messenger;

use App\Model\Message;
use App\Service\Messenger;
use App\Service\SenderInterface;
use PHPUnit\Framework\TestCase;

final class MessengerTest extends TestCase
{
    public function testShouldInvokeOnlySupportedSender(): void
    {
        $unsupportedSender = $this->createConfiguredMock(
            SenderInterface::class,
            [
                'supports' => false,
            ]
        );

        $unsupportedSender->expects($this->never())
            ->method('send')
        ;

        $supportedSender = $this->createConfiguredMock(
            SenderInterface::class,
            [
                'supports' => true,
            ]
        );

        $supportedSender->expects($this->once())
            ->method('send')
        ;

        $messenger = new Messenger([
            $unsupportedSender,
            $supportedSender,
        ]);

        $message = new Message();
        $messenger->send($message);
    }
}