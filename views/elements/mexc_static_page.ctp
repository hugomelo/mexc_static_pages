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

switch ($type[0])
{
	case 'factory':
		switch ($type[1])
		{
			case 'subform':
				echo $this->Buro->input(array(), array(
					'fieldName' => 'metadata.address',
					'label' => __d('mexc_contacts', 'Endereço da página', true),
					'instructions' => __d('mexc_contacts', 'Será usada na parte em destaque: "/programas/nome_do programa/<span style="color:red; font-weight: bold">endereco_da_pagina</span>"<br>Não pode ter espaços, pontuações e acentuações.', true)
				));
				echo $this->Buro->input(array(), array(
					'type' => 'hidden',
					'fieldName' => 'metadata.corktile_key'
				));
			break;
			
			case 'subview':
				if (!empty($data['FactSection']['metadata']['corktile_key']))
				{
					echo $this->Bl->br();
					
					echo $this->Bl->anchor(array(),
						array(
							'url' => array(
								'plugin' => 'corktile', 'controller' => 'cork_corktiles', 'action' => 'edit',
								$data['FactSection']['metadata']['corktile_key']
							)
						),
						__d('mexc_contacts', 'Editar o conteúdo desta página.', true)
					);
				}
			break;
		}
	break;
}
