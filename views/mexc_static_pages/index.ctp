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

echo $this->Bl->sbox(array(), array('size' => array('M' => 6, 'g' => -1), 'type' => ''));
	
	echo $this->Cork->tile(array(), array(
		'key' => $section['FactSection']['metadata']['corktile_key'],
		'type' => 'cs_cork',
		'replaceOptions' => false
	));
	
	echo $this->Bl->br();
	echo $this->Bl->hr(array('class' => 'double'));
	
	// @todo Thread of comments
	
echo $this->Bl->ebox();
