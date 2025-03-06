$(document).ready(function () {
	$("#provincia_id").change(function () {
		var prov_id = $(this).val();

		$.get(
			base_url + "admin/clients/ajax_getMunicipios/" + prov_id,
			function (data) {
				$("#municipio_id").html(data);
			}
		);
	});

	$("#municipio_id").change(function () {
		var mp_id = $(this).val();

		$.get(
			base_url + "admin/clients/ajax_getSectores/" + mp_id,
			function (data) {
				$("#sector_id").html(data);
			}
		);
	});

});
