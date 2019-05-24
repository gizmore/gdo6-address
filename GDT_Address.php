<?php
namespace GDO\Address;

use GDO\DB\GDT_Object;
use GDO\Core\GDT_Template;
use GDO\DB\Query;
use GDO\Core\GDO;

/**
 * A GDT_Object for GDO_Address.
 * Filter is searching street and country as well.
 * @author gizmore
 * @see \GDO\Address\GDO_Address
 */
final class GDT_Address extends GDT_Object
{
	public function __construct()
	{
		$this->table(GDO_Address::table());
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
