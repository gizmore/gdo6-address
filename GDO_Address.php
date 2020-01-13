<?php
namespace GDO\Address;

use GDO\Country\GDO_Country;
use GDO\Country\GDT_Country;
use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_CreatedBy;
use GDO\Core\GDT_Template;
use GDO\DB\GDT_String;
use GDO\Mail\GDT_Email;
use GDO\User\GDT_Realname;
use GDO\UI\GDT_Divider;
use GDO\User\GDO_User;

final class GDO_Address extends GDO
{
	###########
	### GDO ###
	###########
	public function gdoColumns()
	{
		return array(
			GDT_AutoInc::make('address_id'),
			GDT_Divider::make('div_company_address')->label('div_company_address'),
			GDT_Realname::make('address_company')->label('company'),
			GDT_String::make('address_vat')->label('vat')->max(32),
			# Required
			GDT_Divider::make('div_person_address')->label('div_person_address'),
			GDT_Realname::make('address_name')->label('address_name'),
			GDT_String::make('address_street')->max(128)->label('street'),
			GDT_String::make('address_zip')->ascii()->caseS()->max(10)->label('zip'),
			GDT_String::make('address_city')->max(128)->label('city'),
			GDT_Country::make('address_country')->notNull(),
			# Optional
			GDT_Divider::make('div_contact_address')->label('div_contact_address'),
			GDT_Phone::make('address_phone')->label('phone'),
			GDT_Phone::make('address_phone_fax')->label('fax'),
			GDT_Phone::make('address_phone_mobile')->label('mobilephone'),
			GDT_Email::make('address_email')->label('email'),
			# Special
			GDT_CreatedAt::make('address_created'),
			GDT_CreatedBy::make('address_creator'),
		);
	}
	
	##############
	### Getter ###
	##############
	/**
	 * @return GDO_Country
	 */
	public function getCountry() { return $this->getValue('address_country'); }
	public function getCountryID() { return $this->getVar('address_country'); }
	public function getZIP() { return $this->getVar('address_zip'); }
	public function getCity() { return $this->getVar('address_city'); }
	public function getStreet() { return $this->getVar('address_street'); }
	public function getRealName() { return $this->getVar('address_name'); }
	
	public function getPhone() { return $this->getVar('address_phone'); }
	public function getFax() { return $this->getVar('address_phone_fax'); }
	public function getMobile() { return $this->getVar('address_phone_mobile'); }
	public function getEmail() { return $this->getVar('address_email'); }
	
	/**
	 * @return GDO_User
	 */
	public function getCreator() { return $this->getValue('address_creator'); }
	public function getCreatorId() { return $this->getVar('address_creator'); }
	
	##############
	### Helper ###
	##############
	public function emptyAddress()
	{
		return (!($this->getCountryID() || $this->getZIP() || $this->getStreet() || $this->getCity()));
	}
	
	############
	### HREF ###
	############
	public function href_edit() { return href('Address', 'Crud', '&id='.$this->getID()); }
	public function href_btn_set_primary_address() { return href('Address', 'SetPrimary', "&id={$this->getID()}"); }

	##############
	### Render ###
	##############
	public function renderCell() { return GDT_Address::make()->gdo($this)->renderCell(); }
	public function renderList() { return GDT_Template::php('Address', 'listitem/address.php', ['address' => $this]); }
	public function renderCard() { return GDT_Template::php('Address', 'card/address.php', ['address' => $this]); }
	public function renderChoice() { return t('address_choice', [$this->display('address_name'), $this->display('address_street')]); }
}
