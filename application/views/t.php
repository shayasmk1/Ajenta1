<?php



class HomeController extends CI_Controller

{

      public function __construct()

    {

        parent::__construct();

        $this->load->model('UsersModel');

        $this->load->model('ProviderModel');

        $this->load->model('CompanyModel');

        $this->load->model('CarsModel');

        $this->load->model('QuoteModel');
        $this->load->model('LoadpaypalModel');

        $this->load->model('UserdataModel');

        $this->load->model('LocalUsersModel');
		
        $this->load->model('SendingSmsPaypal');

        $this->load->model('IncrementModel');

        date_default_timezone_set("Europe/London");

    }



    public function index()

    {

      $cartyps['cartype'] = $this->CarsModel->getCars();
      $cartyps['offerts'] = $this->CarsModel->getCars2();

      //$this->load->view('Map',$cartyps);

        $this->load->view('Home',$cartyps);
$this->session->set_userdata('onlypp', '');
    }

    public function tobooking()

    {
		
		 $cartyps['offerts'] = $this->CarsModel->getCars3($_POST['bookid']);
		
		
                $this->session->set_userdata('Pickup_time', $cartyps['offerts'][0]->picktime);
                $this->session->set_userdata('Pickup_date', $cartyps['offerts'][0]->pickdate);
                $this->session->set_userdata('Pickup_location', $_POST['pickup']);
                $this->session->set_userdata('Drop_location', $cartyps['offerts'][0]->to);
                $this->session->set_userdata('bookidof', $_POST['bookid']);
                $this->session->set_userdata('Distance', '0');
                $this->session->set_userdata('Total_fare', $cartyps['offerts'][0]->price);
                $this->session->set_userdata('sval3', 'fares='.$cartyps['offerts'][0]->price);
                $this->session->set_userdata('Car_typeID', $cartyps['offerts'][0]->car_id);
                $this->session->set_userdata('Confirmed', '2');
                $this->session->set_userdata('LocalID', '0');
                $this->session->set_userdata('onlypp', '1');
                $this->session->set_userdata('ProviderID', $cartyps['offerts'][0]->prov_id);
                $this->session->set_userdata('Passengers', $_POST['passengers']);
                $this->session->set_userdata('Suitcase', $_POST['suitcase']);
                $this->session->set_userdata('sval2', 'company='.$cartyps['offerts'][0]->prov_id);
				redirect('/review');
    }
	
	
	 public function pay()

    {
		
		
		 
		 $this->load->library('Pay');
		 $pay = new Pay();
	     $result = $pay->index();
		 
		 if($result =="1"){
			 $this->load->view('paypalPaymentCancel'); 
						$this->session->set_userdata('userCell',"");
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
						$this->session->userdata('Payment_Method',"");
			
		 } else if($result =="2"){
			 $this->session->set_userdata('userCell',"");
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
						$this->session->userdata('Payment_Method',"");
			  $this->load->view('paypalPaymentAlredy');
		 } else if($result =="3"){
				$this->SendingSmsPaypal->index($this->session->userdata('userCell'));
				
				
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
																 <b style="font-weight:bold;">Payment</b> PayPal<br/>
																 
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
				
				
				 
				  $data = array(
					'Pickup_time'=> $this->session->userdata('Pickup_time'),
					'Pickup_date'=> $this->session->userdata('Pickup_date'),
					'Pickup_location'=> $this->session->userdata('Pickup_location'),
					'Drop_location'=> $this->session->userdata('Drop_location'),
					'user_name' => $this->session->userdata('User_name_ins'),
					'user_email' => $this->session->userdata('userEmail'),
					'Distance'=> $this->session->userdata('Distance'),
					'Total_fare' => $this->session->userdata('Total_fare'),
					'Car_typeID' => $this->session->userdata('Car_typeID'),
					'Confirmed' => $this->session->userdata('Confirmed'),
					'LocalID' => $this->session->userdata('LocalID'),
					'Car_Model_Name' => $this->session->userdata('Car_Model_Name'),
					'ProviderID' => $this->session->userdata('ProviderID'),
					'BookingDate' => $this->session->userdata('BookingDate'),
					'BookingTime' => $this->session->userdata('BookingTime'),
					'Passengers' => $this->session->userdata('Passengers'),
					'Suitcase' => $this->session->userdata('Suitcase'),
					'Payment_Method' => $this->session->userdata('Payment_Method')
				);
				
				
				
			
				
				
				 if($this->db->insert('bookings_tbl',$data))
					{
						
						$this->load->view('paypalPaymentDone');
						$this->session->set_userdata('userCell',"");
						$this->session->set_userdata('Pickup_time',"");
						$this->session->set_userdata('Pickup_date',"");
						$this->session->set_userdata('Pickup_location',"");
						$this->session->set_userdata('User_name_ins',"");
						$this->session->set_userdata('userEmail',"");
						$this->session->set_userdata('Drop_location',"");
						$this->session->set_userdata('Distance',"");
						$this->session->set_userdata('Total_fare',"");
						$this->session->set_userdata('bookidof',"");
						$this->session->set_userdata('sval3',"");
						$this->session->set_userdata('sval2',"");
						$this->session->set_userdata('Car_typeID',"");
						$this->session->set_userdata('Confirmed',"");
						$this->session->set_userdata('LocalID',"");
						$this->session->set_userdata('Car_Model_Name',"");
						$this->session->set_userdata('ProviderID',"");
						$this->session->set_userdata('onlypp',"");
						$this->session->set_userdata('BookingDate',"");
						$this->session->set_userdata('increment',"");
						$this->session->set_userdata('BookingTime',"");
						$this->session->set_userdata('Passengers',"");
						$this->session->set_userdata('Suitcase',"");
						$this->session->userdata('Payment_Method',"");
						
					 //$this->load->view('paypalPaymentDone');
					}
				
		 } else if($result =="4"){
			   $this->load->view('paypalPaymentAlredy');
			 $this->session->set_userdata('userCell',"");
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
						$this->session->userdata('Payment_Method',"");
			
		
		 }
					
		 
		 
			
    }
	
	
	
	//News begin
	
	 public function news1()

    {

       $this->load->view('zan_news_1');

    }
	
	//News end
	
	
	
	 public function services()

    {

       $this->load->view('zan_services');

    }
	 public function partners()

    {

       $this->load->view('zan_partners');

    } 
	public function careers()

    {

       $this->load->view('zan_careers');

    }
	public function terms_of_use()

    {

       $this->load->view('zan-terms-of-use');

    }

	public function privacy()

    {

       $this->load->view('zan_privacy');

    }


	public function client_support()

    {

       $this->load->view('zan_client_support');

    }


	public function find_your_invoice()

    {

       $this->load->view('zan_find_your_invoice');

    }

	public function help_center()

    {

       $this->load->view('zan_help_center');

    }

	public function pay_done()

    {

       $this->load->view('zan_paydone');

    }


	public function press_releases()

    {

       $this->load->view('zan_press_releases');

    }

	public function news()

    {

       $this->load->view('zan_news');

    }


	public function work_with_us()

    {

       $this->load->view('zan_work_with_us');

    }



    public function getCompare()

    {

        $cartyps['cartype'] = $this->CarsModel->getCars();

        $this->load->view('Compare',$cartyps);

    }



    public function getBill()

    {
    
    
        $car_id = $this->session->userdata('Car_typeID');
        $query = $this->db->get_where('cars_tbl', array('CarID'=>$car_id));
        $data['car_name'] = $query->row()->CarName;
        
        
        
	$data['price'] = $this->input->get('price');
	$data['provider'] = $this->input->get('provider');
        $this->load->view('Bill',$data);

    }



    public function redirecttobill()

    {

		$this->session->set_userdata('hrefe',$this->input->post('hrefe'));
		$myarray = explode("&",$this->input->post('hrefe'));
		$i=1;
		foreach($myarray as $value){
			$this->session->set_userdata('sval'.$i,str_replace("?", "", $value));
			$i=$i+1;
		}
		
        echo json_encode('ok');

    }



    public function suggestedBookings()

    {

            $date1 = new DateTime(date('m/d/Y'));

            $datetime = new DateTime();

            $newDate = $datetime->createFromFormat('d/m/Y', $_GET['datepicker']);

            $date2 = $newDate->format('m/d/Y');

            $date2 = new DateTime($date2);

            if ($date2 >= $date1)

            {

                $this->db->select('Service_time')

                    ->from('provider_tbl');

                $query = $this->db->get()->result();

                $counter = "";

                foreach ($query as $value)

                {

                    $answer = $value->Service_time;

                    $to_time = strtotime(date('h:i A'));

                    $from_time = strtotime($_GET['timepicker']);

                    $minuts = round((abs($to_time - $from_time) / 60));

                    if ($minuts >= $answer)

                    {

                        $counter++;

                    }

                }

                if($counter > 0) {

                    $increment = $this->IncrementModel->getincrementinfo();

                    foreach ($increment as $value)

                    {

                        $increment = $value->Increment;

                    }

                    $this->session->set_userdata('increment', $increment);

                    $useremail = $this->session->userdata('local_email_Data');

                    $userid = $this->UserdataModel->getUserIDbyName($useremail);

                    $date = $_GET['datepicker'];

                    $pickuptime = $_GET['timepicker'];

                    $pickupfrom = $_GET['PickupAddress'];

                    $dropto = $_GET['DropOffAddress'];

                    $distance = $_GET['hiddeninput'];

                    $confirmed = 2;

                    $carid = $_GET['car'];

                    $this->session->set_userdata('Pickup_time', $pickuptime);

                    $this->session->set_userdata('Pickup_date', $date);

                    $this->session->set_userdata('Pickup_location', $pickupfrom);

                    $this->session->set_userdata('Drop_location', $dropto);

                    $this->session->set_userdata('Distance', $distance);

                    $this->session->set_userdata('Car_typeID', $carid);

                    $this->session->set_userdata('Confirmed', $confirmed);

                    $this->session->set_userdata('Passengers', $_GET['passengers']);

                    $this->session->set_userdata('Suitcase', $_GET['suitcase']);

                    redirect('compare');

                }

                else

                {

                    $cartyps['cartype'] = $this->CarsModel->getCars();

                    $this->session->set_flashdata('msg','There is no such provider who provide services under this time period !');

                    $this->load->view('Home',$cartyps);

                }

            }

            else {

                $cartyps['cartype'] = $this->CarsModel->getCars();

                $this->session->set_flashdata('msg','Please, Do not select past date !');

                $this->load->view('Home',$cartyps);

            }

    }



    public function suggestedBookings1()

    {

        $date1 = new DateTime(date('m/d/Y'));

        $date2 = new DateTime($_GET['datepicker']);

        if ($date2 >= $date1)

        {

            $this->db->select('Service_time')

                ->from('provider_tbl');

            $query = $this->db->get()->result();

            $counter = "";

            foreach ($query as $value)

            {

                $answer = $value->Service_time;

                $to_time = strtotime(date('h:i A'));

                $from_time = strtotime($_GET['timepicker']);

                $minuts = round((abs($to_time - $from_time) / 60));

                if ($minuts >= $answer)

                {

                    $counter++;

                }

            }

            if($counter > 0) {

                $increment = $this->IncrementModel->getincrementinfo();

                foreach ($increment as $value)

                {

                    $increment = $value->Increment;

                }

                $this->session->set_userdata('increment', $increment);

                $useremail = $this->session->userdata('local_email_Data');

                $userid = $this->UserdataModel->getUserIDbyName($useremail);

                $date = $_GET['datepicker'];

                $pickuptime = $_GET['timepicker'];

                $pickupfrom = $_GET['PickupAddress'];

                $dropto = $_GET['DropOffAddress'];

                $distance = $_GET['hiddeninput'];

                $confirmed = 2;

                $carid = $_GET['car'];

                $this->session->set_userdata('Pickup_time', $pickuptime);

                $this->session->set_userdata('Pickup_date', $date);

                $this->session->set_userdata('Pickup_location', $pickupfrom);

                $this->session->set_userdata('Drop_location', $dropto);

                $this->session->set_userdata('Distance', $distance);

                $this->session->set_userdata('Car_typeID', $carid);

                $this->session->set_userdata('Confirmed', $confirmed);

                $this->session->set_userdata('Passengers', $_GET['passengers']);

                $this->session->set_userdata('Suitcase', $_GET['suitcase']);

                 redirect('HomeController/getCompare');
	

            }

            else

            {

                $cartyps['cartype'] = $this->CarsModel->getCars();

                $this->session->set_flashdata('msg','There is no such provider who provide services under this time period !');

               $this->load->view('Compare',$cartyps);


            }

        }

        else {

            $cartyps['cartype'] = $this->CarsModel->getCars();

            $this->session->set_flashdata('msg','Please, Do not select past date !');

           $this->load->view('Compare',$cartyps);
 	

        }

    }
    
    
    
    
       public function suggestedSearch()

    {

        $date1 = date('m/d/y');

            $datetime = new DateTime();
            
            $datepicker = $this->input->get('datepicker');
            $datatypecount = count(explode('/', $datepicker));
            if($datatypecount>0)
            {
            	$date2 = $datepicker;
            }else{
            	$date_arr = explode(' ', $datepicker);
            	$new_date = $date_arr[1] .'-'.$date_arr[2] .'-'.$date_arr[3];
            	$date2 = date('m/d/y', strtotime($new_date ));
            }
            
            
    
    
            if ($date2 >= $date1)

            {

                $this->db->select('Service_time')

                    ->from('provider_tbl');

                $query = $this->db->get()->result();

                $counter = "";

                foreach ($query as $value)

                {

                    $answer = $value->Service_time;

                    $to_time = strtotime(date('h:i A'));

                    $from_time = strtotime($this->input->get('timepicker'));

                    $minuts = round((abs($to_time - $from_time) / 60));

                    if ($minuts >= $answer)

                    {

                        $counter++;

                    }

                }

                if($counter > 0) {

                    $increment = $this->IncrementModel->getincrementinfo();

                    foreach ($increment as $value)

                    {

                        $increment = $value->Increment;

                    }

                    $this->session->set_userdata('increment', $increment);

                    $useremail = $this->session->userdata('local_email_Data');

                    $userid = $this->UserdataModel->getUserIDbyName($useremail);

                    $date = $this->input->get('datepicker');

                    $pickuptime = $this->input->get('timepicker');

                    $pickupfrom = $this->input->get('PickupAddress');

                    $dropto = $this->input->get('DropOffAddress');

                    $distance = $this->input->get('hiddeninput');

                    $confirmed = 2;

                    $carid = $this->input->get('car');

                    $this->session->set_userdata('Pickup_time', $pickuptime);

                    $this->session->set_userdata('Pickup_date', $date);

                    $this->session->set_userdata('Pickup_location', $pickupfrom);

                    $this->session->set_userdata('Drop_location', $dropto);

                    $this->session->set_userdata('Distance', $distance);

                    $this->session->set_userdata('Car_typeID', $carid);

                    $this->session->set_userdata('Confirmed', $confirmed);

                    $this->session->set_userdata('Passengers', $_GET['passengers']);

                    $this->session->set_userdata('Suitcase', $_GET['suitcase']);
                   $cartype = $this->CarsModel->getCars();
                   
                   
                   $this->db->select() -> from('providercars_info_tbl') -> where('CarID', $this->session->userdata('Car_typeID'));
                   $datas = $this->db->get()->result();
                   
                   $providers = array();
                   
                   $prices = array();
                   
                   foreach($datas as $data)
                   {
                   	$query = $this->db->get_where('provider_tbl', array('ProviderID'=>$data -> ProviderID));
                   	$pro_arr = $query->row();
              //    	 $this->db->select() -> from('provider_tbl') -> where('ProviderID', $data -> ProviderID);
              //     	$pro_arr = $this->db->get()->result();
                   	$providers[] = $pro_arr -> ProviderName;
                   	
                   	
                   	$this->db->select()->from('fares_tbl')->where('ProviderCars_infoID', $data->ProviderCars_infoID);
                    	$query1 = $this->db->get()->result();
           
                    	$normal[] = array();
                     	
                    	
                    	foreach ($query1 as $value) {
                        $this->db->select()->from('fares_normal_tbl')->where('NormalID', $value->NormalID);
                                               
                        $query2 = $this->db->get()->result();
                       
                        
                
                        foreach ($query2 as $value) {
                        
                         $normal[] = $this->session->userdata('Distance');
                            if ($this->session->userdata('Distance') <= 3) {
                            
                         

                                $this->session->set_userdata('fares', ceil($value->n1_3 * $this->session->userdata('Distance')));
                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                              
                                $prices[] = $this->session->userdata('fares');
                          
                            }
                           else if ($this->session->userdata('Distance') > 3 && $this->session->userdata('Distance') <= 5) {
                           
                          


                                $this->session->set_userdata('fares', ceil($value->n3_5 * $this->session->userdata('Distance')));

                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                               
                               $prices[] = $this->session->userdata('fares');
                            }

                           else if ($this->session->userdata('Distance') > 5 && $this->session->userdata('Distance') <= 10) {
                           
                          


                                $this->session->set_userdata('fares', ceil($value->n5_10 * $this->session->userdata('Distance')));

                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                                
                                $prices[] = $this->session->userdata('fares');
                            }


                           else if ($this->session->userdata('Distance') > 10 && $this->session->userdata('Distance') <= 15) {
                           
              

                                $this->session->set_userdata('fares',ceil( $value->n10_15 * $this->session->userdata('Distance')));

                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                                
                                $prices[] = $this->session->userdata('fares');
                            }


                           else if ($this->session->userdata('Distance') > 15 && $this->session->userdata('Distance') <= 20) {
                           
                          


                                $this->session->set_userdata('fares', ceil($value->n15_20 * $this->session->userdata('Distance')));


                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                                
                                $prices[] = $this->session->userdata('fares');
                            }

                           else if ($this->session->userdata('Distance') > 20) {

                                $this->session->set_userdata('fares', ceil($value->n20_100 * $this->session->userdata('Distance')));
                                
                               

                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                                
                                $prices[] = $this->session->userdata('fares');
                            }
                        }
                    }
                   	
                   	
                   }
         

               		
               	 echo json_encode(array('result'=> $cartype, 'providers'=>$providers, 'prices' => $prices, 'normal'=>$normal));

                 //   redirect('compare');

                }

                else

                {

                    $cartyps['cartype'] = $this->CarsModel->getCars();

                    $this->session->set_flashdata('msg','There is no such provider who provide services under this time period !');
                    
                    echo json_encode(array('result'=>"874"));

 //                   $this->load->view('Home',$cartyps);

                }

            }

            else {

                $cartype = $this->CarsModel->getCars();

                $this->session->set_flashdata('msg','Please, Do not select past date !');
                echo json_encode(array('result'=> $cartype));

    //            $this->load->view('Home',$cartyps);

            }

        }
        
        
        
        function get_informations($data){
        
        	foreach ($query1 as $value) {
                        $this->db->select()
                            ->from('fares_normal_tbl')
                            ->where('NormalID', $value->NormalID);
                        $query2 = $this->db->get()->result();
                        foreach ($query2 as $value) {
                            if ($this->session->userdata('Distance') <= 3) {

                                $this->session->set_userdata('fares', ceil($value->n1_3 * $this->session->userdata('Distance')));
                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                                ?>
                                <?php echo "&pound" . $this->session->userdata('fares'); ?>
                                <?php
                            }
                            if ($this->session->userdata('Distance') > 3 && $this->session->userdata('Distance') <= 5) {


                                $this->session->set_userdata('fares', ceil($value->n3_5 * $this->session->userdata('Distance')));

                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                                ?>
                                <?php echo "&pound" . $this->session->userdata('fares'); ?>
                                <?php
                            }

                            if ($this->session->userdata('Distance') > 5 && $this->session->userdata('Distance') <= 10) {


                                $this->session->set_userdata('fares', ceil($value->n5_10 * $this->session->userdata('Distance')));

                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                                ?>
                                <?php echo "&pound" . $this->session->userdata('fares'); ?>
                                <?php
                            }


                            if ($this->session->userdata('Distance') > 10 && $this->session->userdata('Distance') <= 15) {


                                $this->session->set_userdata('fares',ceil( $value->n10_15 * $this->session->userdata('Distance')));

                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                                ?>
                                <?php echo "&pound " . $this->session->userdata('fares'); ?>
                                <?php
                            }


                            if ($this->session->userdata('Distance') > 15 && $this->session->userdata('Distance') <= 20) {


                                $this->session->set_userdata('fares', ceil($value->n15_20 * $this->session->userdata('Distance')));


                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                                ?>
                                <?php echo "&pound " . $this->session->userdata('fares'); ?>
                                <?php
                            }

                            if ($this->session->userdata('Distance') > 20) {

                                $this->session->set_userdata('fares', ceil($value->n20_100 * $this->session->userdata('Distance')));

                                if($this->session->userdata('fares')==0){
                                    $this->session->set_userdata('fares','2.5');
                                }
                                if ($this->session->userdata('increment')) {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares') + $this->session->userdata('increment'));
                                } else {
                                    $this->session->set_userdata('fares', $this->session->userdata('fares'));
                                }
                                $this->session->set_userdata('fares', number_format($this->session->userdata('fares'), 2, '.', ''));
                                ?>
                                <?php echo "&pound " . $this->session->userdata('fares'); ?>
                                <?php
                            }
                        }
                    }
        }

    








    public function getsuggestion()

    {

        $is_login = $this->session->userdata('local_is_Login');

        if(isset($is_login) || ($is_login == true)) {

            $this->load->view('Compare');

        }

        else

        {

            redirect('CommonLoginController');

            die();

        }

    }



    public function checkforsessons()
    {
		
        $is_login = $this->session->userdata('local_is_Login');
        if(isset($is_login) || ($is_login == true)) {
            $this->session->set_userdata('Payment_Method',$this->input->post('paymentmethod'));
            echo json_encode('ok');
        }
        else
        {
            $this->session->set_userdata('Payment_Method',$this->input->post('paymentmethod'));
            echo json_encode('notok');
        }

    }



 public function confirmedBooking()

 {

    $data['bookinginfo'] = array(

        'Pickup_time'=> $this->session->userdata('Pickup_time'),

        'Pickup_date'=> $this->session->userdata('Pickup_date'),

        'Pickup_location'=> $this->session->userdata('Pickup_location'),

        'Drop_location'=> $this->session->userdata('Drop_location'),

        'Distance'=> $this->session->userdata('Distance'),

        'Total_fare' => $_GET['fares'],

        'Car_typeID' => $this->session->userdata('Car_typeID'),

        'Confirmed' => $this->session->userdata('Confirmed'),

        'LocalID' => '2',

        'Car_Model_Name' => '0',

        'ProviderID' => $_GET['company'],

        'BookingDate' => date('m/d/Y')

    );





    /*if($this->db->insert('bookings_tbl',$data['bookinginfo']))

    {

        $this->session->set_userdata('Pickup_time',"");

        $this->session->set_userdata('Pickup_date',"");

        $this->session->set_userdata('Pickup_location',"");

        $this->session->set_userdata('Drop_location',"");

        $this->session->set_userdata('Distance',"");

        $this->session->set_userdata('Car_typeID',"");

        $this->session->set_userdata('Confirmed',"");

        echo "done successfully";

    }

    else

        echo "fail";*/



 }

}

?>