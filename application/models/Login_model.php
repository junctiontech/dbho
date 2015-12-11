<?php
/* Model for login and sign up   */

class Login_model extends CI_Model 
{
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
		//Load database connection
		$this->load->database();
    }
	
    function login_check($table=false,$data=false)
   {
	      
		  $query = $this->db->get_where($table,$data);
		  if($query->num_rows()>0)
		  {
			   return $query->row();   
		  }
		  else
		  {
				return false;
		  }
   }
   
   

}