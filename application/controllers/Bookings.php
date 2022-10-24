<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bookings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('mdl_Bookings');
        date_default_timezone_set('Europe/Brussels');
        session_start();
    }
    
    /**
     * @param int $page
     */
    public function index(){

        session_destroy ();
        // https://github.com/topics/reservation gant
        $data["user"]=$this->mdl_Bookings->get_companyData();

        $this->load->view("index",$data);
        
    }
    
     /**
     * @param int $page
     */
    public function post_step1(){
        $start=$this->input->post("start");
        $ende=$this->input->post("ende");
        $data["user"]=$this->mdl_Bookings->get_companyData();
        
        if(empty($start)||empty($ende) || date($start)>=date($ende) || date($start)<date("Y-m-d")){
            $data["error_message"]="Bitte wählen Sie ein gültigen Zeitraum aus.";
            $this->load->view("index",$data);
        }else{
            $_SESSION["meta"]["start"]=$start;
            $_SESSION["meta"]["ende"]=$ende;
            
            //select free roms in that date range
            $rooms=$this->mdl_Bookings->select_free_room($start,$ende);
            $data['response'] =$rooms; 
            if(empty($rooms)){
                //$this->load->view("step2-no-free-room",$data);
                $data["error_message"]=$start." bis ".$ende.": Leider haben wir für diesen Zeitraum keine freien Zimmer.";
                $this->load->view("index",$data);
            }else{  
                if(empty($_SESSION["meta"]["start"])){
                    redirect("bookings/index");
                }
                $this->load->view("step2-room",$data);
            }
        }
    }

    public function post_step2(){
        $data["user"]=$this->mdl_Bookings->get_companyData();
        $data["selected_rooms"]=array();
        if(empty($this->input->post("buchung"))){
            $data["error_msg"]="Bitte wählen sie zur buchung ein kästchen aus.";
            $this->load->view("step2-room",$data);
            return;
        }
        foreach($this->input->post("buchung") as $roomid){
            $room= $this->mdl_Bookings->get_by_id($roomid);
            $room["selc_preis"]=$this->input->post("preis-".$roomid);
            $data["selected_rooms"][] = $room;
        }

        $nights=$this->diff($_SESSION["meta"]["start"], $_SESSION["meta"]["ende"]);


        $_SESSION["meta"]['rooms'] = $data["selected_rooms"]; 
        $_SESSION["meta"]["days"]=$nights["days"];
        $data["nights"]=$nights["days"];
        
        if(empty($_SESSION["meta"]['rooms'])){
            redirect("bookings/index");
        }
        $this->load->view("step3-overview",(object)$data);
    }

    public function post_step3(){
        $data["user"]=$this->mdl_Bookings->get_companyData();
        $data["error_msg"]="* oder #";
        if(empty($_SESSION["meta"]['rooms'])){
            redirect("bookings/index");
        }
        $this->load->view("step4-kontakt",$data);
    }

    public function post_step4(){
        $data["user"]=$this->mdl_Bookings->get_companyData();
        if(empty($_SESSION["meta"]["rooms"])){
            redirect("bookings/index");
        }
        $company=array(
            "firma"=>$this->input->post("firma"),
            "vorname"=>$this->input->post("firstname"),
            "nachname"=>$this->input->post("lastname"),
            "ort"=>$this->input->post("city"),
            "plz"=>$this->input->post("postcode"),
            "strase"=>$this->input->post("street"),
            "email"=>$this->input->post("email"),
            "mob"=>$this->input->post("phone"),
            "client_surname"=>""
        );
        $error_msg="";
        
        if(empty($company["firma"]) && (empty($company["vorname"]) || empty($company["nachname"]))  ){
            $error_msg="Bitte füllen Sie den Firmennamen oder geben sie Ihr Vor-und Nachnamen ein.";
        }else if(empty($company["plz"]) || empty($company["strase"]) || empty($company["ort"]) ){
            $error_msg="Bitte Postleitzahl, Ort und Straße eingeben.";
        }else if(empty($company["email"]) && empty($company["mob"])){
            $error_msg="Bitte Email oder Tel.nummer eingeben.";
        }else{
            if(!empty($company["vorname"]) && !empty($company["nachname"]) && empty($company["firma"]) ){
                $company["firma"] = $company["vorname"]." ".$company["nachname"];
            }
            if(!empty($company["vorname"]) && !empty($company["nachname"]) && !empty($company["firma"]) ){
                $company["client_surname"] = $company["vorname"]." ".$company["nachname"];
            }

                $_SESSION["meta"]["user"]=$company;
                $start=$_SESSION["meta"]["start"];
                $end=$_SESSION["meta"]["ende"];

                $tnow=date('H:i:s');
                $dnow=date("Y-m-d");
                $dtnow=date("Y-m-d H:i:s");

                $this->db->trans_start();
                //when room is bookend menwhile from other person
                if($this->check_selcRoom_available($start,$end,$_SESSION["meta"]["rooms"])){ 
                $client_id = $this->db->query("SELECT client_id FROM `ip_clients` where client_name='".$company["firma"]."'")->row_array();
                if(empty($client_id)){
                    $this->db->insert('ip_clients', array("client_name"=>$company["firma"],"client_address_1"=>$company["strase"],"client_city"=>$company["ort"],"client_zip"=>$company["plz"],"client_phone"=>$company["mob"],"client_email"=>$company["email"],"client_date_created"=>$dtnow,"client_date_modified"=>$dtnow));
                    $client_id["client_id"] = $this->db->insert_id(); 
                }

                $res_group=$this->db->query("SELECT * FROM ip_invoice_groups where invoice_group_id=5")->row_array();
                $invoice = array(
                    "invoice_id" => null,
                    'user_id' => '1',
                    'client_id' => $client_id["client_id"], 
                    'invoice_group_id' => 5,
                    'invoice_status_id' => 1,
                    "is_read_only" => null,
                    'invoice_password'  => '',
                    'invoice_date_created' => $dnow,
                    'invoice_time_created' => $tnow,
                    'invoice_date_modified' => $dtnow,
                    'invoice_date_due' => $dnow,
                    'invoice_number' => "RES-".$res_group["invoice_group_next_id"],
                    'invoice_url_key'=> $this->get_url_key(),
                    'creditinvoice_parent_id'=> 0,
                    'payment_method' => 0
                );

                $this->db->insert('ip_invoices', $invoice);
                $reservation_id = $this->db->insert_id(); 
                $this->db->set('invoice_group_next_id', $res_group["invoice_group_next_id"]+1);
                $this->db->where('invoice_group_id', $res_group["invoice_group_id"]);
                $this->db->update('ip_invoice_groups');
                $_SESSION["meta"]["invoice_id"]=$reservation_id;
                $count=0; 
                foreach($_SESSION["meta"]["rooms"] as $room){ 
                    $item=array("item_id"=>null,
                        "invoice_id"=>$reservation_id,
                        "item_tax_rate_id"=>2,
                        "item_product_id"=>1,
                        "item_date_added"=>$dnow,
                        "item_name"=>"Übernachtung ohne Frühstück",
                        "item_description"=>"",
                        "item_quantity"=>$_SESSION["meta"]["days"],
                        "item_price"=>$room["selc_preis"],
                        "item_date_start"=>$start,
                        "item_date_end"=>$end,
                        "item_room" => $room["id"],
                        "item_order" => $count
                    );
                    $this->db->insert('ip_invoice_items', $item);
                    $count++;
                }
                    $this->db->trans_complete();
	
					$table='
                    Sehr geehrte Damen und Herren,<br>
                    wir freuen uns ganz herzlich dass sie bei uns übernachten möchten und bestätigen die Reservierung wie folgt:<br><br>
                    Zeitraum: '.date('d-m-Y',strtotime($_SESSION["meta"]["start"]))." bis ".date('d-m-Y',strtotime($_SESSION["meta"]["ende"])).'<br>';
                    
                    foreach($_SESSION["meta"]["rooms"] as $room){	
                    $table.='<br>'.$room["kategorie"].' - '.$room["selc_preis"].'€/Nacht ohne Frühstück';
                    }
                    $table.="<br><br><br>Mit freundlichen Grüßen<br>
                    ".$data["user"]["user_company"]."<br>
                    ".$data["user"]["user_address_1"]."<br>
                    ".$data["user"]["user_zip"]." ".$data["user"]["user_city"]."<br>
                    ".$data["user"]["user_phone"]."<br>
                    ".$data["user"]["user_email"];
                    
					
					$sub='=?UTF-8?B?' . base64_encode('Reservierungsbestätigung') . '?=';
                    $this->sendEmail($company["email"],$sub,base64_encode($table));
                    
                    redirect("bookings/finish");
                }else{
                    redirect("bookings/info");
                }
        }
        $data["error_msg"]=$error_msg;
        if(empty($_SESSION["meta"])){
            redirect("bookings/index");
        }
        $this->load->view("step4-kontakt",$data);
    }

    public function finish(){
        $data["user"]=$this->mdl_Bookings->get_companyData();
        if(empty($_SESSION["meta"]["user"])){
            redirect("bookings/index");
        }
        $this->load->view("step5-finish",$data);
    }
    public function info(){
        if(empty($_SESSION["meta"]["user"])){
            redirect("bookings/index");
        }
        $this->load->view("step5-info");
    }
    
    private function get_url_key()
    {
        $this->load->helper('string');
        return random_string('alnum', 32);
    }
    private function diff($start,$end){
        $date1 = date_create_from_format('Y-m-d', $start);
        $date2 = date_create_from_format('Y-m-d', $end);
        return (array) date_diff($date1, $date2);
    }


    private function check_selcRoom_available($start,$end,$sel_rooms){
        $db_rooms=$this->mdl_Bookings->select_free_room($start,$end);
        $excp_count=count($sel_rooms);
        $count=0;
        foreach($sel_rooms as $room){ 
            foreach($db_rooms as $dbr){
                 if($room["id"] == $dbr->id){
                    $count++;
                 }
             }
        }
        return ($count==$excp_count);
    }
    private function sendEmail($to,$subject,$body){
        $this->load->model("mdl_Settings");
        $myEmail = $this->mdl_Settings->get("smtp_mail_from");
         $header = 
        'From: '.$myEmail . "\r\n" .
        'Reply-To: '.$myEmail . "\r\n" .
        'MIME-Version: 1.0' . "\r\n".
        'Content-Type: text/html; charset=utf-8'. "\r\n".
		'Content-Transfer-Encoding: base64' . "\r\n";

        return mail($to.",".$myEmail, $subject, $body, $header);  
    }
}
