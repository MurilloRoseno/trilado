<?php
/*
 * Copyright (c) 2011, Valdirene da Cruz Neves J�nior <linkinsystem666@gmail.com>
 * All rights reserved.
 */


/**
 * Classe Model representa uma entidade do banco de dados, deve ser herdada, nela deve ficar a l�gica de neg�cio da aplica��o. J� vem com  m�todos para as opera��es CRUD prontas
 * 
 * @author	Valdirene da Cruz Neves J�nior <linkinsystem666@gmail.com>
 * @version	2
 *
 */
class Model
{
	/**
	 * Guarda true se a classe for uma nova inst�ncia de Model e false a inst�ncia vinher do banco
	 * @var boolean
	 */
	private $_isNew = true;
	
	/**
	 * Verifica se a classe � uma nova inst�ncia de Model ou se os valores vem do banco
	 * @return boolean	retorna true se classe foi inst�nciada pelo usu�rio, ou false se foi inst�nciada pela classe DatabaseQuery
	 */
	public function _isNew()
	{
		return $this->_isNew;
	}
	
	/**
	 * Define se a classe � ou n�o uma nova inst�ncia. Esse m�todo n�o deve ser chamado
	 * @return voi
	 */
	public function _setNew()
	{
		$this->_isNew = false;
	}
}
