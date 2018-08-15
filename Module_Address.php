<?php
namespace GDO\Address;

use GDO\Core\GDO_Module;

final class Module_Address extends GDO_Module
{
	public $module_priority = 10;
	public function getClasses() { return ['GDO\Address\GDO_Address']; }
	public function onLoadLanguage() { $this->loadLanguage('lang/address'); }
}
