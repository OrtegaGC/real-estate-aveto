<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class Banner extends MY_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('stranica/homemodel');
    }

	public function id()
	{
		$id = $this->uri->segment(3);
		if (parent::checkID('banner', 'bannerID', $id) == TRUE)
		{
			$data = $this->homemodel->banner($id);
			parent::brojPregledaBannera($id);
			redirect($data[0]['webStranica']);
		} else {
			show_404();
		}
	}
	
}

