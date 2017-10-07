<?php
namespace GDO\Address;

use GDO\Country\GDO_Country;
use GDO\Country\GDT_Country;
use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_CreatedBy;
use GDO\Core\GDT_Template;
use GDO\DB\GDT_String;

final class GDO_Address extends GDO
{
    ###########
    ### GDO ###
    ###########
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('address_id'),
            GDT_Country::make('address_country'),
            GDT_String::make('address_zip')->ascii()->caseS()->max(10)->label('zip'),
            GDT_String::make('address_city')->max(128)->label('city'),
            GDT_String::make('address_street')->max(128)->label('street'),
            GDT_CreatedAt::make('address_created'),
            GDT_CreatedBy::make('address_creator'),
        );
    }
    
    ##############
    ### Getter ###
    ##############
    /**
     * @return GDO_Country
     */
    public function getCountry() { return $this->getValue('address_country'); }
    public function getCountryID() { return $this->getVar('address_country'); }
    public function getZIP() { return $this->getVar('address_zip'); }
    public function getCity() { return $this->getVar('address_city'); }
    public function getStreet() { return $this->getVar('address_street'); }
    
    ############
    ### HREF ###
    ############
    public function href_edit() { return href('Address', 'Crud', '&id='.$this->getID()); }

    ##############
    ### Render ###
    ##############
    public function renderList() { return GDT_Template::php('Address', 'listitem/address.php', ['address' => $this]); }
}
