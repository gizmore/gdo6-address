<?php
namespace GDO\Address;

use GDO\DB\GDT_Object;
use GDO\Core\GDT_Template;

final class GDT_Address extends GDT_Object
{
	public function __construct()
	{
		$this->table(GDO_Address::table());
	}
	
	public function renderCell()
	{
		$tVars = array(
			'gdt' => $this,
			'address' => $this->gdo,
		);
		return GDT_Template::php('Address', 'cell/address.php', $tVars);
	}
}
