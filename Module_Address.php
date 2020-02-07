<?php
namespace GDO\Address;

use GDO\Core\GDO_Module;
use GDO\User\GDO_User;
use GDO\User\GDO_UserSetting;
use GDO\UI\GDT_Divider;

/**
 * Module that adds address related functionality.
 * @author gizmore
 * @version 6.10
 * @since 6.02
 */
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
			GDO_Address::table()->gdoColumnsExcept(
				'address_id', 'address_created', 'address_creator',
				'div_company_address', 'div_person_address', 'div_contact_address'
			)
		);
	}
	
	public function cfgCountry() { return $this->getConfigValue('address_country'); }
	public function cfgCountryId() { return $this->getConfigVar('address_country'); }
	public function cfgZIP() { return $this->getConfigVar('address_zip'); }
	public function cfgCity() { return $this->getConfigVar('address_city'); }
	public function cfgStreet() { return $this->getConfigVar('address_street'); }
	
	public function cfgName() { return $this->getConfigVar('address_name'); }
	public function cfgPhone() { return $this->getConfigVar('address_phone'); }
	public function cfgMobile() { return $this->getConfigVar('address_phone_fax'); }
	public function cfgFax() { return $this->getConfigVar('address_phone_mobile'); }
	public function cfgEmail() { return $this->getConfigVar('address_email'); }
	
	public function cfgAddress()
	{
		return GDO_Address::blank(array(
			'address_name' => $this->cfgName(),
			'address_country' => $this->cfgCountryId(),
			'address_zip' => $this->cfgZIP(),
			'address_city' => $this->cfgCity(),
			'address_street' => $this->cfgStreet(),
			'address_phone' => $this->cfgPhone(),
			'address_phone_fax' => $this->cfgMobile(),
			'address_phone_mobile' => $this->cfgFax(),
			'address_email' => $this->cfgEmail(),
		));
	}
	
	public function getUserSettings()
	{
		return GDO_Address::table()->gdoColumnsExcept('address_id', 'address_created', 'address_creator');
	}
	
	public function getUserConfig()
	{
		return array(
			GDT_Address::make('user_address'),
		);
	}
	
	public function cfgUserAddress(GDO_User $user)
	{
		if ($address = GDO_UserSetting::userGet($user, 'user_address')->getValue())
		{
			return $address;
		}
		else
		{
			return GDO_Address::blank(array(
				'address_zip' => t('zip'),
				'address_city' => t('city'),
				'address_street' => t('street'),
			));
		}
	}
	
	############
	### Hook ###
	############
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
