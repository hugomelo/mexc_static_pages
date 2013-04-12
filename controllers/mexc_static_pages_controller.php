<?php

/**
 *
 * Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/museudecienciasunicamp/mexc_static_pages.git Mexc Static Pages public repository
 */

class MexcStaticPagesController extends MexcStaticPagesAppController
{
	var $name = 'MexcStaticPages';
	
	var $uses = array('SiteFactory.FactSection');
	
	function index($address = '')
	{
		$section = $this->FactSection->find('first', array(
			'contain' => array('FactSite'),
			'conditions' => array(
				'FactSite.mexc_space_id' => $this->currentSpace,
				'FactSection.metadata LIKE' => '%'.$address.'%'
			)
		));
		
		if (empty($section))
		{
			trigger_error('FactSitesController::page() - FactSite with address ' . $address . ' not found.');
			$this->cakeError('error404');
		}
		
		$this->set(compact('section'));
	}
}
