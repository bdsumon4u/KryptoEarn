<?php

namespace App\Mail;

use App\Models\Admin;
use App\Models\Withdraw;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public Withdraw $withdraw;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Withdraw $withdraw)
    {
        $this->withdraw = $withdraw;
        debug($withdraw);
        info('Withdraw:', $withdraw->toArray());
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to(Admin::select('email')->get()->pluck('email')->toArray())
            ->markdown('emails.withdraw-request');
    }
}
