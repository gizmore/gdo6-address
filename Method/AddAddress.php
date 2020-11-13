<?php
namespace GDO\Address\Method;

use GDO\Form\GDT_Form;
use GDO\Form\MethodForm;
use GDO\Address\GDO_Address;
use GDO\Form\GDT_Submit;
use GDO\Form\GDT_AntiCSRF;
use GDO\Core\Website;
use GDO\Util\Common;
use GDO\Address\Module_Address;

final class AddAddress extends MethodForm
{
	public function createForm(GDT_Form $form)
	{
		$fields = GDO_Address::table()->gdoColumnsExcept('address_id', 'address_creator', 'address_created');
		$form->addFields($fields);
		$form->addFields(array(
			GDT_Submit::make(),
			GDT_AntiCSRF::make(),
		));
	}
	
	public function formValidated(GDT_Form $form)
	{
		$address = GDO_Address::blank($form->getFormData())->insert();
		Module_Address::instance()->saveSetting('user_address', $address->getID());
		return $this->message('msg_address_created_and_selected')->add(Website::redirect(Common::getRequestString('rb')));
	}

}
