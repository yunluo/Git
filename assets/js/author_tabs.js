jQuery(document).ready(function() {
    jQuery(".tab_content_author").hide();
    jQuery("ul.tabs_author li:first").addClass("active_author").show();
    jQuery(".tab_content_author:first").show();
    jQuery("ul.tabs_author li").click(function() {
        jQuery("ul.tabs_author li").removeClass("active_author");
        jQuery(this).addClass("active_author");
        jQuery(".tab_content_author").hide();
        var activeTab = jQuery(this).find("a").attr("href");
        if (jQuery.browser.msie) {
            jQuery(activeTab).show();
        }
        else {
            jQuery(activeTab).show();
        }
        return false;
    });
});