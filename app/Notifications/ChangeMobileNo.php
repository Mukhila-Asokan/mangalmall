<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Support\Facades\Session;
use Modules\VenueAdmin\Models\VenueUser;

class ChangeMobileNo extends Notification
{
    use Queueable;

    public $newMobile;
    public $statusMessage;

    /**
     * Create a new notification instance.
     */
    public function __construct($newMobile,$statusMessage)
    {
        $this->newMobile = $newMobile;
        $this->statusMessage = $statusMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    // Database Notification
    public function toDatabase($notifiable)
    {
        $venueuserid = Session::get('venueuserid');
    $venueuser = VenueUser::find($venueuserid); // Use find() instead of where()->first()

    if (!$venueuser) {
        \Log::error("VenueUser not found for venueuserid: {$venueuserid}");
        return [
            'user_id' => $venueuserid ?? 'Unknown',  
            'user_name' => 'Unknown User',  
            'email' => 'Unknown Email',  
            'city' => 'Unknown City',  
            'role' => 'Unknown Role',  
            'new_mobile' => $this->newMobile,
            'type' => 'Change Mobile Number',
            'message' => "User (Unknown) requested to change their mobile number to {$this->newMobile}."
        ];
    }

    return [
        'user_id' => $venueuser->id,  
        'user_name' => $venueuser->name ?? 'Unknown',  
        'email' => $venueuser->email ?? 'Unknown',  
        'city' => $venueuser->city ?? 'Unknown',  
        'role' => $venueuser->role ?? 'Unknown',  
        'new_mobile' => $this->newMobile,
        'type' => 'Change Mobile Number',
        'redirect_url' => '',
        'message' => "User " . $venueuser->name . " requested to change their mobile number to {$this->newMobile}."
    ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Mobile Number Change Request')
                    ->line("Your request to change your mobile number to {$this->newMobile} has been received.")
                    ->line('The admin will review your request and notify you soon.')
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->statusMessage,
            'new_mobile' => $this->newMobile,
        ];
    }
}
