<?php
// classe feedReader
//faz a leitura de um feed (rss ou xml)
//versão 2 para PHP 4
//autor: José Valente mailto:jcvalente@netvisao.pt
//2004 Portugal

class feedReader{

var $feedReader;   // parser
var $feedUrl;      // url do ficheiro xml/rss
var $node;         // número de nós dos items
var $channelFlag;  // flag
var $currentTag;   // actual tag
var $outputData;   // array dos dados (notícias formatadas)
var $itemFlag;     // flag
var $imageFlag;    // flag
var $feedVersion;  // versão do ficheiro rss

function feedReader(){ //constructor iniciação dos valores por defeitos dos elementos da classe
	$this->feedReader="";
	$this->feedUrl="";
	$this->node=0;
	$this->channelFlag=false;
	$this->currentTag="";
	$this->outputData=array();
	$this->itemFlag=false;
	$this->imageFlag=false;
	$this->feedVersion="";
}

function setFeedUrl($url){ //indicamos o endereço do ficheiro xml/rss
	$this->feedUrl=$url;
}

function getFeedOutputData(){ //retornamos o array com as notícias formatadas
	return $this->outputData;
}

function getFeedNumberOfNodes(){ //retornamos o número de notícias
	return $this->node;
}

function parseFeed(){ //função parse do xml
	$this->feedReader=xml_parser_create();
	xml_set_object($this->feedReader,$this);
	xml_parser_set_option($this->feedReader,XML_OPTION_CASE_FOLDING,true);
	xml_set_element_handler($this->feedReader,"openTag","closeTag");
	xml_set_character_data_handler($this->feedReader,"dataHandling");
	if(!($fp=@fopen($this->feedUrl,"r"))){
		$errorDefinition="Não foi possível encontrar o ficheiro pretendido.".$this->feedUrl;
		echo $errorDefinition;
	}
	while($data=@fread($fp,4096)){
		//$data=utf8_encode($data);//para eliminar um erro, em que eliminava toda a string antes do último "&"
		if(!@xml_parse($this->feedReader,$data,feof($fp))){
			$errorDefinition=xml_error_string(xml_get_error_code($this->feedReader));
			echo $errorDefinition;
		}
	}
	xml_parser_free($this->feedReader);
}

function openTag(&$parser,&$name,&$attribs){ //função startElement
		if($name){
			switch(strtolower($name)){
				case "channel":$this->channelFlag=true;break;
				case "image":$this->channelFlag=false;$this->imageFlag=true;break;
				case "item":$this->channelFlag=false;$this->imageFlag=false;$this->itemFlag=true;$this->node++;break;
				default:$this->currentTag=strtolower($name);break;
			}
		}
}

function closeTag(&$parser,&$name){ //função endElement
	$this->currentTag="";
}

function dataHandling(&$parser,&$data){ //função characterElement
	if($this->channelFlag){ //para a descrição do channel
		if(isset($this->outputData["channel"][$this->currentTag])){
			$this->outputData["channel"][$this->currentTag].=$data;
		}else{
			$this->outputData["channel"][$this->currentTag]=$data;
		}
		
	}
	if($this->itemFlag){ //para a descrição dos items
		if(isset($this->outputData["item"][$this->currentTag][$this->node-1])){
			$this->outputData["item"][$this->currentTag][$this->node-1].=$data;
		}else{
			$this->outputData["item"][$this->currentTag][$this->node-1]=$data;
		}
		//reconversão
	}
	if($this->imageFlag){ //para a descrição da imagem
		if(isset($this->outputData["image"][$this->currentTag])){
			$this->outputData["image"][$this->currentTag].=$data;
		}else{
			$this->outputData["image"][$this->currentTag]=$data;
		}
		
	}
}

}
?>