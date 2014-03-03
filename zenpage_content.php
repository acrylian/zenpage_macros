<?php
/**
 * A Zenphoto plugin to provide a content macros to print the content/extra content of a Zenpage page or news article
 * 
 * Content macro:
 * [PAGECONTENT <titlelink> <publish true|false>]
 * [PAGEEXTRACONTENT <titlelink> <publish true|false>]
 * [NEWSCONTENT <titlelink> <publish true|false>]
 * [NEWSEXTRACONTENT <titlelink> <publish true|false>]
 *
 * @license GPL v3 
 * @author Malte Müller (acrylian)
 *
 * @package plugins
 * @subpackage misc
 */
 
$plugin_is_filter = 9|THEME_PLUGIN|ADMIN_PLUGIN;
$plugin_description = gettext('A Zenphoto plugin to provide a content macros to print the content/extra content of a Zenpage page or news article');
$plugin_author = 'Malte Müller (acrylian) with from inspiration by Vincent Bourganel (vincent3569)';
$plugin_version = '1.0';

zp_register_filter('content_macro','zenpageContent::zenpageContent_macro');


class zenpageContent {
	
	function __construct() {
	}
 
	static function getPageContent($titlelink = '', $published = true) {
		return self::getZenpageContent($titlelink, $published,'content', 'page');
	}
	
	static function getPageExtraContent($titlelink = '', $published = true) {
		return self::getZenpageContent($titlelink, $published,'extracontent', 'page');
	}
	static function getArticleContent($titlelink = '', $published = true) {
		return self::getZenpageContent($titlelink, $published,'content', 'news');
	}
	
	static function getArticleExtraContent($titlelink = '', $published = true) {
		return self::getZenpageContent($titlelink, $published,'extracontent', 'news');
	}
	
	static function getZenpageContent($titlelink = '', $published = true, $contenttype = 'content', $itemtype ='page') {
		if(!empty($titlelink)) {
			switch($itemtype) {
				case 'page':
					$obj = new ZenpagePage($titlelink);
					break;
				case 'news':
					$obj = new ZenpageNews($titlelink);
					break;
			}
			if (($obj->getShow()) || ((!$obj->getShow()) && (!$published))) {
				switch($contenttype) {
					case 'content':
						return html_encodeTagged($obj->getContent());
						break;
					case 'extracontent':
						return html_encodeTagged($obj->getExtraContent());
						break;
				}
			} 
	  }
	}
	
 /*
	* macro definition
	* @param array $macros
	* return array
	*/
	static function zenpageContent_macro($macros) {
		$macros['PAGECONTENT'] = array(
					'class'=>'function',
					'params'=> array('string*','bool*'), 
					'value'=>'zenpageContent::getPageContent',
					'owner'=>'zenpageContent',
					'desc'=>gettext('Prints the content of the page with titlelink (%1) being published true|false (%2).')
				);
		$macros['PAGEEXTRACONTENT'] = array(
					'class'=>'function',
					'params'=> array('string*','bool*'), 
					'value'=>'zenpageContent::getPageExtraContent',
					'owner'=>'zenpageContent',
					'desc'=>gettext('Prints the extra content of the page with titlelink (%1) being published true|false (%2).')
				);
		$macros['NEWSCONTENT'] = array(
					'class'=>'function',
					'params'=> array('string*','bool*'), 
					'value'=>'zenpageContent::getArticleContent',
					'owner'=>'zenpageContent',
					'desc'=>gettext('Prints the content of the ews article with titlelink (%1) being published true|false (%2).')
				);
		$macros['NEWSEXTRACONTENT'] = array(
					'class'=>'function',
					'params'=> array('string*','bool*'), 
					'value'=>'zenpageContent::getArticleExtraContent',
					'owner'=>'zenpageContent',
					'desc'=>gettext('Prints the extra content of the news article with titlelink (%1) being published true|false (%2).')
				);
		return $macros;
	}

} // class end

