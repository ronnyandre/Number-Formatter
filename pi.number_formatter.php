<?php if (!defined('BASEPATH')) exit('No direct script access is allowed');

$plugin_info = array(
	'pi_name'        => 'Number Formatter',
	'pi_version'     => '0.1',
	'pi_author'      => 'Ronny-André Bendiksen',
	'pi_author_url'  => 'http://ronny-andre.no',
	'pi_description' => 'Formats numbers with custom definable number of decimals, decimals and thousands separators.',
	'pi_usage'       => Number_Formatter::usage()
);

class Number_Formatter {
	
	var $return_data = '';
	
	function __construct() {
		$this->EE =& get_instance();
		
		$number        = trim($this->EE->TMPL->tagdata);
		$decimals      = $this->EE->TMPL->fetch_param('decimals') ? $this->EE->TMPL->fetch_param('decimals') : 0;
		$dec_point     = $this->EE->TMPL->fetch_param('decimal_point') ? $this->EE->TMPL->fetch_param('decimal_point') : ',';
		$thousands_sep = $this->EE->TMPL->fetch_param('thousands_sep') ? $this->EE->TMPL->fetch_param('thousands_sep') : ' ';
		
		$this->return_data = number_format($number, $decimals, $dec_point, $thousands_sep);
	}
	
	public function usage() {
		ob_start() ?>
Number Formatter lets you format numbers with custom amount of decimals, custom decimal and thousands separators.

=====================================================
Basic Usage
=====================================================

To format a number, use the following code:
{exp:number_formatter}1000000{/exp:number_formatter}
Returns 1 000 000

Defaults:
Number of decimals is 0.
Decimal point separator is comma.
Thousands separator is space.

You can override the defaults as well:
{exp:number_formatter decimals="2" decimal_point="," thousands_separator="."}1000000{/exp:number_formatter}
Returns 1.000.000,00


=====================================================
Parameters
=====================================================

decimals
Number of decimals in number.

decimal_point
Character to use as decimal point.

thousands_sep
Character to use as thousands separator.
		<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
	
}

/* End of file pi.number_formatter.php */
/* Location: ./system/expressionengine/third_party/number_formatter/pi.number_formatter.php */