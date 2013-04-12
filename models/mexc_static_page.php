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

class MexcStaticPage extends MexcStaticPagesAppModel
{
	var $name = 'MexcStaticPage';
	var $useTable = false;
	
	public function factoryActions($action, $data)
	{
		switch ($action)
		{
			case 'create':
				// Get the current FactSite we are working on
				$FactSite = ClassRegistry::init('SiteFactory.FactSite');
				$FactSite->recursive = -1;
				$site = $FactSite->findById($data['FactSection']['fact_site_id']);
		
				// Get an available ID
				$CorkCorktile = ClassRegistry::init('Corktile.CorkCorktile');
				$data['FactSection']['metadata']['corktile_key'] = $CorkCorktile->getAvailableUuid();
		
				// Create the corktile
				$config = array(
					'key' => $data['FactSection']['metadata']['corktile_key'],
					'type' => 'cs_cork',
					'location' => array('public_page', 'fact_sites', $site['FactSite']['mexc_space_id'], $data['FactSection']['metadata']['address']),
					'title' => sprintf(__d('mexc_contacts', 'Texto da página \'%s\' do programa \'%s\'', true), $data['FactSection']['name'], $site['FactSite']['name']),
					'editorsRecommendations' => __d('fact_site', 'O conteúdo da página pode ser editado aqui.', true),
					'options' => array(
						'type' => 'fact_site_static',
						'cs_type' => 'fact_site_static'
					)
				);
				if ($CorkCorktile->getData($config) == false)
					return false;
				
				return $data;
			break;
			
			case 'save':
				if (empty($data['FactSection']['metadata']['address']))
					$data['FactSection']['metadata']['address'] = $data['FactSection']['name'];
				$data['FactSection']['metadata']['address'] = strtolower(Inflector::slug($data['FactSection']['metadata']['address']));
				
				return $data;
			break;
			
			case 'delete':
				if (!empty($data['FactSection']['metadata']['corktile_key']))
				{
					$CorkCorktile = ClassRegistry::init('Corktile.CorkCorktile');
					return $CorkCorktile->delete($data['FactSection']['metadata']['corktile_key']);
				}
			break;
		}
		
		return true;
	}
}
