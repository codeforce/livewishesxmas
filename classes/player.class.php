<?php 

class Player{

	private $wish_id;
	private $xml_path;
	private $wish_params=array();
	
	/* Constructor */
	public function __construct($wish_id,$xml_path=""){
		$this->wish_id=$wish_id;
		$this->xml_path=$xml_path;
	}
	
	/* Get Live Wish Parameters */
	public function getParams($key){
		$xml=simplexml_load_file($this->xml_path.$this->wish_id.".xml");
		switch($key){
			case "message":
				return (string)$xml->message;
				break;
			case "name":
				return (string)Player::findParam($xml->params,"name");
				break;
			case "sound":
				return (string)Player::findParam($xml->params,"sound");
				break;
			case "ip":
				return (string)Player::findParam($xml->params,"ip");
				break;
			case "date":
				return (string)Player::findParam($xml->params,"date");
				break;
			case "theme":
				return (string)Player::findParam($xml->params,"theme");
				break;
			default:
				return "N/A";
				break;
		}
	}
	
	private static function findParam($nodes,$param_name) {
		foreach($nodes->param as $param_line){
			if($param_line["name"]==$param_name) {
				return $param_line["value"];
				break;
			}
		}
	}

	
}

?>