<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		echo "Start";
		$curl = curl_init();
        $data = json_encode(array(
		     'name' => 'test data',
             'notes' => 'dataset',
             'owner_org'=> 'test org',
      
		 ));

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://demo.ckan.org/api/3/action/package_create",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
       CURLOPT_HTTPHEADER => array(
                  "Authorization: 2002fbaa-3f28-4515-a90f-9f7868d0dd8a"
                ),
          ));

        $response = curl_exec($curl);
        curl_close($curl);
      
		echo $response;
		die;
	}

	public function nash()
	{
		$this->load->view('welcome_message');
	}
}
