<?php
namespace PimentRouge\Pimentrougetickets\Service;

class AccessControlService implements \TYPO3\CMS\Core\SingletonInterface{
	
    /**
     * Do we have a logged in feuser
     * @return boolean
     */
    public function hasLoggedInFrontendUser() {
        return $GLOBALS['TSFE']->loginUser == 1 ? TRUE : FALSE;
    }
 
    /**
     * Get the uid of the current feuser
     * @return mixed
     */
    public function getFrontendUserUid() {
        if ($this->hasLoggedInFrontendUser() && !empty($GLOBALS['TSFE']->fe_user->user['uid'])) {
            return intval($GLOBALS['TSFE']->fe_user->user['uid']);
        }
        return NULL;       	
    }
     
    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user
     * @return boolean
     */
    public function isAccessAllowed(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user) {
      return $this->getFrontendUserUid() === $user->getUid() ? TRUE : FALSE;
    }
}

?>