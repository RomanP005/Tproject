<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Вам назначена новая задача')
            ->greeting('Здравствуйте, ' . $notifiable->name)
            ->line('Вам назначена задача: **' . $this->task->title . '**')
            ->line('Проект: ' . $this->task->project->title)
            ->line('Дедлайн: ' . $this->task->deadline->format('d.m.Y'))
            ->action('Посмотреть задачу', route('tasks.show', $this->task))
            ->line('Спасибо за использование нашего приложения!');
    }
}
