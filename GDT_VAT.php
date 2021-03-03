<?php
namespace GDO\Address;

use GDO\DB\GDT_String;

/**
 * Tax number.
 * @TODO tax validation, depending on country...
 * @author gizmore
 */
final class GDT_Vat extends GDT_String
{
    public function defaultLabel() { return $this->label('vat'); }

    public $max = 32;
    public $encoding = self::ASCII;
    public $caseSensitive = false;

}
