<?php
    namespace App\Notifications;

    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;

    class AddInvoice extends Notification
    {
            use Queueable;

            protected $invoiceDetails;

            /**
            * Create a new notification instance.
            */
            public function __construct($invoiceDetails)
            {
            $this->invoiceDetails = $invoiceDetails;
            }

            /**
            * Get the notification's delivery channels.
            *
            * @return array<int, string>
            */
            public function via(object $notifiable): array
            {
            return ['database'];
            }

            /**
            * Get the array representation of the notification.
            *
            * @return array<string, mixed>
            */
            public function toArray(object $notifiable): array
            {
            return [
            'data' => $this->invoiceDetails,
            ];
            }

            public function toDatabase(object $notifiable): array
            {
            return [
            'invoice_id' => $this->invoiceDetails['id'],
            'invoice_number' => $this->invoiceDetails['number'],
            'amount' => $this->invoiceDetails['amount'],
            'user_id' => $this->invoiceDetails['user_id'],
            ];
            }
    }

