<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by: Martin Lazarov
 *
 *
 *
 */
class Home extends CI_Controller {

	public function index(){
		$this->load->helper('number');
		
		$this->load->library('curl');
		$this->curl->create($this->config->item('haproxy_url').';csv');
		$this->curl->http_login('admin','shterev');
		
		$csv = trim(substr($this->curl->execute(),2));
		$lines = explode("\n",$csv);
		//var_dump($lines);exit;
		$headers = explode(",",$lines[0]);
		unset($lines[0]);
		
		$data = array();
		// prepare data
		foreach($lines as $line){
			$t = explode(",",$line);
			$items= array();
			foreach($t as $item_id=>$item_value){
				$items[$headers[$item_id]] = $item_value;
			}
			
			$data[$t[0]][$t[1]] = $items; 
		}
		//var_dump($data);exit;
		
		$this->load->view('home',array('data'=>$data));
	}
}
