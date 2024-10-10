<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User extends Controller {
	public function __construct() {
        parent::__construct();
        $this->call->model('User_model');
    }

    public function register() {
        if($this->form_validation->submitted()) {
            $this->form_validation
                ->name('username')
                    ->required('Username is required')
                    ->min_length(5)
                ->name('email')
                    ->required('Email address is required')
                    ->valid_email()
                ->name('password')
                    ->required('Password is required');
        if($this->form_validation->run() == FALSE) {
            set_flash_alert('danger', $this->form_validation->errors());
            redirect('/');
        }
        else {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = password_hash($this->io->post('password'), PASSWORD_BCRYPT);
            if ($this->User_model->createUser($username, $email, $password)) {
                set_flash_alert('success', 'User successfully created. Log in');
                redirect('/login');
             }
         }
        }
        $this->call->view('register');
    }

    public function login() {
        if($this->form_validation->submitted()) {
            $this->form_validation
                ->name('email')
                    ->required('Email is required')
                ->name('password')
                    ->required('Password is required');
            if($this->form_validation->run() == FALSE) {
                set_flash_alert('danger', $this->form_validation->errors());
                redirect('/login');
            }

            else {
                $email = $this->io->post('email');
                $password = $this->io->post('password');

                    if($this->User_model->checkUser($email) == TRUE) {
                        if($data = $this->lauth->login($email, $password) == FALSE) {
                            set_flash_alert('danger', 'Invalid email or password.');
                            redirect('/login');
                        }
                        if ($data = $this->lauth->login($email, $password) == TRUE) {
                            $this->lauth->set_logged_in($data);
                            set_flash_alert('success', 'Successfully logged in.');
                            redirect('/mail');
                        }  
                    }
                    else if ($this->User_model->checkUser($email) == FALSE) {
                        set_flash_alert('danger', 'User does not exist. Register first.');
                        redirect('/');
                    }
            }
        }
        $this->call->view('login');
    }

    public function mail() {
        
        if($this->form_validation->submitted()) {
            $this->form_validation
                ->name('from-email')
                    ->required('Sender email is required')
                ->name('to-email')
                    ->required('Recipient email is required')
                ->name('subject')
                    ->required('Subject is required')
                ->name('message')
                    ->required('Message is required');
        if($this->form_validation->run() == FALSE) {
            set_flash_alert('danger', $this->form_validation->errors());
            redirect('/mail');
        }
        else {
            $fromemail = $this->io->post('from-email');
            $toemail = $this->io->post('to-email');
            $subject = $this->io->post('subject');
            $message = $this->io->post('message');
            $attachment = $_FILES['attachment'];

            if ($attachment['error'] !== UPLOAD_ERR_OK) {
                set_flash_alert('danger', 'File upload error.');
                redirect('/mail');
            }

            $upload_dir = 'uploads/';
            $filename = basename($attachment['name']);
            $target_file = $upload_dir . $filename;

            if (move_uploaded_file($attachment['tmp_name'], $target_file)) {
                if ($this->User_model->send_mail($fromemail, $toemail, $subject, $message, $target_file)) {
                    $this->email->sender($fromemail);
                    $this->email->recipient($toemail);
                    $this->email->subject($subject);
                    $this->email->email_content($message, 'html');
                    $this->email->attachment($target_file);
                    if($this->email->send()) {
                        set_flash_alert('success', 'Mail sent');
                        redirect('/mail');
                    }
                    else{
                        set_flash_alert('danger', 'Mail not sent');
                        redirect('/mail');
                    }
            }
            else {
                set_flash_alert('danger', 'Failed to move uploaded file.');
                redirect('/mail');
            }
        }
        }
        
    }
    $this->call->view('mail');
}
}

?>
