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
		 $curl = curl_init();
         $data = json_encode(array(
		    'url' => 'http://odex.data.gov.my/data/test.csv',
            'name' => 'test name',
            'description'=> 'descriptions',
         'format'=>'csv', 
         'package_id' => 'package name'
		 ));

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://demo.ckan.org/api/3/action/resource_create",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
                  "Authorization: 6a7b52e5-28a5-42d9-a977-9a2e3bc26d22"
                ),
          ));

        $response = curl_exec($curl);
        curl_close($curl);

		echo  $response;
		die;
	}

	public function nash()
	{
		$this->load->view('welcome_message');
	}
}
