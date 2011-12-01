<?php
/*
 * Copyright (c) 2011, Valdirene da Cruz Neves J�nior <linkinsystem666@gmail.com>
 * All rights reserved.
 */


/**
 * Classe de internacionaliza��o
 * @author	Valdirene da Cruz Neves J�nior <linkinsystem666@gmailc.om>
 * @version	1
 *
 */
class I18n 
{
	/**
	 * Nome do arquivo de tradu��o
	 * @var string
	 */
	private $file = 'message';
	
	/**
	 * Guarda as mensagens, sendo a chave um MD5 da mensagem original e o valor a mensagem traduzida
	 * @var array
	 */
	private $messages = array();
	
	/**
	 * Linguagem da tradu��o
	 * @var string
	 */
	private $lang;
	
	/**
	 * Linguagem original
	 * @var string
	 */
	private $default_lang;
	
	/**
	 * Construtor da classe
	 * @param string $default	linguagem original
	 * @param string $file		nome do arquivo de tradu��o
	 * @param string $ext		extens�o do arquivo de tradu��o
	 */
	public function __construct($default, $file, $ext = '.lang')
	{
		$this->default_lang = $default;
		$this->file = $file . $ext;
	}
	
	/**
	 * Define a linguagem da tradu��o
	 * @param string $lang		nome da linguagem de tradu��o
	 * @return void
	 */
	public function setLang($lang = null)
	{
		if(!$lang)
			$lang = $this->default_lang;
		$this->lang = $lang;
		$this->messages = $this->load('locale/'. $lang .'/'. $this->file);
	}
	
	/**
	 * Traduz uma mensagem e retorna
	 * @param string $string		mensagem a ser traduzida
	 * @param array $format			array com as vari�veis de formata��o da mensagem
	 * @throws TriladoException		disparada caso a mensagem esteja vazia
	 * @return string				retorna a mensagem traduzida
	 */
	public function get($string, $format = null)
	{
		if(count($string) == 0)
			throw new TriladoException('Params is empty!');

		$string = $this->messages[md5($string)];
		if(is_array($format))
		{
			foreach ($format as $k => $v)
				$string = str_replace('%'.$k, $v, $string);
		}
		return $string;
	}
	
	/**
	 * Carrega um arquivo de tradu��o pegando as mensagens e tradu��es e joga em array retornando-o
	 * @param string $file			nome do arquivo
	 * @throws TriladoException		disparada caso o arquivo n�o exista ou o conte�do esteja vazio
	 * @return array				retorna um array com as mensagens de tradu��o, sendo as chaves o MD5 da mensagem original
	 */
	private function load($file)
	{
		$file_path = APP . $file;

		if(!file_exists($file_path))
			throw new TriladoException('File "'. $file .'" not found!');
		$content = file_get_contents($file_path);
		if(!$content)
			throw new TriladoException('File "'. $file .'" is empty!');
		
		$lines = explode("\n", $content);
		$key = false;
		$array = array();
		foreach($lines as $line)
		{
			$line = trim($line);
			
			if($line != '' && $line[0] != '#')
			{
				if(preg_match('/^msgid "(.+)"/', $line, $match))
					$key = md5($match[1]);
				if(preg_match('/^msgstr "(.+)"/', $line, $match))
				{
					if(!$key)
						throw new TriladoException('Syntax error in "'. $file .'" in line "'. $match[1] .'"');
					$array[$key] = $match[1];
					$key = false;
				}
			}
		}
		return $array;
	}
}