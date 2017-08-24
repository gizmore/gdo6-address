<?php
namespace GDO\Address;

use GDO\DB\GDO_Object;

final class GDO_Address extends GDO_Object
{
    public function __construct()
    {
        $this->table(Address::table());
    }
}
