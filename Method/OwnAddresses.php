<?php
namespace GDO\Address\Method;

use GDO\Table\MethodQueryTable;
use GDO\Address\GDO_Address;
use GDO\User\GDO_User;
use GDO\UI\GDT_Button;

final class OwnAddresses extends MethodQueryTable
{
	public function getQuery()
	{
		$uid = GDO_User::current()->getID();
		return GDO_Address::table()->select()->where("address_creator={$uid}");
	}
	
	public function getHeaders()
	{
		$a = GDO_Address::table();
		return array(
			GDT_Button::make('btn_set_primary_address'),
			$a->gdoColumn('address_company'),
			$a->gdoColumn('address_name'),
			$a->gdoColumn('address_street'),
			$a->gdoColumn('address_city'),
		);
	}
	
}