<?php
namespace GDO\Address;

use GDO\Core\Module;

final class Module_Address extends Module
{
    public $module_priority = 10;
    public function getClasses() { return ['GDO\Address\Address']; }
    public function onLoadLanguage() { $this->loadLanguage('lang/address'); }
}
