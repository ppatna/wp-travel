jQuery(document).ready(function($) {
	var formSeedConfirm = $("#seed-confirm-form");
	inputName = $("#seed-confirm-name");
	inputContact = $("#seed-confirm-contact");
	inputOrder = $("#seed-confirm-order");
	inputAmount = $("#seed-confirm-amount");
	inputAccountNumber = $("input[name=seed-confirm-account-number]");
	inputDate = $("#seed-confirm-date");
	inputSlip = $("#seed-confirm-slip");
	buttonSubmit = $("#seed-confirm-btn-submit");

	var optionOrderSelected = $("#seed-confirm-order option:selected");

	$orderAmountIndexStart = optionOrderSelected.text().lastIndexOf(":");
	$orderAmountIndexEnd = optionOrderSelected
		.text()
		.indexOf(" ", $orderAmountIndexStart + 2);

	newAmount = optionOrderSelected
		.text()
		.substring($orderAmountIndexStart + 2, $orderAmountIndexEnd);

	inputAmount.val(newAmount);

	inputOrder.on("change", function() {
		var optionOrderSelected = $("#seed-confirm-order option:selected");

		$orderAmountIndexStart = optionOrderSelected.text().lastIndexOf(":");
		$orderAmountIndexEnd = optionOrderSelected
			.text()
			.indexOf(" ", $orderAmountIndexStart + 2);

		newAmount = optionOrderSelected
			.text()
			.substring($orderAmountIndexStart + 2, $orderAmountIndexEnd);

		inputAmount.val(newAmount);
	});

	buttonSubmit.on("click", function(event) {
		var hasError = false;

		if (inputName.hasClass("required") && $.trim(inputName.val()) == "") {
			inputName.addClass("-invalid");
			hasError = true;
		} else {
			inputName.removeClass("-invalid");
		}

		if (
			inputContact.hasClass("required") &&
			$.trim(inputContact.val()) == ""
		) {
			inputContact.addClass("-invalid");
			hasError = true;
		} else {
			inputContact.removeClass("-invalid");
		}

		if (inputOrder.hasClass("required") && $.trim(inputOrder.val()) == "") {
			inputOrder.addClass("-invalid");
			hasError = true;
		} else {
			inputOrder.removeClass("-invalid");
		}

		if (inputAmount.hasClass("required") && $.trim(inputAmount.val()) == "") {
			inputAmount.addClass("-invalid");
			hasError = true;
		} else {
			inputAmount.removeClass("-invalid");
		}

		if (inputAccountNumber.hasClass("required")) {
			hasError = true;
			inputAccountNumber.addClass("-invalid");

			inputAccountNumber.each(function() {
				if ($(this).prop("checked") == true) {
					hasError = false;
					inputAccountNumber.removeClass("-invalid");
				}
			});
		}

		if (inputDate.hasClass("required") && $.trim(inputDate.val()) == "") {
			inputDate.addClass("-invalid");
			hasError = true;
		} else {
			inputDate.removeClass("-invalid");
		}

		if (inputSlip.hasClass("required") && $.trim(inputSlip.val()) == "") {
			inputSlip.addClass("-invalid");
			hasError = true;
		} else {
			inputSlip.removeClass("-invalid");
		}

		if (hasError) {
			$(window).scrollTop($("#seed-confirm-form").offset().top);
			return;
		} else {
			formSeedConfirm.submit();
		}
	});

	$.validate({
		borderColorOnError: "#c00",
		modules: "file"
	});

	if ($("html").attr("lang") == "th" && $("#seed-confirm-form").length != 0) {
		$.datepicker.regional["th"] = {
			closeText: "ปิด",
			prevText: "&#xAB;&#xA0;ย้อน",
			nextText: "ถัดไป&#xA0;&#xBB;",
			currentText: "วันนี้",
			monthNames: [
				"มกราคม",
				"กุมภาพันธ์",
				"มีนาคม",
				"เมษายน",
				"พฤษภาคม",
				"มิถุนายน",
				"กรกฎาคม",
				"สิงหาคม",
				"กันยายน",
				"ตุลาคม",
				"พฤศจิกายน",
				"ธันวาคม"
			],
			monthNamesShort: [
				"ม.ค.",
				"ก.พ.",
				"มี.ค.",
				"เม.ย.",
				"พ.ค.",
				"มิ.ย.",
				"ก.ค.",
				"ส.ค.",
				"ก.ย.",
				"ต.ค.",
				"พ.ย.",
				"ธ.ค."
			],
			dayNames: [
				"อาทิตย์",
				"จันทร์",
				"อังคาร",
				"พุธ",
				"พฤหัสบดี",
				"ศุกร์",
				"เสาร์"
			],
			dayNamesShort: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
			dayNamesMin: ["อา.", "จ.", "อ.", "พ.", "พฤ.", "ศ.", "ส."],
			weekHeader: "Wk",
			dateFormat: "dd-mm-yy",
			firstDay: 0,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ""
		};
		$.datepicker.setDefaults($.datepicker.regional["th"]);
	}
	$("#seed-confirm-date").datepicker({
		dateFormat: "dd-mm-yy",
		maxDate: new Date()
	});
});
