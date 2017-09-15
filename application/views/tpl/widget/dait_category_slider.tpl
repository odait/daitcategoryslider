[{block name="dait_widget_categoryslider"}]
    [{assign var="oSlides" value=$oViewConf->getSlidesOfCategory($sCategoryId)}]
    [{assign var="currency" value=$oView->getActCurrency()}]

    [{if $oSlides|@count}]
        [{oxscript include="js/libs/jquery.flexslider.min.js" priority=2}]
        [{oxstyle include="css/libs/jquery.flexslider.min.css"}]
        [{oxscript include=$oViewConf->getModuleUrl('daitcategoryslider','out/src/js/daitcategoryslider.js') priority=10}]
        [{oxstyle include=$oViewConf->getModuleUrl('daitcategoryslider','out/src/css/daitcategoryslider.css')}]

        <div id="dait-category-slider" class="flexslider">
            <ul class="slides">
                [{block name="dait_widget_categoryslider_list"}]
                    [{foreach from=$oSlides key="iPicNr" item="oBanner" name="categoryslider"}]
                        [{assign var="oArticle" value=$oBanner->getBannerArticle()}]
                        [{assign var="sBannerPictureUrl" value=$oBanner->getBannerPictureUrl()}]
                        [{if $sBannerPictureUrl}]
                            <li class="item">
                                [{assign var="sBannerLink" value=$oBanner->getBannerLink()}]
                                [{if $sBannerLink}]
                                    <a href="[{$sBannerLink}]" title="[{$oBanner->oxactions__oxtitle->value}]">
                                [{/if}]

                                <img src="[{$sBannerPictureUrl}]" alt="[{$oBanner->oxactions__oxtitle->value}]" title="[{$oBanner->oxactions__oxtitle->value}]">

                                [{if $sBannerLink}]
                                    </a>
                                [{/if}]
                                
                                [{if $oViewConf->getViewThemeParam('blSliderShowImageCaption') && $oArticle}]
                                    <p class="flex-caption">
                                        [{if $sBannerLink}]
                                            <a href="[{$sBannerLink}]" title="[{$oBanner->oxactions__oxtitle->value}]">
                                        [{/if}]
                                        <span class="title">[{$oArticle->oxarticles__oxtitle->value}]</span>[{if $oArticle->oxarticles__oxshortdesc->value|trim}]<br/><span class="shortdesc">[{$oArticle->oxarticles__oxshortdesc->value|trim}]</span>[{/if}]
                                        [{if $sBannerLink}]
                                            </a>
                                        [{/if}]
                                    </p>
                                [{/if}]
                            </li>
                        [{/if}]
                    [{/foreach}]
                [{/block}]
            </ul>
        </div>
    [{/if}]
[{/block}]
