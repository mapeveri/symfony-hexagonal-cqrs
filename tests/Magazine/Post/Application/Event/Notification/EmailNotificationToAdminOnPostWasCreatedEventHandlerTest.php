<?php

declare(strict_types=1);

namespace App\Tests\Magazine\Post\Application\Event\Notification;

use App\Magazine\Post\Application\Event\Notification\EmailNotificationToAdminOnPostWasCreatedEventHandler;
use App\Tests\Magazine\Post\Application\Command\NewPostEmailAdmin\NewPostEmailAdminCommandMother;
use App\Tests\Magazine\Post\Domain\Event\PostWasCreatedEventMother;
use App\Tests\Magazine\Post\PostUnitTestCase;
use function Lambdish\Phunctional\apply;

final class EmailNotificationToAdminOnPostWasCreatedEventHandlerTest extends PostUnitTestCase
{
    private EmailNotificationToAdminOnPostWasCreatedEventHandler $SUT;

    public function setUp(): void
    {
        $this->SUT = new EmailNotificationToAdminOnPostWasCreatedEventHandler($this->commandBus());

        parent::setUp();
    }

    public function testSendEmailAfterCreatePost()
    {
        $event = PostWasCreatedEventMother::create();

        $command = NewPostEmailAdminCommandMother::create([
            'id' => $event->aggregateId(),
            'title' => $event->title(),
            'content' => $event->content()
        ]);

        $this->shouldDispatchCommand($command);

        apply($this->SUT, [$event]);
    }
}