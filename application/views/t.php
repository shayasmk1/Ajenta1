<?php
class Payments extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('ProviderModel');
        $this->load->model('LocalUsersModel');
        date_default_timezone_set("Europe/London");

    }
    public function do_purchase()
    {
		
        $is_login = $this->session->userdata('local_is_Login');
        
        if(isset($is_login) || ($is_login == true)){
            if($this->session->userdata('Payment_Method') == 'Paypal') {
               $localid = $this->LocalUsersModel->getLocalUserIDbyName($this->session->userdata('local_email_Data'));
                $data['bookinginfo'] = array(
                    'Pickup_time' => $this->session->userdata('Pickup_time'),
                    'Pickup_date' => $this->session->userdata('Pickup_date'),
                    'Pickup_location' => $this->session->userdata('Pickup_location'),
                    'Drop_location' => $this->session->userdata('Drop_location'),
                    'Distance' => $this->session->userdata('Distance'),
                    'Total_fare' => $_GET['fares'],
                    'Car_typeID' => $this->session->userdata('Car_typeID'),
                    'Confirmed' => $this->session->userdata('Confirmed'),
                    'LocalID' => $localid,
                    'Car_Model_Name' => '0',
                    'ProviderID' => $_GET['company'],
                    'BookingDate' => date('m/d/Y'),
                    'BookingTime' => date('h:i A'),
                    'Passengers' => $this->session->userdata('Passengers'),
                    'Suitcase' => $this->session->userdata('Suitcase'),
                    'Payment_Method' => $this->session->userdata('Payment_Method')
                );

                $this->session->set_userdata('userCell', $_GET['userCell']);

                $this->session->set_userdata('Pickup_time', $data['bookinginfo']['Pickup_time']);
                $this->session->set_userdata('Pickup_date', $data['bookinginfo']['Pickup_date']);
                $this->session->set_userdata('Pickup_location', $data['bookinginfo']['Pickup_location']);
                $this->session->set_userdata('Drop_location', $data['bookinginfo']['Drop_location']);
                $this->session->set_userdata('Distance', $data['bookinginfo']['Distance']);
                $this->session->set_userdata('Total_fare', $data['bookinginfo']['Total_fare']);
                $this->session->set_userdata('Car_typeID', $data['bookinginfo']['Car_typeID']);
                $this->session->set_userdata('Confirmed', $data['bookinginfo']['Confirmed']);
                $this->session->set_userdata('LocalID', $data['bookinginfo']['LocalID']);
                $this->session->set_userdata('Car_Model_Name', $data['bookinginfo']['Car_Model_Name']);
                $this->session->set_userdata('ProviderID', $data['bookinginfo']['ProviderID']);
                $this->session->set_userdata('BookingDate', $data['bookinginfo']['BookingDate']);
                $this->session->set_userdata('BookingTime', $data['bookinginfo']['BookingTime']);
                $this->session->set_userdata('Passengers', $data['bookinginfo']['Passengers']);
                $this->session->set_userdata('Suitcase', $data['bookinginfo']['Suitcase']);
                $this->session->set_userdata('Payment_Method', $data['bookinginfo']['Payment_Method']);

                $providername = $this->ProviderModel->getProviderNamebyID($_GET['company']);

                //$config['business'] = 'booking.cabtu@gmail.com';
				$config['price'] = str_replace("fares=", "", $this->session->userdata('sval3'));
				$config['business'] = 'booking.cabtu@gmail.com';
                $config['cpp_header_image'] = ''; //Image header url [750 pixels wide by 90 pixels high]
                $config['return'] = site_url('/payments/verify_payments');
                $config['cancel_return'] = 'http://localhost/paypal/index.php/payments/cancel_payments';
                $config['notify_url'] = 'process_payment.php'; //IPN Post
                $config['production'] = TRUE; //Its false by default and will use sandbox
                //$config['discount_rate_cart'] 	= 20; //This means 20% discount
                $config["invoice"] = random_string('numeric', 8); //The invoice id

                //$this->verify_payments();

                //$this->load->library('Paypal', $config);
				
                $this->load->library('Paypalprocess', $config);
            }
            else
            {
                $localid = $this->LocalUsersModel->getLocalUserIDbyName($this->session->userdata('local_email_Data'));
                $data['bookinginfo'] = array(
                    'Pickup_time' => $this->session->userdata('Pickup_time'),
                    'Pickup_date' => $this->session->userdata('Pickup_date'),
                    'Pickup_location' => $this->session->userdata('Pickup_location'),
                    'Drop_location' => $this->session->userdata('Drop_location'),
                    'Distance' => $this->session->userdata('Distance'),
                    'Total_fare' => $_GET['fares'],
                    'Car_typeID' => $this->session->userdata('Car_typeID'),
                    'Confirmed' => $this->session->userdata('Confirmed'),
                    'LocalID' => $localid,
                    'Car_Model_Name' => '0',
                    'ProviderID' => $_GET['company'],
                    'BookingDate' => date('m/d/Y'),
                    'BookingTime' => date('h:i A'),
                    'Passengers' => $this->session->userdata('Passengers'),
                    'Suitcase' => $this->session->userdata('Suitcase'),
                    'Payment_Method' => $this->session->userdata('Payment_Method')
                );

                $this->session->set_userdata('userCell', $_GET['userCell']);
                $this->session->set_userdata('Pickup_time', $data['bookinginfo']['Pickup_time']);
                $this->session->set_userdata('Pickup_date', $data['bookinginfo']['Pickup_date']);
                $this->session->set_userdata('Pickup_location', $data['bookinginfo']['Pickup_location']);
                $this->session->set_userdata('Drop_location', $data['bookinginfo']['Drop_location']);
                $this->session->set_userdata('Distance', $data['bookinginfo']['Distance']);
                $this->session->set_userdata('Total_fare', $data['bookinginfo']['Total_fare']);
                $this->session->set_userdata('Car_typeID', $data['bookinginfo']['Car_typeID']);
                $this->session->set_userdata('Confirmed', $data['bookinginfo']['Confirmed']);
                $this->session->set_userdata('LocalID', $data['bookinginfo']['LocalID']);
                $this->session->set_userdata('Car_Model_Name', $data['bookinginfo']['Car_Model_Name']);
                $this->session->set_userdata('ProviderID', $data['bookinginfo']['ProviderID']);
                $this->session->set_userdata('BookingDate', $data['bookinginfo']['BookingDate']);
                $this->session->set_userdata('BookingTime', $data['bookinginfo']['BookingTime']);
                $this->session->set_userdata('Passengers', $data['bookinginfo']['Passengers']);
                $this->session->set_userdata('Suitcase', $data['bookinginfo']['Suitcase']);
                $this->session->set_userdata('Payment_Method', $data['bookinginfo']['Payment_Method']);
                $this->verify_payments();
            }
        }
        else if(isset($_GET['userCell'])){
		
			if($this->session->userdata('bookidof')!=""){
				$_GET['fares']=$this->session->userdata('Total_fare');
					$this->session->set_userdata('Confirmed', '2');
			} 
			
		
            if($this->session->userdata('Payment_Method') == 'Paypal') {
                $localid = $this->LocalUsersModel->getLocalUserIDbyName($_GET['userCell']);
                $data['bookinginfo'] = array(
                    'Pickup_time' => $this->session->userdata('Pickup_time'),
                    'Pickup_date' => $this->session->userdata('Pickup_date'),
                    'Pickup_location' => $this->session->userdata('Pickup_location'),
                    'Drop_location' => $this->session->userdata('Drop_location'),
                    'Distance' => $this->session->userdata('Distance'),
                    'Total_fare' => $_GET['fares'],
                    'Car_typeID' => $this->session->userdata('Car_typeID'),
                    'Confirmed' => $this->session->userdata('Confirmed'),
                    'LocalID' => '1',
                    'Car_Model_Name' => '0',
                    'ProviderID' => $_GET['company'],
                    'BookingDate' => date('m/d/Y'),
                    'BookingTime' => date('h:i A'),
                    'Passengers' => $this->session->userdata('Passengers'),
                    'Suitcase' => $this->session->userdata('Suitcase'),
                    'Payment_Method' => $this->session->userdata('Payment_Method')
                );

                $this->session->set_userdata('userCell', $_GET['userCell']);
				$this->session->set_userdata('userEmail', $_GET['email']);
				$this->session->set_userdata('User_name_ins', $_GET['usern']);
                $this->session->set_userdata('Pickup_time', $data['bookinginfo']['Pickup_time']);
                $this->session->set_userdata('Pickup_date', $data['bookinginfo']['Pickup_date']);
                $this->session->set_userdata('Pickup_location', $data['bookinginfo']['Pickup_location']);
                $this->session->set_userdata('Drop_location', $data['bookinginfo']['Drop_location']);
                $this->session->set_userdata('Distance', $data['bookinginfo']['Distance']);
                $this->session->set_userdata('Total_fare', $data['bookinginfo']['Total_fare']);
                $this->session->set_userdata('Car_typeID', $data['bookinginfo']['Car_typeID']);
                $this->session->set_userdata('Confirmed', $data['bookinginfo']['Confirmed']);
                $this->session->set_userdata('LocalID', $data['bookinginfo']['LocalID']);
                $this->session->set_userdata('Car_Model_Name', $data['bookinginfo']['Car_Model_Name']);
                $this->session->set_userdata('ProviderID', $data['bookinginfo']['ProviderID']);
                $this->session->set_userdata('BookingDate', $data['bookinginfo']['BookingDate']);
                $this->session->set_userdata('BookingTime', $data['bookinginfo']['BookingTime']);
                $this->session->set_userdata('Passengers', $data['bookinginfo']['Passengers']);
                $this->session->set_userdata('Suitcase', $data['bookinginfo']['Suitcase']);
                $this->session->set_userdata('Payment_Method', $data['bookinginfo']['Payment_Method']);

                $providername = $this->ProviderModel->getProviderNamebyID($_GET['company']);

                //$config['business'] = 'booking.cabtu@gmail.com';
				$config['price'] = str_replace("fares=", "", $this->session->userdata('sval3'));
				$config['business'] = 'booking.cabtu@gmail.com';
                $config['cpp_header_image'] = ''; //Image header url [750 pixels wide by 90 pixels high]
                $config['return'] = site_url('/payments/verify_payments');
                $config['cancel_return'] = 'http://localhost/paypal/index.php/payments/cancel_payments';
                $config['notify_url'] = 'process_payment.php'; //IPN Post
                $config['production'] = TRUE; //Its false by default and will use sandbox
                //$config['discount_rate_cart'] 	= 20; //This means 20% discount
                $config["invoice"] = random_string('numeric', 8); //The invoice id

                //$this->verify_payments();

                //$this->load->library('Paypal', $config);
				
                $this->load->library('Paypalprocess', $config);
            }
            else
            {
                $localid = $this->LocalUsersModel->getLocalUserIDbyName($_GET['userCell']);
                $data['bookinginfo'] = array(
                    'Pickup_time' => $this->session->userdata('Pickup_time'),
                    'Pickup_date' => $this->session->userdata('Pickup_date'),
                    'Pickup_location' => $this->session->userdata('Pickup_location'),
                    'Drop_location' => $this->session->userdata('Drop_location'),
                    'Distance' => $this->session->userdata('Distance'),
                    'Total_fare' => $_GET['fares'],
                    'Car_typeID' => $this->session->userdata('Car_typeID'),
                    'Confirmed' => $this->session->userdata('Confirmed'),
                    'LocalID' => $localid,
                    'Car_Model_Name' => '0',
                    'ProviderID' => $_GET['company'],
                    'BookingDate' => date('m/d/Y'),
                    'BookingTime' => date('h:i A'),
                    'Passengers' => $this->session->userdata('Passengers'),
                    'Suitcase' => $this->session->userdata('Suitcase'),
                    'Payment_Method' => $this->session->userdata('Payment_Method')
                );

                $this->session->set_userdata('userCell', $_GET['userCell']);
				$this->session->set_userdata('userEmail', $_GET['email']);
                $this->session->set_userdata('Pickup_time', $data['bookinginfo']['Pickup_time']);
                $this->session->set_userdata('Pickup_date', $data['bookinginfo']['Pickup_date']);
                $this->session->set_userdata('Pickup_location', $data['bookinginfo']['Pickup_location']);
                $this->session->set_userdata('Drop_location', $data['bookinginfo']['Drop_location']);
                $this->session->set_userdata('Distance', $data['bookinginfo']['Distance']);
                $this->session->set_userdata('Total_fare', $data['bookinginfo']['Total_fare']);
                $this->session->set_userdata('Car_typeID', $data['bookinginfo']['Car_typeID']);
                $this->session->set_userdata('Confirmed', $data['bookinginfo']['Confirmed']);
                $this->session->set_userdata('LocalID', $data['bookinginfo']['LocalID']);
                $this->session->set_userdata('Car_Model_Name', $data['bookinginfo']['Car_Model_Name']);
                $this->session->set_userdata('ProviderID', $data['bookinginfo']['ProviderID']);
                $this->session->set_userdata('BookingDate', $data['bookinginfo']['BookingDate']);
                $this->session->set_userdata('BookingTime', $data['bookinginfo']['BookingTime']);
                $this->session->set_userdata('Passengers', $data['bookinginfo']['Passengers']);
                $this->session->set_userdata('Suitcase', $data['bookinginfo']['Suitcase']);
                $this->session->set_userdata('Payment_Method', $data['bookinginfo']['Payment_Method']);
                $this->session->set_userdata('User_name_ins', $_GET['usern']);
				$email=$this->session->userdata('userEmail');
		
						$msg= '<html><body><div bgcolor="#fdfdfd" text="#919191" alink="#cccccc" vlink="#cccccc" style="margin:0;padding:0;background-color:#fdfdfd;color:#919191">
								   <center>
									  <table class="m_4793086114022464031vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#fdfdfd" style="background-color:#fdfdfd" id="m_4793086114022464031ko_logoBlock_3">
										 <tbody>
											<tr>
											   <td class="m_4793086114022464031vb-outer" align="center" valign="top" bgcolor="#fdfdfd" style="padding-left:9px;padding-right:9px;background-color:#fdfdfd">
												  <div class="m_4793086114022464031oldwebkit" style="max-width:570px">
													 <table width="570" style="border-collapse:separate;border-spacing:18px;padding-left:0;padding-right:0;width:100%;max-width:570px" border="0" cellpadding="0" cellspacing="18" class="m_4793086114022464031vb-container m_4793086114022464031fullpad">
														<tbody>
														   <tr>
															  <td valign="top" align="center">
																 <div class="m_4793086114022464031mobile-full" style="display:inline-block;max-width:258px;vertical-align:top;width:100%"> 
																	<a href="https://www.cabtu.co.uk/" style="font-size:18px;font-family:Arial,Helvetica,sans-serif;color:#f3f3f3;text-decoration:none" target="_blank" ><img width="258" vspace="0" hspace="0" border="0" alt="" style="border:0px;display:block;width:100%;max-width:258px" src="https://www.cabtu.co.uk/assets/images/clogo.png" class="CToWUd"></a>
																 </div>
															  </td>
														   </tr>
														</tbody>
													 </table>
												  </div>
											   </td>
											</tr>
										 </tbody>
									  </table>
									  <table class="m_4793086114022464031vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#fdfdfd" style="background-color:#fdfdfd" id="m_4793086114022464031ko_titleBlock_4">
										 <tbody>
											<tr>
											   <td class="m_4793086114022464031vb-outer" align="center" valign="top" bgcolor="#fdfdfd" style="padding-left:9px;padding-right:9px;background-color:#fdfdfd">
												  <div class="m_4793086114022464031oldwebkit" style="max-width:570px">
													 <table width="570" border="0" cellpadding="0" cellspacing="9" class="m_4793086114022464031vb-container m_4793086114022464031halfpad" bgcolor="#ffffff" style="border-collapse:separate;border-spacing:9px;padding-left:9px;padding-right:9px;width:100%;max-width:570px;background-color:#fff">
														<tbody>
														   <tr>
															  <td bgcolor="#ffffff" align="center" style="background-color:#ffffff;font-size:22px;font-family:Arial,Helvetica,sans-serif;color:#3f3f3f;text-align:center">
																 <span>Thank you for your booking!</span>
															  </td>
														   </tr>
														</tbody>
													 </table>
												  </div>
											   </td>
											</tr>
										 </tbody>
									  </table>
									  <table class="m_4793086114022464031vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#fdfdfd" style="background-color:#fdfdfd" id="m_4793086114022464031ko_textBlock_5">
										 <tbody>
											<tr>
											   <td class="m_4793086114022464031vb-outer" align="center" valign="top" bgcolor="#fdfdfd" style="padding-left:9px;padding-right:9px;background-color:#fdfdfd">
												  <div class="m_4793086114022464031oldwebkit" style="max-width:570px">
													 <table width="570" border="0" cellpadding="0" cellspacing="18" class="m_4793086114022464031vb-container m_4793086114022464031fullpad" bgcolor="#ffffff" style="border-collapse:separate;border-spacing:18px;padding-left:0;padding-right:0;width:100%;max-width:570px;background-color:#fff">
														<tbody>
														   <tr>
															  <td align="left" class="m_4793086114022464031long-text m_4793086114022464031links-color" style="text-align:left;font-size:13px;font-family:Arial,Helvetica,sans-serif;color:#3f3f3f">
																 <p style="margin:1em 0px;margin-top:0px;text-align:center">Above you will find your booking details. You will receive another email after the provider will accept you booking.</p>
																 <p style="margin:1em 0px;margin-top:0px;text-align:left;border:2px solid #ddd;padding:10px;">
																 <b style="font-weight:bold;">Provider</b> '.$this->session->userdata('companyName').'<br/>
																 <b style="font-weight:bold;">Car Model Name</b> '.$this->session->userdata('CarType').'<br/>
																 <b style="font-weight:bold;">Passengers</b> '.$this->session->userdata('Passengers').'<br/>
																 <b style="font-weight:bold;">Suitcase</b> '.$this->session->userdata('Suitcase').'<br/>
																 <b style="font-weight:bold;">Pickup time</b> '.$this->session->userdata('Pickup_time').'<br/>
																 <b style="font-weight:bold;">Pickup date</b> '.$this->session->userdata('Pickup_date').'<br/>
																 <b style="font-weight:bold;">Pickup location</b> '.$this->session->userdata('Pickup_location').'<br/>
																 <b style="font-weight:bold;">Drop location</b> '.$this->session->userdata('Drop_location').'<br/>
																 <b style="font-weight:bold;">Price </b> £'.$this->session->userdata('Total_fare').'<br/>
																 <b style="font-weight:bold;">Payment</b> Cash at driver<br/>
																 
																 </p>
																  <p style="margin:0px;margin-top:0px;text-align:left;padding:10px;font-weight:bold;">Regards, <br/>Cabtu Support Team</p>
															  </td>
														   </tr>
														</tbody>
													 </table>
												  </div>
											   </td>
											</tr>
										 </tbody>
									  </table>
									  <table width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#24b6ec" style="background-color:#24b6ec" id="">
										 <tbody>
											<tr>
											   <td align="center" valign="top" bgcolor="#24b6ec" style="background-color:#24b6ec">
												  <div class="m_4793086114022464031oldwebkit" style="max-width:570px">
													 <table width="570" style="border-collapse:separate;border-spacing:9px;padding-left:9px;padding-right:9px;width:100%;max-width:570px" border="0" cellpadding="0" cellspacing="9" class="m_4793086114022464031vb-container m_4793086114022464031halfpad" align="center">
														<tbody>
														  
															   <p style="margin:0px;margin-top:0px;text-align:center;padding:10px;color:#fff;">You have received this email because a booking was made on www.cabtu.co.uk with this email address. If you think this email arrived at you by error please contact us on our website www.cabto.co.uk</p>
														</tbody>
													 </table>
												  </div>
											   </td>
											</tr>
										 </tbody>
									  </table>
								   </center>
								   <div class="yj6qo"></div>
								   <div class="adL">
								   </div>
								</div></body></html>';
						
						 $from_email = "info@cabtu.co.uk"; 
						 $this->load->library('email'); 
						 $email_setting  = array('mailtype'=>'html');
						 $this->email->initialize($email_setting);
						 
						 $this->email->from($from_email, 'cabtu'); 
						 
						 $this->email->to($email);
						 $this->email->subject('cabtu');
						
						 $this->email->message($msg);    
						 $this->email->send();
                $this->verify_payments();
            }
        }
        else{
			
            $this->session->set_userdata('url',$_SERVER['REQUEST_URI']);
            $this->session->set_userdata('host',$_SERVER['HTTP_HOST']);
            $this->session->set_userdata('token','havesome');
           // redirect('CommonLoginController');
           // die();
        }
    }

    public function verify_payments()
    {
        $data = array(
            'Pickup_time'=> $this->session->userdata('Pickup_time'),
            'Pickup_date'=> $this->session->userdata('Pickup_date'),
            'Pickup_location'=> $this->session->userdata('Pickup_location'),
            'Drop_location'=> $this->session->userdata('Drop_location'),
            'Distance'=> $this->session->userdata('Distance'),
            'Total_fare' => $this->session->userdata('Total_fare'),
            'Car_typeID' => $this->session->userdata('Car_typeID'),
            'Confirmed' => $this->session->userdata('Confirmed'),
            'user_name' => $this->session->userdata('User_name_ins'),
            'user_email' => $this->session->userdata('userEmail'),
            'LocalID' => '1',
            'Car_Model_Name' => $this->session->userdata('Car_Model_Name'),
            'ProviderID' => $this->session->userdata('ProviderID'),
            'BookingDate' => $this->session->userdata('BookingDate'),
            'BookingTime' => $this->session->userdata('BookingTime'),
            'Passengers' => $this->session->userdata('Passengers'),
            'Suitcase' => $this->session->userdata('Suitcase'),
            'Payment_Method' => $this->session->userdata('Payment_Method')
        );

        

			$this->load->library('SendingSms');
            $sms = new SendingSms();
            $phoneNum = $this->session->userdata('userCell');
            $sms->index($phoneNum);
			
		
			
            //$sms->test($phoneNum);
        if($this->db->insert('bookings_tbl',$data))
        {
            
            //redirect('Userdashboard');
           redirect('/booking-complete');
		    /*$this->session->set_userdata('userCell',"");
            $this->session->set_userdata('Pickup_time',"");
            $this->session->set_userdata('Pickup_date',"");
            $this->session->set_userdata('Pickup_location',"");
            $this->session->set_userdata('Drop_location',"");
            $this->session->set_userdata('Distance',"");
            $this->session->set_userdata('Total_fare',"");
            $this->session->set_userdata('Car_typeID',"");
            $this->session->set_userdata('Confirmed',"");
            $this->session->set_userdata('LocalID',"");
            $this->session->set_userdata('Car_Model_Name',"");
            $this->session->set_userdata('ProviderID',"");
            $this->session->set_userdata('BookingDate',"");
            $this->session->set_userdata('increment',"");
            $this->session->set_userdata('BookingTime',"");
            $this->session->set_userdata('Passengers',"");
            $this->session->set_userdata('Suitcase',"");
            $this->session->set_userdata('Payment_Method',"");*/
        }
	
    }

    public function cancel_payments()
    {

    }

    public function thnku()
    {
        $this->load->view('thnku');
    }
}
?>