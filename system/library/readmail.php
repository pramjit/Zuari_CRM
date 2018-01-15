<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sms
 *
 * @author agent
 */

 class readmail {

	// imap server connection
	public $conn;

	// inbox storage and inbox message count
	private $inbox;
	private $msg_cnt;

	// email login credentials
	private $server = 'imap.aspltech.com:110/pop/novalidate-cert';
	private $user   = 'cargil.invoice@aspltech.com';
	private $pass   = 'cargil#321';
	private $port   = 587; // adjust according to server settings

	// connect to the server and get the inbox emails
	function __construct() {
		$this->connect();
		$this->inbox();
          //  $this->unreadinbox();
	}

	// close the server connection
	function close() {
		$this->inbox = array();
		$this->msg_cnt = 0;

		imap_close($this->conn);
	}
        function  getcount()
        {
            return $this->msg_cnt;
        }
        // open the server connection
	// the imap_open function parameters will need to be changed for the particular server
	// these are laid out to connect to a Dreamhost IMAP server
	function connect() {
            try{
		$this->conn = imap_open('{'.$this->server.'}INBOX', $this->user, $this->pass);
               $er= imap_errors();
            }  catch (Exception $e){
                echo $e;
            }
	}

	// move the message to a new folder
	function move($msg_index, $folder='INBOX.Processed') {
		// move on server
		imap_mail_move($this->conn, $msg_index, $folder);
		imap_expunge($this->conn);
                
		// re-read the inbox
               // $this->inbox();
		//$this->unreadinbox();
	}

	// get a specific message (1 = first email, 2 = second email, etc.)
	public function get($msg_index=NULL) {
		if (count($this->inbox) <= 0) {
			return array();
		}
		elseif ( ! is_null($msg_index) && isset($this->inbox[$msg_index])) 
                    {
			return $this->inbox[$msg_index];
		}

		return $this->inbox[0];
	}

	// read the inbox
	function inbox() {
		$this->msg_cnt = imap_num_msg($this->conn);                
		$in = array();
		for($i = 1; $i <= $this->msg_cnt; $i++) {
                    $filename="mail_".$i.".log";
                    $f=DIR_LOGS.$filename;
                  if(!file_exists ($f )){
                    $log=new Log($filename);
                    $aa=imap_headerinfo($this->conn, $i);
                    $log->write($aa);                                        
			$in[] = array(
				'index'     => $i,
				'header'    => imap_headerinfo($this->conn, $i),
				'body'      => imap_body($this->conn, $i),
				'structure' => imap_fetchstructure($this->conn, $i)
                    );
                    }
		}

		$this->inbox = $in;
	}
        function  markread($index)
        {
            return imap_setflag_full($this->conn, $index, "\\Seen \\Flagged");
        }
                function unreadinbox() {
		//$this->msg_cnt = imap_num_msg($this->conn);
                $result = imap_search($this->conn, 'UNSEEN');    
		$in = array();
                if($result){
		for($i = 1; $i <= count($result); $i++) 
                {
			$in[] = array(
				'index'     => $i,
				'header'    => imap_headerinfo($this->conn, $i),
				'body'      => imap_body($this->conn, $i),
				'structure' => imap_fetchstructure($this->conn, $i)
			);
		}

		$this->inbox = $in;
                }
	}

}           
            
            
           




