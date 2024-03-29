<?php
namespace GDO\Address\Method;

use GDO\Core\Method;
use GDO\Address\GDT_Address;
use GDO\Address\GDO_Address;
use GDO\Core\Website;
use GDO\Address\Module_Address;

/**
 * Set primary address for a user.
 * @author gizmore
 */
final class SetPrimary extends Method
{
	/**
	 * @var GDO_Address
	 */
	private $address;
	
	public function gdoParameters()
	{
		return [
			GDT_Address::make('id')->onlyOwn()->notNull(),
		];
	}
	
	public function onInit()
	{
		$this->address = $this->gdoParameterValue('id');
	}
	
	public function execute()
	{
	    Module_Address::instance()->saveSetting('user_address', $this->address->getID());
		return Website::redirectMessage('msg_address_set_primary', null, Website::hrefBack());
	}
	
}
