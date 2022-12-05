
function requireFields(form){
	tmp=-1;
	for (i=0; i<form.elements.length; i++){

		if (form.elements[i].type.toLowerCase()=='text' ||
			form.elements[i].type.toLowerCase()=='password' ||
			form.elements[i].type.toLowerCase()=='textarea'){
			if (jQuery(form.elements[i]).hasClass('require')){
				if (form.elements[i].value=='' ||
				(jQuery(form.elements[i]).hasClass('double_email') && form.elements[i].value.indexOf('@')==-1) ){
					jQuery(form.elements[i]).addClass('empty-error');
				}else{
					jQuery(form.elements[i]).removeClass('empty-error');
				}
			}
			if (jQuery(form.elements[i]).hasClass('double') || jQuery(form.elements[i]).hasClass('double_email')){
				if (tmp==-1)
					tmp=i;
				else{
					if (form.elements[i].value!=form.elements[tmp].value){
						jQuery(form.elements[i]).addClass('empty-error');
						jQuery(form.elements[tmp]).addClass('empty-error');
					}else{
						if (!jQuery(form.elements[i]).hasClass('require') && !jQuery(form.elements[tmp]).hasClass('require')){
							jQuery(form.elements[i]).removeClass('empty-error');
							jQuery(form.elements[tmp]).removeClass('empty-error');
						}
					}
					tmp=-1;
				}

			}
		}
		if (form.elements[i].nodeName.toLowerCase()=='select' && jQuery(form.elements[i]).hasClass('require')) {
			if (jQuery(form.elements[i]).val() == '')
				jQuery(form.elements[i]).parent().addClass('select-empty-error');
			else
				jQuery(form.elements[i]).parent().removeClass('select-empty-error');
		}
	}

}
