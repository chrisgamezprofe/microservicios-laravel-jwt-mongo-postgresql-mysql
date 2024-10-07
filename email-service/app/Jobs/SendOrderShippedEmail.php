<?php

namespace App\Jobs;

use App\Mail\OrderShipped;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrderShippedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $fromAddress;
    public $toAddress;
    public $subject;
    public $contentBody;
    /**
     * Create a new job instance.
     */
    public function __construct($order,$from,$to,$sub,$content)
    {
        $this->order = $order;
        $this->fromAddress = $from;
        $this->toAddress = $to;
        $this->subject = $sub;
        $this->contentBody = $content;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send(new OrderShipped($this->order,$this->fromAddress,$this->toAddress,$this->subject,$this->contentBody));
    }
}
