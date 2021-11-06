<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('link_script'))
{
	function link_script($src, $print = FALSE)
	{
		if ( $print ) {
			$link = "<script type='text/javascript'>\n" . file_get_contents(FCPATH . $src) . "\n</script>\n";
		} else {
			$CI =& get_instance();
			$link = '<script type="text/javascript" ';

			if (preg_match('#^([a-z]+:)?//#i', $src))
			{
				$link .= 'src="'.$src.'" ';
			}
			else
			{
				$link .= 'src="'.$CI->config->slash_item('base_url').$src.'" ';
			}

			$link .= "></script>\n";
		}

		return $link;
	}
}

/* End of file tun_helper.php */
/* Location: ./application/helpers/tun_helper.php */
