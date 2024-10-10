<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {
	public function createUser($username, $email, $password) {
        $data = array (
            'username' => $username,
            'email' => $email,
            'password' => $password,
        );
        return $this->db->table('users')->insert($data);
    }

    public function checkUser($email) {
        // Run the query
        $data = $this->db->table('users')
                         ->where('email', $email)
                         ->get();
    
        // Check if the query was successful and data was returned
        if ($data !== false && count($data) > 0) {
            return true; // User exists
        } else {
            return false; // User does not exist or query failed
        }
    }
    
    public function send_mail($fromemail, $toemail, $subject, $message) {
        $data = array(
            'from_email' => $fromemail,
            'to_email' => $toemail,
            'subject' => $subject,
            'message' => $message,
        );
        return $this->db->table('emails')->insert($data);
    }
}
?>
