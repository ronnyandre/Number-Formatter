<?php if (!defined('BASEPATH')) exit('No direct script access is allowed');

$plugin_info = array(
	'pi_name'        => 'Number Formatter',
	'pi_version'     => '0.2',
	'pi_author'      => 'Ronny-André Bendiksen',
	'pi_author_url'  => 'http://ronny-andre.no',
	'pi_description' => 'Formats numbers with custom number of decimals and separators for decimals and thousands.',
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
		
		$prefix        = $this->EE->TMPL->fetch_param('prefix');
		$suffix        = $this->EE->TMPL->fetch_param('suffix');
		
		$this->return_data = $prefix.
							 number_format((double)$number, $decimals, $dec_point, $thousands_sep).
							 $suffix;
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

Overriding the defaults:
{exp:number_formatter decimals="2" decimal_point="," thousands_separator="."}1000000{/exp:number_formatter}
Returns 1.000.000,00

You can prefix and suffix text if you'd like:
{exp:number_formatter decimals="2" decimal_point="," thousands_separator="." prefix="$" suffix=" (USD)"}1000000{/exp:number_formatter}
Returns $1.000.000,00 (USD)


=====================================================
Parameters
=====================================================

decimals
Number of decimals in number.

decimal_point
Character to use as decimal point.

thousands_sep
Character to use as thousands separator.

prefix
Text to prefix the number formatting.

suffix
Text to suffix the number formatting.


=====================================================
Changelog
=====================================================

23/11/2011 - 0.2
Added parameters for prefix and suffix.

23/11/2011 - 0.1
Initial (basic) version.
		<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
	
}

/* End of file pi.number_formatter.php */
/* Location: ./system/expressionengine/third_party/number_formatter/pi.number_formatter.php */