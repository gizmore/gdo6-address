<?php
namespace GDO\Address;

use GDO\Type\GDT_String;

final class GDT_Phone extends GDT_String
{
	public function __construct()
	{
		$this->min = 7;
		$this->max = 20;
		$this->pattern = "#^\\+?[-/0-9 ]+$#";
		$this->encoding = self::ASCII;
	}
	
}