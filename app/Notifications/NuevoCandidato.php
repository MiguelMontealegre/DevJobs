<?php

namespace App\Notifications;

use App\Models\Candidato;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NuevoCandidato extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    //AQUI LE PASAMOS DATOS DESDE UN CONTROLADOR
    public function __construct($vacante, $id_vacante)
    {
        $this->vacante = $vacante;      //Aqui asignamos la variable que contiene el titulo de la vacante a este objeto ... La variable que contiene el titulo se define en el controlador y esta ubicada en los parentesiis de "NuevoCandidato"  linea 114
 
        $this->id_vacante = $id_vacante;  //Le queremos pasar el id de la vacante para asi en la vista crear un link que nos lleve a ver todos los candidatos que se estan postulando a esa vacante
     
    }




    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];    //Aqui definimos que tipo de notificaciones vamos a usar en el proyecto
    }




    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    //CONTENIDO DEL EMAIL QUE SE VA A ENVIAR
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Has recibido un nuevo candidato en tu vacante.')
                    ->line('La vacante es:' . $this->vacante)   //Aqui concatenamos con el "." el texto con el objeto a el cual le asignamos la variable que contiene el titulo de la vacante
                    ->action('Visita Modern-Work', url('/'))
                    ->line('Gracias por usar Modern-Work')
                    ->line('By Miguel Montealegre');
    }





    //NOTIFICACIONES TIPO DATABASE
    public function toDatabase($notifiable)
    {
         return[
             'vacante' => $this->vacante,                //Lo que agreguemos en este arreglo se va a guardar en el campo de "data" en la tabla de notications
            
            'id_vacante' =>$this->id_vacante
            
            ]; 

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
