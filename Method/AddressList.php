<?php
namespace GDO\Address\Method;

use GDO\Address\Address;
use GDO\Table\MethodQueryList;

final class AddressList extends MethodQueryList
{
    public function gdoTable() { return Address::table(); }
}
