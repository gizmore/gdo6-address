<?php
namespace GDO\Address;

use GDO\DB\GDT_Object;

final class GDT_Address extends GDT_Object
{
    public function __construct()
    {
        $this->table(GDO_Address::table());
    }
}
