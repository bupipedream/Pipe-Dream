jQuery(document).ready(function() {
	jQuery("." + jQuery("#cdn").val()).show();
	jQuery("#cdn").change(function() {
		if (this.value == "Origin") {
			jQuery(".cst-specific-options").hide();
		} else {
			jQuery(".cst-specific-options").show();
		}
		jQuery("." + this.value).show().siblings().hide();
	});
	jQuery("#cst-js-minify-yes").click(function() {
		jQuery(".js-opt-level").show();
	});
	jQuery("#cst-js-minify-no").click(function() {
		jQuery(".js-opt-level").hide();
	});
	if (jQuery('#cst-js-minify-yes').attr('checked') == 'checked') {
		jQuery(".js-opt-level").show();
	}
});