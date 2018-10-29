<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Clase que envía correo utilizando la phpmailer
 * @autor 		: JZDP
 * @param 		: mixed $mix Cadena, objeto, arreglo a mostrar
 * @return  	: Cadena preformateada
 */
class Correo {


    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('session');
        $this->CI->config->load('email');
    }

    public function enviar_correo($datos = array()) {
        //$this->CI->load->add_package_path(APPPATH.'third_party/phpmailer/')->library('Phpmailerautoload');
        $autoloader = APPPATH.'third_party/phpmailer/PHPMailerAutoload.php';
        @ include_once $autoloader;
        $resultado = array('result'=>false, 'msg'=>'');

        $mail = new PHPMailer;

        $mail->SMTPDebug = 3;                               // Enable verbose debug output

        //$mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $this->CI->config->item('email')['host'];  // Specify main and backup SMTP servers
        //$mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $this->CI->config->item('email')['username'];                 // SMTP username
        $mail->Password = $this->CI->config->item('email')['password'];                           // SMTP password
        $mail->SMTPSecure = $this->CI->config->item('email')['crypt'];                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $this->CI->config->item('email')['port'];                                    // TCP port to connect to
        //pr($this->CI->config->item('email'));
        $mail->setFrom($this->CI->config->item('email')['setFrom']['email'], $this->CI->config->item('email')['setFrom']['name']);
        if(isset($datos['addAddress']) && !empty($datos['addAddress'])){
            foreach ($datos['addAddress'] as $destinatario) {
                $mail->addAddress($destinatario['correo'], $destinatario['nombre']);     // Add a recipient
            }
        }
        if(isset($datos['addReplyTo']) && !empty($datos['addReplyTo'])){
            foreach ($datos['addReplyTo'] as $responder) {
                $mail->addReplyTo($responder['correo'], $responder['nombre']);     // Add a recipient
            }
        }
        if(isset($datos['addCC']) && !empty($datos['addCC'])){
            foreach ($datos['addCC'] as $cc) {
                $mail->addCC($cc['correo'], $cc['nombre']);
            }
        }
        if(isset($datos['addBCC']) && !empty($datos['addBCC'])){
            foreach ($datos['addBCC'] as $bcc) {
                $mail->addBCC($bcc['correo'], $bcc['nombre']);
            }
        }

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $datos['subject'];
        $mail->Body    = $datos['body'];
        if(isset($datos['altBody']) && !empty($datos['altBody'])){
            $mail->AltBody = $datos['altBody'];
        }

        if(!@$mail->send()) {
            $resultado['result'] = false;
            $resultado['msg'] = 'Error al enviar: ' . $mail->ErrorInfo;
        } else {
            $resultado['result'] = true;
            $resultado['msg'] = 'Mensaje fue enviado satisfactoriamente.';
        }
        return $resultado;
    }
}