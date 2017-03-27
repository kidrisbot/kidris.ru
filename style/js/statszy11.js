function stats_get(offset, id_table, id_group) {
	$.post("/stats/"+ id_group,
        {
            ajax: 1,
			offset: offset,
			id: id_group
        }).done(function(data) {
			var result = jQuery.parseJSON(data);
            if(result.error === 0) {
				if(result.answer != "") {
					var offset_new_next = offset + 20;
					var offset_new_back = offset - 20;
					if(offset_new_back < 0) {
						var offset_new_back = 0;
					}
					$("#table_" + id_table).empty();
					$("#table_" + id_table).html(result.answer);
					$("#but_next_" + id_table).attr("onclick", "stats_get(" + offset_new_next + ", '" + id_table + "', " + id_group + ")")
					$("#but_back_" + id_table).attr("onclick", "stats_get(" + offset_new_back + ", '" + id_table + "', " + id_group + ")")
					//$("#tbody_" + id_table).val(result.answer);
					//alert(id_table);
				}
			}
        });
}