<?php

/**
 * Name         : EmailManager.php
 * Date         : Jan 2016
 * Version      : 1.0
 * Author       : Stefan
 * Description  : Entity Class. Provides a collection of services to assist
 *              : with Email functionallity
 * Notes        : The development of this functionality, deppends on 
 *              : the well known PHP mailer class. All rigths reserved to 
 *              : the original authors of this framework
 */
require_once (LIBRARYPATH . DS . "email" . DS . "class.phpmailer.php");

class Email {

    private $source;
    private $sourceName;
    private $destination;
    private $subject;
    private $message;
    private $host;
    private $port;
    private $userName;
    private $password;
    private $SMTPSecure;
    private $mail;

    public function __construct() {
        //EXCEPTION THROWING ALLOWED
        $mail = new PHPMailer(true);
        $mail->IsSMTP();

        //SMTP DEBUGIN INFORMATION ON
        $mail->SMTPDebug = 0;
        //SMTP AUTHENTICATION ON
        $mail->SMTPAuth = true;
    }

    public function setSource($source) {
        $this->source = $source;
    }

    public function setSourceName($sourceName) {
        $this->sourceName = $sourceName;
    }

    public function setDestination($destination) {
        $this->destination = $destination;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setPort($port) {
        $this->port = $port;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setSMTPSecure($SMTPSecure) {
        $this->SMTPSecure = $SMTPSecure;
    }

    public function getSource() {
        return $this->source;
    }

    public function getSourceName() {
        return $this->sourceName;
    }

    public function getDestination() {
        return $this->destination;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSMTPSecure() {
        return $this->SMTPSecure;
    }

    /**
     * Performs an email sending using the configuration loaded on the attributes
     * of this class
     * @param array $attachments Array of attachments needed on the email.<br>
     * This field can be blank
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public function send($attachments = array()) {
        $result = true;

        try {

            $this->mail->SMTPSecure = $this->SMTPSecure;
            $this->mail->Host = $this->host;
            $this->mail->Port = $this->port;
            $this->mail->Username = $this->userName;
            $this->mail->Password = $this->password;

            $this->mail->AddAddress($this->destination, '');
            $this->mail->SetFrom($this->source, $this->sourceName);
            $this->mail->Subject = $this->subject;
            $this->mail->MsgHTML($this->message);

            foreach ($attachments as $at) {
                $this->mail->AddAttachment($at);
            }

            $this->mail->Send();
        } catch (phpmailerException $e) {
            //Excepción de PHPMailer
            //logError($e->errorMessage());
            $retorno = false;
        } catch (Exception $e) {
            //Cualquier otra excepción
            //logError($e->getMessage()); 
            $retorno = false;
        }


        return $result;
    }

}
