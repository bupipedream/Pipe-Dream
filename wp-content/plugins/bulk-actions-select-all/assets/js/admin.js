jQuery( document ).ready( function( $ ) {
	var list = $( '#the-list' );
	var table = list.parents( 'table:first' );
	var colspan = list.find( 'tr:first > *' ).length;

	var notice_content = '';

	notice_content += '<div class="basa-selected">';
	notice_content += BASA_Admin.i18n.all_x_entries_on_page_selected.replace( '%d', BASA_Admin.items_per_page );
	notice_content += ' ' + '<a href="#">' + BASA_Admin.i18n.select_all_x_entries.replace( '%d', BASA_Admin.total_items ) + '</a>';
	notice_content += '</div>';

	notice_content += '<div class="basa-deselected">';
	notice_content += BASA_Admin.i18n.all_x_entries_selected.replace( '%d', BASA_Admin.total_items );
	notice_content += ' ' + '<a href="#">' + BASA_Admin.i18n.deselect_all + '</a>';
	notice_content += '</div>';
	
	notice_content += '<input type="hidden" name="basa-selectall" value="">';
	notice_content += '<input type="hidden" name="basa-num-items" value="' + BASA_Admin.total_items + '">';

	var el_notice = $( '<tr class="basa-selectall"><td colspan="' + colspan.toString() + '">' + notice_content + '</td></tr>' );

	list.prepend( el_notice );

	el_notice.find( 'a' ).click( function( e ) {
		e.preventDefault();

		var input = el_notice.find( '[name="basa-selectall"]' );

		if ( input.val() == '1' ) {
			table.find( 'thead .column-cb input:checkbox' ).trigger( 'click' );
		}
		else {
			el_notice.find( '.basa-selected' ).hide();
			el_notice.find( '.basa-deselected' ).show();
			input.val( '1' );
		}
	} );

	table.find( 'thead .column-cb input:checkbox, tfoot .column-cb input:checkbox' ).change( function() {
		if ( $( this ).is( ':checked' ) ) {
			el_notice.show();
			el_notice.find( '.basa-selected' ).show();
			el_notice.find( '.basa-deselected' ).hide();
		}
		else {
			el_notice.hide();
			el_notice.find( '[name="basa-selectall"]' ).val( '0' );
		}
	} );
} );