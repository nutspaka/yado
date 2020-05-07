<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

 /**
     * インスタンス
     *
     * @var Plans
     */
    private $xml;
    private $conditions;
    private $h_name;

    /**
     * 新しいメッセージインスタンスの生成
     *
     * @return void
     */
    public function __construct($xml,$conditions,$h_name)
    {
        $this->xml = $xml;
        $this->conditions = $conditions;
        $this->h_name = $h_name;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    
    public function build()
    {
        // return $this->from('example@example.com')
        // ->view('emails.orders.shipped');

        if($this->xml == 2){
            return $this->view('emails.expired')
            ->subject('宿泊日超過のお知らせ')
            ->with([
                'conditions' => $this->conditions,
                'h_name' => $this->h_name
            ]);
        }

        if($this->xml == 1){
            return $this->view('emails.accepted')
            ->subject('受付完了のお知らせ')
            ->with([
                'conditions' => $this->conditions,
                'h_name' => $this->h_name
            ]);
        }

        return $this->view('emails.stock')
        ->subject('空室発見のお知らせ')
        ->with([
            'xml' => $this->xml,
            'conditions' => $this->conditions,
            'h_name' => $this->h_name
        ]);
    }
    

    
}
