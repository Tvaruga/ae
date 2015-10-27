<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult['ELEMENTS']) && $arParams['AJAX_MODE']=='Y' && $_REQUEST['AJAX_CALL']=='Y'):
    ?><script>
    $(function(){
        if(jQuery().select2)
            $(".js-select").each(function () {
                $(this).select2({
                    minimumResultsForSearch: -1,
                    width: "style",
                    containerCssClass: this.getAttribute("data-cont-class"),
                    dropdownCssClass: this.getAttribute("data-drop-class")
                })
            });

        if(jQuery().gearslider)
            $(".js-gearslider").each(function () {
                $(this).gearslider({
                    holder: this.getAttribute("data-holder"),
                    list: this.getAttribute("data-list"),
                    append: this.getAttribute("data-append"),
                    listItemClass: this.getAttribute("data-list-item-class"),
                    sliceEl: this.getAttribute("data-slice-el"),
                    autoplay: !1,
                    slice: 48
                })
            });

        if(jQuery().mCustomScrollbar)
            $(".js-scroll").each(function () {
                $(this).mCustomScrollbar();
            });
    });
</script><?
endif;