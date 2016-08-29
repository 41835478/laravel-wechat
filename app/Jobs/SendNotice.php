<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Repositories\NoticeMessage;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotice extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $openid;
    protected $templateId,$url,$data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($openid,$templateId,$url,$data)
    {
        //
        $this->openid       = $openid;
        $this->templateId   = $templateId;
        $this->url          = $url;
        $this->data         = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(NoticeMessage $notice)
    {
        $notice->sendNotice($this->openid,$this->templateId,$this->url,$this->data);
    }
}
