function set_module_status(key, input_value, a_obj) {
	var td_id = "module-status-"+key;
	var input_id = "su-"+key+"-module-status";
	
	jQuery("td#"+td_id+" a").removeClass("current");
	document.getElementById(input_id).value = input_value;
	a_obj.className += " current";
}