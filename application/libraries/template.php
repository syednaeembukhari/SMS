<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {

	var $template_data = array();
	var $Db;
	
	function set($name, $value) {
		$this->template_data[$name] = $value;
	}

	function load($view = '', $data = '',$onlyview=false,$returndata=false) {
		$theme = 'default';

		$this->CI =& get_instance();
		$this->CI->load->vars($data);
		if(!$onlyview)
		$this->header($theme);
		if($returndata)
			return $this->CI->load->view($theme.'/'.$view,$data,true);
		else
			$this->CI->load->view($theme.'/'.$view);
		if(!$onlyview)
		$this->footer($theme);
	}

	function header($theme) {
		
		$this->CI->load->view($theme.'/header');
	}

	function footer($theme) {
		$this->CI->load->view($theme.'/footer');
	}

	function template_url($isecho=true) {
		
		$url=base_url().'application/views/2014/';
		if($isecho)
		echo $url;
		else
		return $url;
	}
	
	function attach_script_files($filenames,$isecho=true) {
		$theme = 'default';
		$url=base_url().'themes/'.$theme.'/';
		$data='';
		if(is_array($filenames))
		{
			foreach($filenames as $file)
			$data.='<script type="text/javascript" src="'.$url.$file.'"></script>'."\n";
		}
		else
		{
			$data.='<script type="text/javascript" src="'.$url.$filenames.'"></script>'."\n";
			
		}
		
		if($isecho)
		echo $data;
		else
		return $data;
	}
	function attach_css_files($filenames,$isecho=true) {
		$theme = 'default';
		$url=base_url().'themes/'.$theme.'/';
		$data='';
		if(is_array($filenames))
		{
			foreach($filenames as $file)
			$data.='<link href="'.$url.$file.'" media="all" rel="stylesheet" type="text/css" />'."\n";
		}
		else
		{
			$data.='<link href="'.$url.$filenames.'" media="all" rel="stylesheet" type="text/css" />'."\n";
			
		}
		
		if($isecho)
		echo $data;
		else
		return $data;
	}
	
    function add_css_inheader($cssfiles=NULL) {
		$html='';
		if($cssfiles)
		foreach($cssfiles as $css)
		{
			$html.="<link rel=\"stylesheet\" href=\"". $this->template_url(false).$css."\">\n\t";
		}
		return $html;
	}
	
	function add_js_infooter($jsfiles=NULL) {
		$html='';
		if($jsfiles)
		foreach($jsfiles as $js)
		{
			$html.="<script type=\"text/javascript\" src=\"". $this->template_url(false).$js."\"></script>\n\t";
		}
		return $html;
	}
	
	function add_script_file_infooter($script_view=NULL) {
		
		if($script_view)
		{
			$theme = 'default';
			$this->CI =& get_instance();
			return $this->CI->load->view($theme.'/'.$script_view['view'],$script_view['data'],true);
		}
		else
		return '';
	}
	
	function check_validation()
	{
		$obj=&get_instance();
		if($obj->uri->segment(2)!='prohibited')
		{
		if(validation_errors())
		{
			echo '<div class="msg msg-error"><p>'.validation_errors().'</p></div>';
		}

		if($obj->session->flashdata('sad'))
		{
			echo '<div class="msg msg-sad"><p>'.$obj->session->flashdata('sad').'</p></div>';
		}

		if($obj->session->flashdata('happy'))
		{
			echo '<div class="msg msg-happy"><p>'.$obj->session->flashdata('happy').'</p></div>';
		}
		}

	}
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */