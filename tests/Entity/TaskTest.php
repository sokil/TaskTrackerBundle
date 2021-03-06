<?php

namespace Sokil\TaskStockBundle\Entity;

use Sokil\TaskStockBundle\Event\TaskChangeEvent;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    public function testNotifyPropertyChanged()
    {
        $task = new Task();
        $taskReflection = new \ReflectionClass($task);
        $idProperty = $taskReflection->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($task, 42);

        $event = new TaskChangeEvent();

        $task->addPropertyChangedListener($event);

        $task
            ->setName('hello')

        $this->assertSame(
            null,
            $event->getChanges()[42]['name']->getOldValue()
        );

        $this->assertSame(
            'hello',
            $event->getChanges()[42]['name']->getNewValue()
        );
    }
}