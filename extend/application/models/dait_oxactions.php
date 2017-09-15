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
 * Purpose:     Extension of oxactions.php.
 *              Extends the model to handle dait_category_slider
 * 
 */
class dait_oxactions extends dait_oxactions_parent
{
     /**
     * return assigned slide category
     *
     * @return oxArticle
     */
    public function getSlideCategory()
    {
        $oDb = oxDb::getDb();
        $sCatId = $oDb->getOne(
            'select oxcatid from daitaction2category '
            . 'where oxactionid=' . $oDb->quote($this->getId())
        );

        if ($sCatId) {
            $oCategory = oxNew('oxcategory');

            if ($this->isAdmin()) {
                $oCategory->setLanguage(oxRegistry::getLang()->getEditLanguage());
            }

            if ($oCategory->load($sCatId)) {
                return $oCategory;
            }
        }

        return null;
    }

}