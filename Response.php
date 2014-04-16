<?php
/**
 * HTTP Response object
 * @category Chco
 * @package  Response
 * @author   CHCO
 * @version Release 1
 */
class Chco_Response
{
	/**
	 * @var array
	 */
	private $headers = array();
	/**
	 * @var array
	 */
	private $bodyParts = array();

	/**
	 * Injects html parts into HTTP body
	 * @param field_type $body
	 */
	public function appendBody($bodyPart) 
	{
		$this->bodyParts[] = $bodyPart;
		return $this;
	}
	/**
	 * Concatenates bodyParts into a single string
	 * @return string 
	 */
	public function getBody() 
	{
		return implode('', $this->bodyParts);
	}
	
	/**
	 * Adds a HTTP header
	 * @param string $name
	 * @param mixed $value
	 * @return Chco_Response
	 */
	public function addHeader($value)
	{
		$this->headers[] = array(
		    'value' => $value
		);
		return $this;
	}

	/**
	 * @return the $headers
	 */
	public function getHeaders()
	{
		return $this->headers;
	}
	
	/**
	 * Outputs HTTP body content
	 */
	public function send()
	{
		foreach ($this->getHeaders() as $header) {
			header($header['value']);
		}
		echo  $this->getBody();
	}

}