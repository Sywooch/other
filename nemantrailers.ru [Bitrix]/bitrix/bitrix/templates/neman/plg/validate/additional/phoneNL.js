/**
 * Dutch phone numbers have 10 digits (or 11 and start with +31).
 */
$.validator.addMethod("phoneNL", function(value, element) {
	return this.optional(element) || /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{10}$/.test(value);
}, "Please specify a valid phone number.");
