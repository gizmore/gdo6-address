<?php
namespace GDO\Address;

use GDO\Core\GDT_Template;
use GDO\DB\Query;
use GDO\Core\GDO;
use GDO\DB\GDT_ObjectSelect;
use GDO\User\GDO_User;
use GDO\User\GDO_UserSetting;

/**
 * A GDT_Object for GDO_Address.
 * Filter is searching street and country as well.
 * @author gizmore
 * @see \GDO\Address\GDO_Address
 */
final class GDT_Address extends GDT_ObjectSelect
{
	public function __construct()
	{
		$this->table(GDO_Address::table());
		$this->orderField = 'address_street';
	}
	
	public $onlyOwn = false;
	public function onlyOwn($onlyOwn=true)
	{
		$this->onlyOwn = $onlyOwn;
		return $this;
	}
	
	public function getChoices()
	{
		if ($this->onlyOwn)
		{
			$uid = GDO_User::current()->getID();
			$this->var(GDO_UserSetting::get('user_address')->getVar());
			return $this->table->allWhere("address_creator=$uid");
		}
		return $this->table->all();
	}
	
	/**
	 * @return \GDO\Address\GDO_Address
	 */
	public function getAddress()
	{
		return $this->getValue();
	}
	
	public function renderCell()
	{
		$tVars = array(
			'gdt' => $this,
			'address' => $this->gdo,
		);
		return GDT_Template::php('Address', 'cell/address.php', $tVars);
	}
	
	public $small = false;
	public function small($small) { $this->small = $small; return $this; } 
	
	public function renderPDF()
	{
		$tVars = array(
			'field' => $this,
			'address' => $this->gdo,
		);
		return GDT_Template::php('Address', 'card/address_pdf.php', $tVars);
	}

	public function filterQuery(Query $query)
	{
		if ($filter = $this->filterValue())
		{
			$filter = GDO::escapeSearchS($filter);
			$this->filterQueryCondition($query, "address_zip LIKE '%$filter%' OR address_city LIKE '%$filter%' OR address_street LIKE '%$filter%'");
		}
	}
	
	public function filterGDO(GDO $gdo)
	{
		if ('' !== ($filter = (string)$this->filterValue()))
		{
			$address = $this->getAddress();
			$fields = array(
				$address->getZIP(),
				$address->getCity(),
				$address->getStreet(),
			);
			foreach ($fields as $field)
			{
				if (mb_strpos($field, $filter) !== false)
				{
					return true;
				}
			}
		}
		return false;
	}
}
