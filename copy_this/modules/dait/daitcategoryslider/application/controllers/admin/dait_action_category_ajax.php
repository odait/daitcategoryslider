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
 * Class controls action assignment to category
 */
class dait_action_category_ajax extends ajaxListComponent
{

    /**
     * Columns array
     *
     * @var array
     */
    protected $_aColumns = array('container1' => array( // field , table,         visible, multilanguage, ident
        array('oxtitle', 'oxcategories', 1, 1, 0),
        array('oxdesc', 'oxcategories', 1, 1, 0),
        array('oxid', 'oxcategories', 0, 0, 0),
        array('oxid', 'oxcategories', 0, 0, 1)
    )
    );

    /**
     * Returns SQL query for data to fetc
     *
     * @return string
     */
    protected function _getQuery()
    {
        $oCat = oxNew('oxcategory');
        $oCat->setLanguage(oxRegistry::getConfig()->getRequestParameter('editlanguage'));

        $sCategoriesTable = $oCat->getViewName();

        return " from $sCategoriesTable where " . $oCat->getSqlActiveSnippet();
    }

    /**
     * Unassign category
     */
    public function unassignCat()
    {
        $sActionId = oxRegistry::getConfig()->getRequestParameter('oxid');
        if ($sActionId && $sActionId != "-1") {
            $oDb = oxDb::getDb();
            $sQ = "delete from daitaction2category where oxactionid=" . $oDb->quote($sActionId);
            $oDb->Execute($sQ);
        }
    }




    /**
     * Assign category to action
     */
    public function assignCat()
    {
        // first delete eventually former assigned category
        $this->unassignCat();
        
        //new assignment
        $sChosenCat = oxRegistry::getConfig()->getRequestParameter('oxcatid');
        $sActionId = oxRegistry::getConfig()->getRequestParameter('oxid');
        if ($sActionId && $sActionId != "-1" && $sChosenCat && $sChosenCat != "-1") {
            $oNew = oxNew("oxbase");
            $oNew->init("daitaction2category");
            $oNew->daitaction2category__oxactionid = new oxField($sActionId);
            $oNew->daitaction2category__oxcatid = new oxField($sChosenCat);
            $oNew->save();
        }
    }

    
    
}