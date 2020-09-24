<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Convite extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $nome;
    public $usuario;
    public $projeto;
    public $senha;
    public $link;

    public function __construct($nome,$projeto,$usuario,$senha,$link)
    {
        $this->nome = $nome;
        $this->projeto = $projeto;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->link = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->greeting('Olá '.$this->nome.', sou '.$this->usuario) 
                ->line('Estou te convidando para participar do projeto '.$this->projeto)
                ->line('Ao acessar o sistema utilize o link e a senha disponibilizados abaixo')
                ->line('Qualquer dúvida ligue para 2013 e procure pelo biel')
                ->line('Senha: '.$this->senha)
                ->action('Link de Acesso',$link)
                ->line('No aguardo da sua resposta !');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
