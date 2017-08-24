<?php
namespace GDO\Address\Method;

use GDO\Address\Address;
use GDO\Form\MethodCrud;

final class Crud extends MethodCrud
{
    public function hrefList() { return href('Address', 'List'); }

    public function gdoTable() { return Address::table(); }
    
}
