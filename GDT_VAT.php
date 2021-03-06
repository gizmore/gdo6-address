<?php
namespace GDO\Address;

use GDO\DB\GDT_String;

/**
 * Tax number.
 * @TODO tax validation, depending on country...
 * @author gizmore
 */
final class GDT_VAT extends GDT_String
{
    public function defaultLabel() { return $this->label('vat'); }

    public $max = 32;
    public $encoding = self::ASCII;
    public $caseSensitive = false;

    public function plugVar()
    {
        return '38/107/05324';
    }

}
