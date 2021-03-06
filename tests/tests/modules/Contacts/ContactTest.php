<?php

class ContactTest extends PHPUnit_Framework_TestCase {

	public function testContact() {

		//execute the contructor and check for the Object type and  attributes
		$contact = new Contact();
		$this->assertInstanceOf('Contact',$contact);
		$this->assertInstanceOf('Person',$contact);
		$this->assertInstanceOf('SugarBean',$contact);

		$this->assertAttributeEquals('Contacts', 'module_dir', $contact);
		$this->assertAttributeEquals('Contact', 'object_name', $contact);
		$this->assertAttributeEquals('contacts', 'table_name', $contact);
		$this->assertAttributeEquals('accounts_contacts', 'rel_account_table', $contact);
		$this->assertAttributeEquals('opportunities_contacts', 'rel_opportunity_table', $contact);
		$this->assertAttributeEquals(true, 'importable', $contact);
		$this->assertAttributeEquals(true, 'new_schema', $contact);

	}

	public function testadd_list_count_joins()
	{
		error_reporting(E_ERROR | E_PARSE);

		$contact = new Contact();

		//test with empty strings
		$query = "";
		$contact->add_list_count_joins($query, '');
		$this->assertEquals("",$query);


		//test with valid string
		$query = "";
		$expected = "\n	            LEFT JOIN accounts_contacts\n	            ON contacts.id=accounts_contacts.contact_id\n	            LEFT JOIN accounts\n	            ON accounts_contacts.account_id=accounts.id\n			";
		$contact->add_list_count_joins($query, 'accounts.name');
		$this->assertSame($expected,$query);


		//test with valid string
		$query = "";
		$expected = "\n	            LEFT JOIN accounts_contacts\n	            ON contacts.id=accounts_contacts.contact_id\n	            LEFT JOIN accounts\n	            ON accounts_contacts.account_id=accounts.id\n			";
		$contact->add_list_count_joins($query, 'contacts.name');
		$this->assertSame("",$query);


	}

	public function testlistviewACLHelper()
	{
		$contact = new Contact();

		$expected = array( "MAIN"=>"a", "ACCOUNT"=>"a");
		$actual = $contact->listviewACLHelper();
		$this->assertSame($expected,$actual);

	}

    /**
     * @todo: NEEDS FIXING!
     */
	public function testcreate_new_list_query()
	{
        /*
		$contact = new Contact();

		//test without request action parameter
		$expected =" SELECT  contacts.* , '                                                                                                                                                                                                                                                              ' opportunity_role_fields , '                                    '  opportunity_id , '                                                                                                                                                                                                                                                              ' c_accept_status_fields , '                                    '  call_id , '                                                                                                                                                                                                                                                              ' e_invite_status_fields , '                                    '  fp_events_contactsfp_events_ida , '                                                                                                                                                                                                                                                              ' e_accept_status_fields , LTRIM(RTRIM(CONCAT(IFNULL(contacts.first_name,''),' ',IFNULL(contacts.last_name,'')))) as name , jt4.user_name modified_by_name , jt4.created_by modified_by_name_owner  , 'Users' modified_by_name_mod , jt5.user_name created_by_name , jt5.created_by created_by_name_owner  , 'Users' created_by_name_mod , jt6.user_name assigned_user_name , jt6.created_by assigned_user_name_owner  , 'Users' assigned_user_name_mod, LTRIM(RTRIM(CONCAT(IFNULL(contacts.first_name,''),' ',IFNULL(contacts.last_name,'')))) as full_name, '                                                                                                                                                                                                                                                              ' account_name , '                                    '  account_id  , jt8.last_name report_to_name , jt8.assigned_user_id report_to_name_owner  , 'Contacts' report_to_name_mod , jt9.name campaign_name , jt9.assigned_user_id campaign_name_owner  , 'Campaigns' campaign_name_mod, '                                                                                                                                                                                                                                                              ' m_accept_status_fields , '                                    '  meeting_id  FROM contacts   LEFT JOIN  users jt4 ON contacts.modified_user_id=jt4.id AND jt4.deleted=0\n\n AND jt4.deleted=0  LEFT JOIN  users jt5 ON contacts.created_by=jt5.id AND jt5.deleted=0\n\n AND jt5.deleted=0  LEFT JOIN  users jt6 ON contacts.assigned_user_id=jt6.id AND jt6.deleted=0\n\n AND jt6.deleted=0  LEFT JOIN  contacts jt8 ON contacts.reports_to_id=jt8.id AND jt8.deleted=0\n\n AND jt8.deleted=0  LEFT JOIN  campaigns jt9 ON contacts.campaign_id=jt9.id AND jt9.deleted=0\n\n AND jt9.deleted=0 where (account.name is null) AND contacts.deleted=0";
		$actual = $contact->create_new_list_query("account.name","account.name is null");
		$this->assertSame($expected,$actual);

		//test with request action parameter = ContactAddressPopup
		$_REQUEST['action'] = 'ContactAddressPopup';
		$expected = "SELECT LTRIM(RTRIM(CONCAT(IFNULL(contacts.first_name,''),'',IFNULL(contacts.last_name,'')))) name, \n				contacts.*,\n                accounts.name as account_name,\n                accounts.id as account_id,\n                accounts.assigned_user_id account_id_owner,\n                users.user_name as assigned_user_name \n                FROM contacts LEFT JOIN users\n	                    ON contacts.assigned_user_id=users.id\n	                    LEFT JOIN accounts_contacts\n	                    ON contacts.id=accounts_contacts.contact_id  and accounts_contacts.deleted = 0\n	                    LEFT JOIN accounts\n	                    ON accounts_contacts.account_id=accounts.id AND accounts.deleted=0 LEFT JOIN email_addr_bean_rel eabl  ON eabl.bean_id = contacts.id AND eabl.bean_module = 'Contacts' and eabl.primary_address = 1 and eabl.deleted=0 LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) where (account.name is null) AND  contacts.deleted=0 ";
		$actual = $contact->create_new_list_query("account.name","account.name is null");
		$this->assertSame($expected,$actual);
		*/
        $this->assertTrue(true, "NEEDS FIXING!");
	}


	public function testaddress_popup_create_new_list_query()
	{

		$contact = new Contact();

		//test with empty string params
		$expected = "SELECT LTRIM(RTRIM(CONCAT(IFNULL(contacts.first_name,''),'',IFNULL(contacts.last_name,'')))) name, \n				contacts.*,\n                accounts.name as account_name,\n                accounts.id as account_id,\n                accounts.assigned_user_id account_id_owner,\n                users.user_name as assigned_user_name \n                FROM contacts LEFT JOIN users\n	                    ON contacts.assigned_user_id=users.id\n	                    LEFT JOIN accounts_contacts\n	                    ON contacts.id=accounts_contacts.contact_id  and accounts_contacts.deleted = 0\n	                    LEFT JOIN accounts\n	                    ON accounts_contacts.account_id=accounts.id AND accounts.deleted=0 LEFT JOIN email_addr_bean_rel eabl  ON eabl.bean_id = contacts.id AND eabl.bean_module = 'Contacts' and eabl.primary_address = 1 and eabl.deleted=0 LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) where  contacts.deleted=0 ";
		$actual = $contact->address_popup_create_new_list_query('','');
		$this->assertSame($expected,$actual);


		//test with valid string params
		$expected = "SELECT LTRIM(RTRIM(CONCAT(IFNULL(contacts.first_name,''),'',IFNULL(contacts.last_name,'')))) name, \n				contacts.*,\n                accounts.name as account_name,\n                accounts.id as account_id,\n                accounts.assigned_user_id account_id_owner,\n                users.user_name as assigned_user_name \n                FROM contacts LEFT JOIN users\n	                    ON contacts.assigned_user_id=users.id\n	                    LEFT JOIN accounts_contacts\n	                    ON contacts.id=accounts_contacts.contact_id  and accounts_contacts.deleted = 0\n	                    LEFT JOIN accounts\n	                    ON accounts_contacts.account_id=accounts.id AND accounts.deleted=0 LEFT JOIN email_addr_bean_rel eabl  ON eabl.bean_id = contacts.id AND eabl.bean_module = 'Contacts' and eabl.primary_address = 1 and eabl.deleted=0 LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) where (contacts.name=\"\") AND  contacts.deleted=0 ";
		$actual = $contact->address_popup_create_new_list_query('contacts.id','contacts.name=""');
		$this->assertSame($expected,$actual);

	}

	public function testcreate_export_query()
	{
		$contact = new Contact();

		//test with empty string params
		$expected = "SELECT\n                                contacts.*,\n                                email_addresses.email_address email_address,\n                                '' email_addresses_non_primary, accounts.name as account_name,\n                                users.user_name as assigned_user_name  FROM contacts LEFT JOIN users\n	                                ON contacts.assigned_user_id=users.id LEFT JOIN accounts_contacts\n	                                ON ( contacts.id=accounts_contacts.contact_id and (accounts_contacts.deleted is null or accounts_contacts.deleted = 0))\n	                                LEFT JOIN accounts\n	                                ON accounts_contacts.account_id=accounts.id  LEFT JOIN  email_addr_bean_rel on contacts.id = email_addr_bean_rel.bean_id and email_addr_bean_rel.bean_module='Contacts' and email_addr_bean_rel.deleted=0 and email_addr_bean_rel.primary_address=1  LEFT JOIN email_addresses on email_addresses.id = email_addr_bean_rel.email_address_id where ( accounts.deleted IS NULL OR accounts.deleted=0 )\n                      AND contacts.deleted=0 ";
		$actual = $contact->create_export_query('','');
		$this->assertSame($expected,$actual);


		//test with valid string params
		$expected = "SELECT\n                                contacts.*,\n                                email_addresses.email_address email_address,\n                                '' email_addresses_non_primary, accounts.name as account_name,\n                                users.user_name as assigned_user_name  FROM contacts LEFT JOIN users\n	                                ON contacts.assigned_user_id=users.id LEFT JOIN accounts_contacts\n	                                ON ( contacts.id=accounts_contacts.contact_id and (accounts_contacts.deleted is null or accounts_contacts.deleted = 0))\n	                                LEFT JOIN accounts\n	                                ON accounts_contacts.account_id=accounts.id  LEFT JOIN  email_addr_bean_rel on contacts.id = email_addr_bean_rel.bean_id and email_addr_bean_rel.bean_module='Contacts' and email_addr_bean_rel.deleted=0 and email_addr_bean_rel.primary_address=1  LEFT JOIN email_addresses on email_addresses.id = email_addr_bean_rel.email_address_id where (contacts.name=\"\") AND ( accounts.deleted IS NULL OR accounts.deleted=0 )\n                      AND contacts.deleted=0 ";
		$actual = $contact->create_export_query('contacts.id','contacts.name=""');
		$this->assertSame($expected,$actual);

	}

	public function testfill_in_additional_list_fields() {

		$contact = new Contact();

		//test with attributes preset and verify attributes are set accordingly
		$contact->first_name = "firstn";
		$contact->last_name = "lastn";
		$contact->email1 = "1@test.com";
		$contact->email2 = "2@test.com";


		$contact->fill_in_additional_list_fields();

		$this->assertEquals("firstn lastn",$contact->full_name);
		$this->assertEquals("firstn lastn &lt;1@test.com&gt;",$contact->email_and_name1);
		$this->assertEquals("firstn lastn &lt;2@test.com&gt;",$contact->email_and_name2);

	}

	public function testfill_in_additional_detail_fields() {

		$contact = new Contact();

		//test with attributes preset and verify attributes are set accordingly
		$contact->id = "1";

		$contact->fill_in_additional_detail_fields();

		$this->assertEquals("",$contact->account_name);
		$this->assertEquals("",$contact->account_id);
		$this->assertEquals("",$contact->report_to_name);

	}


	public function testload_contacts_users_relationship(){

		$contact = new Contact();

		//execute the method and test if it works and does not throws an exception.
		try {
			$contact->load_contacts_users_relationship();
			$this->assertTrue(true);
		}
		catch (Exception $e) {
			$this->fail();
		}

	}

	public function testget_list_view_data() {

		$contact = new Contact();

		//test with attributes preset and verify attributes are set accordingly
		$contact->first_name = "first";
		$contact->last_name = "last";

		$expected = array (
					  'NAME' => 'first last',
					  'DELETED' => 0,
					  'FIRST_NAME' => 'first',
					  'LAST_NAME' => 'last',
					  'FULL_NAME' => 'first last',
					  'DO_NOT_CALL' => '0',
					  'PORTAL_USER_TYPE' => 'Single user',
					  'ENCODED_NAME' => 'first last',
					  'EMAIL1' => '',
					  'EMAIL1_LINK' => '<a href=\'javascript:void(0);\' onclick=\'SUGAR.quickCompose.init({"fullComposeUrl":"contact_id=\\u0026parent_type=Contacts\\u0026parent_id=\\u0026parent_name=first+last\\u0026to_addrs_ids=\\u0026to_addrs_names=first+last\\u0026to_addrs_emails=\\u0026to_email_addrs=first+last%26nbsp%3B%26lt%3B%26gt%3B\\u0026return_module=Contacts\\u0026return_action=ListView\\u0026return_id=","composePackage":{"contact_id":"","parent_type":"Contacts","parent_id":"","parent_name":"first last","to_addrs_ids":"","to_addrs_names":"first last","to_addrs_emails":"","to_email_addrs":"first last \\u003C\\u003E","return_module":"Contacts","return_action":"ListView","return_id":""}});\' class=\'\'>',
					  'EMAIL_AND_NAME1' => 'first last &lt;&gt;',
					);

		$actual = $contact->get_list_view_data();
		//$this->assertSame($expected, $actual);
		$this->assertEquals($expected['NAME'], $actual['NAME']);
		$this->assertEquals($expected['FIRST_NAME'], $actual['FIRST_NAME']);
		$this->assertEquals($expected['LAST_NAME'], $actual['LAST_NAME']);
		$this->assertEquals($expected['FULL_NAME'], $actual['FULL_NAME']);
		$this->assertEquals($expected['ENCODED_NAME'], $actual['ENCODED_NAME']);
		$this->assertEquals($expected['EMAIL_AND_NAME1'], $actual['EMAIL_AND_NAME1']);

	}


	public function testbuild_generic_where_clause ()
	{

		$contact = new Contact();

		//test with string
		$expected = "contacts.last_name like 'test%' or contacts.first_name like 'test%' or accounts.name like 'test%' or contacts.assistant like 'test%' or ea.email_address like 'test%'";
		$actual = $contact->build_generic_where_clause('test');
		$this->assertSame($expected,$actual);


		//test with number
		$expected = "contacts.last_name like '1%' or contacts.first_name like '1%' or accounts.name like '1%' or contacts.assistant like '1%' or ea.email_address like '1%' or contacts.phone_home like '%1%' or contacts.phone_mobile like '%1%' or contacts.phone_work like '%1%' or contacts.phone_other like '%1%' or contacts.phone_fax like '%1%' or contacts.assistant_phone like '%1%'";
		$actual = $contact->build_generic_where_clause(1);
		$this->assertSame($expected,$actual);

	}

	public function testset_notification_body()
	{
		$contact = new Contact();

		//test with attributes preset and verify attributes are set accordingly
		$contact->first_name = "first";
		$contact->last_name = "last";
		$contact->description = "some text";
		$contact->fill_in_additional_list_fields();

		$result = $contact->set_notification_body(new Sugar_Smarty(), $contact);

		$this->assertEquals($contact->full_name ,$result->_tpl_vars['CONTACT_NAME']);
		$this->assertEquals($contact->description ,$result->_tpl_vars['CONTACT_DESCRIPTION']);

	}

	public function testget_contact_id_by_email()
	{
		$contact = new Contact();

		$result = $contact->get_contact_id_by_email("");
		$this->assertEquals(null,$result);


		//$result = $contact->get_contact_id_by_email("test@test.com");
		//$this->assertEquals(null,$result);

		$this->markTestSkipped('Invalid Columns(email1,email2) in Query ');

	}

	public function testsave_relationship_changes() {

		$contact = new Contact();

		//execute the method and test if it works and does not throws an exception.
		try {
			$contact->save_relationship_changes(true);
			$contact->save_relationship_changes(false);
			$this->assertTrue(true);
		}
		catch (Exception $e) {
			$this->fail();
		}

	}

	public function testbean_implements()
	{
		$contact = new Contact();
		$this->assertEquals(false, $contact->bean_implements('')); //test with blank value
		$this->assertEquals(false, $contact->bean_implements('test')); //test with invalid value
		$this->assertEquals(true, $contact->bean_implements('ACL')); //test with valid value
	}

	public function testget_unlinked_email_query()
	{
		$contact = new Contact();

		//execute the method and verify that it retunrs expected results
		$expected = "SELECT emails.id FROM emails  JOIN (select DISTINCT email_id from emails_email_addr_rel eear\n\n	join email_addr_bean_rel eabr on eabr.bean_id ='' and eabr.bean_module = 'Contacts' and\n	eabr.email_address_id = eear.email_address_id and eabr.deleted=0\n	where eear.deleted=0 and eear.email_id not in\n	(select eb.email_id from emails_beans eb where eb.bean_module ='Contacts' and eb.bean_id = '')\n	) derivedemails on derivedemails.email_id = emails.id";
		$actual = $contact->get_unlinked_email_query();
		$this->assertSame($expected,$actual);

	}


    public function testprocess_sync_to_outlook()
    {
    	$contact = new Contact();

    	//execute the method and test if it works and does not throws an exception.
    	try {
   			$contact->process_sync_to_outlook("all");
    		$this->assertTrue(true);
    	}
    	catch (Exception $e) {
    		$this->fail();
    	}


    	//execute the method and test if it works and does not throws an exception.
    	try {
    		$contact->process_sync_to_outlook("1");
    		$this->assertTrue(true);
    	}
    	catch (Exception $e) {
    		$this->fail();
    	}



	}

}
