<?phpuse GDO\Address\GDT_Address;use GDO\Address\GDO_Address;/** @var $field GDT_Address **/$field instanceof GDT_Address;/** @var $address GDO_Address **/$address instanceof GDO_Address;echo "<div>" . $address->display('address_name') . "<br/>\n";echo "" . $address->display('address_street') . "<br/>\n";echo "" . $address->display('address_zip') . "&nbsp;" . $address->display('address_city') . "&nbsp;" . $address->getCountry()->displayName() . "</div>\n";if (!$field->small){	echo "<div>\n";	if ($phone = $address->getPhone())	{		echo t('tel') . ':&nbsp;' . html($phone) . "<br/>\n";	}	if ($fax = $address->getFax())	{		echo t('fax') . ':&nbsp;' . html($fax) . "<br/>\n";	}	if ($mobile = $address->getMobile())	{		echo t('mobile') . ':&nbsp;' . html($mobile) . "<br/>\n";	}	if ($email = $address->getEmail())	{		echo t('email') . ':&nbsp;' . html($email) . "<br/>\n";	}	echo "</div>\n";}