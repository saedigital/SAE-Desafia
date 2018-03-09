<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template
{

	public function View($content, $data=NULL, $template='default')
	{
		$CI =& get_instance();
		$data['content'] = $CI->load->view($content, $data, TRUE);
		return $CI->load->view('_template/'.$template, $data);

	}

}
