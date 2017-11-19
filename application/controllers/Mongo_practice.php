<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Mongo_practice extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	function view(){
		$result = $this->mongo_db->get('test_collection');
		var_dump($result);
	}
	
	function add(){
		$insert_data= array(
			"fname"=>"Hemant",
			"lname"=>"Hingave",
			"mark"=> array("phy"=>67,"chem"=>89,"math"=>90),
			"sub"=> (object) array("phy","chem","math"),
			"obj"=> (object) array( 
				"obj_member1"=> (object) array(
					"nested_obj1"=> (object) array(
						"nested_obj1_member1" => array(),
						"nested_obj1_member2" => array(),
					),
					"nested_obj2"=> (object) array(
						"nested_obj2_member1" => array(),
						"nested_obj2_member2" => array(),
					)
				),
				"obj_member2"=>(object) array("arr1"=>array(),"arr2"=>array()),
				"obj_member3"=>(object) array("t1"=>array(),"t2"=>array(),"t2"=>array()),
			),
			"paper"=> (object) array(
							"term1"=>array( 
								(object) array(
									'phy'=> array(78,87,98),
									'che'=> array(78,87,98),
									'math'=> array(78,87,98),
								)
							),
							"term2"=>array( 
								(object) array(
									'phy'=> array(78,87,98),
									'che'=> array(78,87,98),
									'math'=> array(78,87,98),
								)
							),
							"term3"=>array( 
								(object) array(
									'phy'=> array(78,87,98),
								)
							),
							"term4"=>array( 
								(object) array(
									'phy'=> array(78,87,98),
									'che'=> array(78,87,98),
									'math'=> array(78,87,98),
								)
							),
						),
			"created_on"=>$this->mongo_db->date()
		);
		$result = $this->mongo_db->insert('test_collection',$insert_data);
		var_dump($result);
		/*
		object(MongoId)[25]
			public '$id' => string '5a1082684280ec0807000029' (length=24)
		*/
	}
	
	//insert into nested object i.e nested_obj1_member1
	function insert_nested(){
		$id = "5a1119c74280ec540e00002c";
		$this->mongo_db->where('_id',$this->mongo_db->id($id));
		$updated_arr= array(12,34,56,78,879);
		$this->mongo_db->push('obj.obj_member1.nested_obj1.nested_obj1_member1',$updated_arr);
		$result = $this->mongo_db->update('test_collection');
		var_dump($result);
	}
	
	
	
}
