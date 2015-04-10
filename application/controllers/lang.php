<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class Lang extends MY_Controller {

	
	// -- index stranica lang kontrolera
	// -- preusmjerava na početnu stranicu u slučaju pristupa preko url-a
	public function index()
	{
		redirect('stranica/index');
	}
	
	// -- hrvatski jezik
	public function hr()
	{
		$cookie = array(
			'name'   => 'lang',
			'value'  => 'hr',
			'expire' => '86400'  // -- jedan dan izražen u sekundama
		);
		set_cookie($cookie);
		redirect(base_url());
	}
	
	// -- engleski jezik
	public function en()
	{
		$cookie = array(
			'name'   => 'lang',
			'value'  => 'en',
			'expire' => '86400'
		);
		set_cookie($cookie);
		redirect(base_url());
	}
	
	// -- njemački jezik
	public function de()
	{
		$cookie = array(
			'name'   => 'lang',
			'value'  => 'de',
			'expire' => '86400' 
		);
		set_cookie($cookie);
		redirect(base_url());
	}
	
	// -- talijanski jezik
	public function it()
	{
		$cookie = array(
			'name'   => 'lang',
			'value'  => 'it',
			'expire' => '86400'
		);
		set_cookie($cookie);
		redirect(base_url());
	}
	
	// -- francuski jezik
	public function fr()
	{
		$cookie = array(
			'name'   => 'lang',
			'value'  => 'fr',
			'expire' => '86400'
		);
		set_cookie($cookie);
		redirect(base_url());
	}
	
}

