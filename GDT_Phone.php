<?php
namespace GDO\Address;

use GDO\DB\GDT_String;

/**
 * A phone number.
 * 
 * @TODO validate existing country phone codes. validate plausible length.
 * @TODO write a phone-validator module that uses gdo6-sms to validate a phone.
 * 
 * @author gizmore
 * @version 6.10.1
 * @since 6.8.0
 */
final class GDT_Phone extends GDT_String
{
	public function defaultLabel() { return $this->label('phone'); }
	
	protected function __construct()
	{
	    parent::__construct();
		$this->min = 7;
		$this->max = 20;
		$this->pattern = "#^\\+?[-/0-9 ]+$#Ds";
		$this->encoding = self::ASCII;
	}
	
	public function plugVar()
	{
	    return '+49 176 / 59 59 88 44';
	}
	
}
