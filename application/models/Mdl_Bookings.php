<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Bookings extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
 
    public function get_by_id($id)
    {
        return $this->db->query("Select * From ip_rooms where ip_rooms.id=".$id)->row_array();
    }

    public function select_free_room($start,$end){
        return $this->db->query("Select * From ip_rooms where show_on_system=1 AND ip_rooms.id not in (SELECT item_room FROM ip_invoice_items WHERE item_date_start < '".$end."' AND item_date_end > '".$start."') order by ip_rooms.preis1")->result(); 
    }
    
    public function get_companyData(){
        return $this->db->query("SELECT * FROM `ip_users` where user_id=1")->row_array();
    }

}
