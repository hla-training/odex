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
		$this->load->view('welcome_message');
	}
	public function getdataapi()
	{
	$curl = curl_init();
	$url = 'https://api.bnm.gov.my/public/base-rate/BKKBMYKL';
	curl_setopt_array($curl, array(
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => array(
"Accept: application/vnd.BNM.API.v1+json",
"Access-Control-Allow-Origin: *"
),
));
$response = curl_exec($curl);
curl_close($curl);
$results = json_decode($response, true);
if(strpos($url,'bnm') !== false){
$resultso = $results["data"];
} else {
	$resultso = $results["result"]["records"];
	}
	if (array_key_exists(0,$resultso)){
	$fp = fopen(getcwd().'/data/sample.csv', 'w');
	fputcsv($fp,array_keys($resultso[0]));
	foreach ($resultso as $result) {
	if (fputcsv($fp, $result) === false) {
	return false;
	}
	}
	fclose($fp);
} else {
return false;
}
}
public function ckandataset()
{
	$curl = curl_init();
	$data = json_encode(array(
	'name' => 'nama dataset',
	'notes' => 'dataset',
	'owner_org'=> 'organisasi',
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
	"Authorization: 6a7b52e5-28a5-42d9-a977-9a2e3bc26d22"
	),
	));
	$response = curl_exec($curl);
curl_close($curl);
echo $response;
}
public function ckanresource()
{
$curl = curl_init();
$data = json_encode(array(
'url' => 'http://103.253.145.248/zaimar/odex/data/sample.csv',
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
echo $response;
}
public function datacleaning()
{
exec('python3 datacleaning.py');
}
}