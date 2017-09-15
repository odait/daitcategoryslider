<?php

/**
 *    This file is part of the module daitcategoryslider for OXID.
 *
 *    The module daitcategoryslider is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The module daitcategoryslider is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 * 
 *    @link        https://www.dalley-it.com
 *    @author      Oliver Dalley - Dalley IT, September 2017
 *    @version     V 1.0
 *
 *    @license     http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *    @copyright   (C) Oliver Dalley - Dalley IT 2017
 *
 */

/**
 * Purpose:     Extension of actions_main.php.
 *              Overwrites the render method
 *              of the parent class to use own template.
 *              Admin Menu: Manage Products -> actions -> Main.
 * 
 */
class dait_actions_main extends dait_actions_main_parent
{
    public function render()
    {
        $return = parent::render();

        // product assignment with ajax popup
        if (($oPromotion = $this->getViewDataElement("edit"))) {
            if (($oPromotion->oxactions__oxtype->value == 9)) {
                if ($iAoc = oxRegistry::getConfig()->getRequestParameter("oxpromotionaoc")) {
                    $sPopup = false;
                    switch ($iAoc) {
                        case 'article':
                            // generating category tree for select list
                            $this->_createCategoryTree("artcattree", $soxId);

                            if ($oArticle = $oPromotion->getBannerArticle()) {
                                $this->_aViewData['actionarticle_artnum'] = $oArticle->oxarticles__oxartnum->value;
                                $this->_aViewData['actionarticle_title'] = $oArticle->oxarticles__oxtitle->value;
                            }

                            $sPopup = 'actions_article';
                            $sTemplate = "popups/{$sPopup}.tpl";
                            break;
                        case 'groups':
                            $sPopup = 'actions_groups';
                            $sTemplate = "popups/{$sPopup}.tpl";
                            break;
                        case 'category':
                            $sPopup = 'dait_action_category';
                            $sTemplate = "{$sPopup}.tpl";
                            break;
                    }

                    if ($sPopup) {
                        $aColumns = array();
                        $oActionsArticleAjax = oxNew($sPopup . '_ajax');
                        $this->_aViewData['oxajax'] = $oActionsArticleAjax->getColumns();
                        
                        $sAssignedCatId = $this->_getAssignedCatId($oPromotion->oxactions__oxid->value);
                        if ($sAssignedCatId) {
                            $oCat = oxNew("oxCategory");
                            if ($oCat->load($sAssignedCatId)) {
                                $this->_aViewData["defcat"] = $oCat;
                            }
                        }

                        return $sTemplate;
                    }
                }
            }
        }
        
        if($return == 'actions_main.tpl') {
            return 'dait_actions_main.tpl';
        } else {
            return $return;
        }
    }
    
    protected function _getAssignedCatId($sActionId){
        $sCatId = false;
        if ($sActionId && $sActionId != "-1") {
            $oDb = oxDb::getDb();
            $sActionId = $oDb->quote($sActionId);

            $sSelect = "select oxcatid from daitaction2category where oxactionid=$sActionId";
            $sCatId = $oDb->getOne($sSelect);
        }
        return $sCatId;
    }

}