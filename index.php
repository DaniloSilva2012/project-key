<?php 

class xmlParser {
        
    private $urlFirebase = 'https://burning-heat-5460.firebaseio.com/.json';    
    private $urlGit = 'https://github.com/Danty2012/project-key/key.json';

    public function curlKey($url=''){
	
	if(empty($url))
	{ 
		return false; 
	}
	
	try{
        	$ch = curl_init();

        	// informar URL e outras funções ao CURL
        	curl_setopt($ch, CURLOPT_URL, $url);
        	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	curl_setopt($ch, CURLOPT_FILETIME, true);
        	$result = curl_exec($ch);
        	curl_close($ch);
        	return $result;
	} 
	catch(Exception $e)
	{
		return $e->getMessage();
	}
    } 

    public function curlXml(){
	try{
    		$this->curlKey($this->urlFirebase);
	} 
	catch (Exception $e)
	{
		$this->jsonFallback();
	}
    }


    public function jsonFallback(){
    	$this->curlKey($this->urlGit);
    }
}

$test = new xmlParser();
$curlTest = json_decode($test->curlXml());

echo $curlTest->{'rogeriovario};
