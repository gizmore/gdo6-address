<?php
namespace GDO\Address;

use GDO\Country\Country;
use GDO\Country\GDO_Country;
use GDO\DB\GDO;
use GDO\DB\GDO_AutoInc;
use GDO\DB\GDO_CreatedAt;
use GDO\DB\GDO_CreatedBy;
use GDO\Template\GDO_Template;
use GDO\Type\GDO_String;

final class Address extends GDO
{
    ###########
    ### GDO ###
    ###########
    public function gdoColumns()
    {
        return array(
            GDO_AutoInc::make('address_id'),
            GDO_Country::make('address_country'),
            GDO_String::make('address_zip')->ascii()->caseS()->max(10)->label('zip'),
            GDO_String::make('address_city')->max(128)->label('city'),
            GDO_String::make('address_street')->max(128)->label('street'),
            GDO_CreatedAt::make('address_created'),
            GDO_CreatedBy::make('address_creator'),
        );
    }
    
    ##############
    ### Getter ###
    ##############
    /**
     * @return Country
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
    public function renderList() { return GDO_Template::php('Address', 'listitem/address.php', ['address' => $this]); }
}
