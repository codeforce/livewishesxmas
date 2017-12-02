<?php 

class LiveWish{

	private $wish_id;
	private $wish_params=array();
	
	/* Constructor */
	public function __construct(){
		$this->wish_id=uniqid();
	}
	
	/* Set Live Wish Parameters */
	public function setParams($array){
		$this->wish_params=$array;
	}
	
	/* Write Animation XML */
	public function makeLiveWish($xml_path=""){
		$xml="<livewish>\r\n";
		$xml.="<params>";
		// add theme
		$xml.="\t<param name=\"theme\" value=\"".$this->wish_params["theme"]."\"></param>\r\n";
		// add sound
		$xml.="\t<param name=\"sound\" value=\"".$this->wish_params["sound"]."\"></param>\r\n";
		// add name
		$xml.="\t<param name=\"name\" value=\"".$this->wish_params["name"]."\"></param>\r\n";
		// add ip
		$xml.="\t<param name=\"ip\" value=\"".$_SERVER['REMOTE_ADDR']."\"></param>\r\n";
		// add date
		$xml.="\t<param name=\"date\" value=\"".date("Y m d")."\"></param>\r\n";
		
		$xml.="</params>";
		
		// add message/poem
		$xml.="\t<message>".$this->wish_params["message"]."</message>\r\n";
		
		$xml.="</livewish>";
		
		file_put_contents($xml_path.$this->wish_id.".xml",$xml);
		
		return $this->wish_id;
	}
	
}
?>