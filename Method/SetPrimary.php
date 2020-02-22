<?php
namespace GDO\Address\Method;

use GDO\Core\Method;
use GDO\User\GDO_User;
use GDO\Address\GDT_Address;
use GDO\Address\GDO_Address;
use GDO\User\GDO_UserSetting;
use GDO\Core\Website;

final class SetPrimary extends Method
{
	/**
	 * @var GDO_Address
	 */
	private $address;
	
	public function gdoParameters()
	{
		return array(
			GDT_Address::make('id')->notNull(),
		);
	}
	
	public function init()
	{
		$this->address = $this->gdoParameterValue('id');
	}
	
	public function hasUserPermission(GDO_User $user)
	{
		if ($this->address)
		{
			return $this->address->getCreator() === $user ? true : $this->error('err_invalid_choice');
		}
		else
		{
			return $this->error('err_no_permission');
		}
	}
	
	public function execute()
	{
		GDO_UserSetting::set('user_address', $this->address->getID());
		return $this->message('msg_address_set_primary')->add(Website::redirectBack());
	}

	
}
