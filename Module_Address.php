<?php
namespace GDO\Address;

use GDO\Core\GDO_Module;
use GDO\User\GDO_User;
use GDO\User\GDO_UserSetting;
use GDO\UI\GDT_Divider;

final class Module_Address extends GDO_Module
{
	public $module_priority = 10;

	public function getClasses() { return ['GDO\\Address\\GDO_Address']; }
	
	public function onLoadLanguage() { return $this->loadLanguage('lang/address'); }
	
	public function getConfig()
	{
		return array_merge(
			array(
				GDT_Divider::make('div_owner_address')->label('div_owner_address'),
			),
			GDO_Address::table()->gdoColumnsExcept('address_id', 'address_created', 'address_creator'),
		);
	}
	
	public function cfgCountry() { return $this->getConfigValue('address_country'); }
	public function cfgCountryId() { return $this->getConfigVar('address_country'); }
	public function cfgZIP() { return $this->getConfigVar('address_zip'); }
	public function cfgCity() { return $this->getConfigVar('address_city'); }
	public function cfgStreet() { return $this->getConfigVar('address_street'); }
	
	public function cfgAddress()
	{
		return GDO_Address::blank(array(
			'address_country' => $this->cfgCountryId(),
			'address_zip' => $this->cfgZIP(),
			'address_city' => $this->cfgCity(),
			'address_street' => $this->cfgStreet(),
		));
	}
	
	
	public function getUserConfig()
	{
		return array(
			GDT_Address::make('user_address'),
		);
	}
	
	public function cfgUserAddress()
	{
		if ($address = GDO_UserSetting::get('user_address')->getValue())
		{
			return $address;
		}
		else
		{
			return GDO_Address::blank();
		}
	}
	
	public function getUserSettings()
	{
		return GDO_Address::table()->gdoColumnsExcept('address_id', 'address_created', 'address_creator');
	}
	
	public function hookUserSettingSaved(GDO_Module $module, GDO_User $user, array $changes)
	{
		if ($module === $this)
		{
			$this->updateUserAddress($user);
		}
	}
	
	private function updateUserAddress(GDO_User $user)
	{
		$address = GDO_Address::blank(array(
			'address_country' => GDO_UserSetting::get('address_country')->getVar(),
			'address_zip' => GDO_UserSetting::get('address_zip')->getVar(),
			'address_city' => GDO_UserSetting::get('address_city')->getVar(),
			'address_street' => GDO_UserSetting::get('address_street')->getVar(),
		))->insert();
		GDO_UserSetting::set('user_address', $address->getID());
	}

}
