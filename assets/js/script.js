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

	var callback = function () {
		var dni = $("#dni").val();

		if (dni == "") {
			alert("ingresar dni");
			return false;
		} else {
			$.post(
				base_url + "admin/loans/ajax_searchCst/",
				{ dni: dni },
				function (data) {
					console.log("sin parse", data);

					if (data == "null") {
						$("#dni").val("");
						alert("No existe el cliente");
						$("#dni_cst").val("");
						$("#name_cst").val("");
						$("#client").val("");
					} else {
						$("#dni").val("");
						// debes validar/procesar esa cadena como JSON (con JSON.parse) y entonces podrás acceder a los datos de manera sencilla.
						data = JSON.parse(data);

						console.log("con parse", data);

						if (data.loan_status == "0") {
							$("#client").val(data.id);
							$("#dni_cst").val(data.dni);
							$("#name_cst").val(data.first_name + " " + data.last_name);
						} else {
							alert("persona con prestamo pendiente");
							$("#dni_cst").val("");
							$("#name_cst").val("");
							$("#client").val("");
						}
					}
				}
			);
		}
	};

	$("#dni").keypress(function (e) {
		if (e.which == 13) callback();
	});

	$("#btn_buscar").click(function () {
		callback();
	});

	$("#calcular").on("click", function () {
		// var define una variable global o local en una función sin importar el ámbito del bloque
		var contador = 0;

		if ($("#cr_amount").val() == "") {
			contador = 1;
			alert("Ingresar monto");
			$("#cr_amount").focus();
			return false;
		}
		if ($("#in_amount").val() == "") {
			contador = 1;
			alert("Ingresar interes");
			$("#in_amount").focus();
			return false;
		}
		if ($("#fee").val() == "") {
			contador = 1;
			alert("Ingresar cuotas");
			$("#fee").focus();
			return false;
		}
		if ($("#date").val() == "") {
			contador = 1;
			alert("Ingresar fecha emision");
			return false;
		}

		if (contador == 0) {
			$("#register_loan").attr("disabled", false);
		}
		// let permite almacenar los datos de una forma más eficiente
		let monto = parseFloat($("#cr_amount").val());
		let interes = $("#in_amount").val();
		let num_cuotas = $("#fee").val();
		let interes_final = monto * (interes / 100);
		let monto_total = interes_final + monto;
		let cuota = monto_total / num_cuotas;

		$("#valor_cuota").val(cuota.toFixed(2));
		$("#valor_interes").val(interes_final.toFixed(2));
		$("#monto_total").val(monto_total.toFixed(2));
	});

	$("#loan_form").submit(function () {
		if ($("#client").val() == "") {
			alert("Debe buscar un cliente");
			return false;
		}
		if ($("#valor_cuota").val() == "") {
			alert("Debe calcular el prestamo");
			return false;
		}
	});

	$(document).on("click", '[data-toggle="ajax-modal"]', function (t) {
		t.preventDefault();

		var url = $(this).attr("href");

		$.get(url).done(function (data) {
			$("#myModal").html(data).modal({ backdrop: "static" });
		});
	});
	// show alert and Check if there are clients with pending payments today when i click on the button  #alertsDropdown
	// $("#alertsDropdown").on("click", function () {
	// 	$.get(base_url + "models/Payments_m/get_payments", function (data) {
	// 		if (data != "") {
	// 			alert(data);
	// 		}
	// 	});
	// });

	var callback_cobranza = function () {
		var dni_c = $("#dni_c").val();

		if (dni_c == "") {
			alert("ingresar dni");
			return false;
		} else {
			$.post(
				base_url + "admin/payments/ajax_searchCst/",
				{ dni: dni_c },
				function (data) {
					console.log("sin parse", data);

					data = JSON.parse(data);

					console.log("con parse", data);

					if (data.cst == null) {
						$("#dni_c").val("");
						$("#dni_cst").val("");
						$("#name_cst").val("");
						$("#credit_amount").val("");
						$("#payment_m").val("");
						$("#coin").val("");

						alert("No existe el cliente o no tiene prestamo");
						// $("#quotas").html("<tr><td colspan='5'>No hay cuotas disponibles</td></tr>");
						//eliminar la tabla antes de crearla de nuevo
						$("#quotas").dataTable().fnClearTable();
						$("#quotas").dataTable().fnDraw();
						$("#quotas").dataTable().fnDestroy();
						

				
					// no mostrar los registros del prestamo pagado
					} else if (data.cst.loan_status == "0") {
						$("#dni_c").val("");
						alert("El cliente no tiene cuotas pendientes");
						$("#dni_cst").val("");
						$("#name_cst").val("");
						$("#credit_amount").val("");
						$("#payment_m").val("");
						$("#coin").val("");
						// $("#quotas").html("<tr><td colspan='5'>No hay cuotas disponibles</td></tr>");
						//eliminar la tabla antes de crearla de nuevo
						$("#quotas").dataTable().fnClearTable();
						$("#quotas").dataTable().fnDraw();
						$("#quotas").dataTable().fnDestroy();
					} else {
						console.log('existe el cliente', data.cst.dni)
						$("#dni_c").val("");
						$("#dni_cst").val(data.cst.dni);
						$("#name_cst").val(data.cst.cst_name);
						$("#client_id").val(data.cst.client_id);
						$("#loan_id").val(data.cst.loan_id);
						$("#credit_amount").val(data.cst.credit_amount);
						$("#payment_m").val(data.cst.payment_m);
						$("#coin").val(data.cst.coin_name);

						// clear the table before populating it with more data
						//$("#quotas").html("");
						$("#quotas").dataTable().fnClearTable();
						$("#quotas").dataTable().fnDraw();
						$("#quotas").dataTable().fnDestroy();
						// hacer un for
						$("#quotas").dataTable({
							bPaginate: false, //Ocultar paginación
							scrollY: "50vh",
							scrollCollapse: true,
							aaData: data[0],
						});

						$("input:checkbox").on("change", function () {
							// console.log('chand', $(this).val())
							var total = 0;
							$("input:checkbox:enabled:checked").each(function () {
								total += isNaN(parseFloat($(this).attr("data-fee")))
									? 0
									: parseFloat($(this).attr("data-fee"));
							});

							$("#total_amount").val(total);

							if (total != 0) {
								$("#register_loan").attr("disabled", false);
							} else {
								$("#register_loan").attr("disabled", true);
							}
						});
					}
				}
			);
		}
	};

	$("#dni_c").keypress(function (e) {
		if (e.which == 13) callback_cobranza();
	});

	$("#btn_buscar_c").click(callback_cobranza);

	$("#coin_type").change(function () {
		var coin_id = $("#coin_type").val();
		var symbol = $("#coin_type option:selected").data("symbol");

		$.get(
			base_url + "admin/reports/ajax_getCredits/" + coin_id,
			function (data) {
				data = JSON.parse(data);
				console.log("con parse", data);

				if (data.credits[0].sum_credit == null) {
					var sum_credit = "0 " + symbol.toUpperCase();
				} else {
					var sum_credit =
						data.credits[0].sum_credit +
						" " +
						data.credits[0].short_name.toUpperCase();
				}
				$("#cr").html(sum_credit);

				if (data.credits[1].cr_interest == null) {
					var cr_interest = "0 " + symbol.toUpperCase();
				} else {
					var cr_interest =
						data.credits[1].cr_interest +
						" " +
						data.credits[1].short_name.toUpperCase();
				}
				$("#cr_interest").html(cr_interest);

				if (data.credits[2].cr_interestPaid == null) {
					var cr_interestPaid = "0 " + symbol.toUpperCase();
				} else {
					var cr_interestPaid =
						data.credits[2].cr_interestPaid +
						" " +
						data.credits[2].short_name.toUpperCase();
				}
				$("#cr_interestPaid").html(cr_interestPaid);

				if (data.credits[3].cr_interestPay == null) {
					var cr_interestPay = "0 " + symbol.toUpperCase();
				} else {
					var cr_interestPay =
						data.credits[3].cr_interestPay +
						" " +
						data.credits[3].short_name.toUpperCase();
				}
				$("#cr_interestPay").html(cr_interestPay);
			}
		);
	});


	$(".dni").on("blur", function () {
		var dni = $(this).val();

		if (dni !== "") {
			$.post(
				base_url + "admin/clients/ajax_checkDni/",
				{ dni: dni },
				function (data) {
					if (data === "exists") {
						alert("El DNI ya existe");
						$("#dni").val("");
					}
				}
			);
		}
	});
});

