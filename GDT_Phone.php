<?php
namespace GDO\Address;

use GDO\DB\GDT_String;

final class GDT_Phone extends GDT_String
{
	public function defaultLabel() { return $this->label('phone'); }
	
	public function __construct()
	{
		$this->min = 7;
		$this->max = 20;
		$this->pattern = "#^\\+?[-/0-9 ]+$#";
		$this->encoding = self::ASCII;
	}
	
}
