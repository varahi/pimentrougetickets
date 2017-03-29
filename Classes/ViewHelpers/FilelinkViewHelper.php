<?php 
namespace PimentRouge\Pimentrougetickets\ViewHelpers;

/**
 * A view helper for creating links to files using filelink function.
 *
 * = Examples =
 *
 * <code>
 * {namespace pd=Tx_ProductDownloads_ViewHelpers}
 * <pd:filelink uri="fileadmin/secure/datasheet.pdf" label="Datasheet XY" />
 * </code>
 * <output>
 * <a href="index.php?jumpurl=fileadmin/secure/datasheet.pdf&locationData=1&juSecure=1&juHash=1234567890">Datasheet XY</a>
 * </output>
 *
 * @package product_downloads
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */

class FilelinkViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @param string $uri the URI that will be put in the href attribute of the rendered link tag
	 * @param string $label
	 * @return string Rendered link
	 */
	public function render($uri, $label) {

		//get filelinkconf from typoscript setup plugin.tx_productdownloads.settings.filelink
		$filelinkconf = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_pimentrougetickets.']['settings.']['filelink.'];
		
		if (!is_array($filelinkconf)){
			$filelinkconf = array();
			$filelinkconf['jumpurl'] = 1;
			$filelinkconf['jumpurl.']['secure'] = 1;
			$filelinkconf['icon'] = 1;
			$filelinkconf['icon_link'] = 0;
			$filelinkconf['icon.']['wrap'] = '<span class="icon">|</span>';
			$filelinkconf['file.']['wrap'] = '<span class="file">|</span>';
			$filelinkconf['icon.']['widthAttribute'] = '24';
			$filelinkconf['icon.']['heightAttribute'] = '30';
			//$filelinkconf['icon.']['path'] = 'fileadmin/templates/res/fileicons/';
			$filelinkconf['icon.']['ext'] = 'gif';
			$filelinkconf['size'] = 1;
			$filelinkconf['size.']['wrap'] = '<span class="filesize">(|)</span>';
			$filelinkconf['size.']['bytes'] = 1;
			$filelinkconf['size.']['bytes.']['labels'] = 'B| KB| MB| GB';
		}
		//replace the link label with the param $label
		$filelinkconf['labelStdWrap.']['cObject'] = 'TEXT';
		$filelinkconf['labelStdWrap.']['cObject.']['value'] = $label;

		$output = $GLOBALS['TSFE']->cObj->filelink($uri,$filelinkconf);

		return $output;
	}
}
