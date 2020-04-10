jQuery.validator.addMethod("urlrewrite", function(value, element) {
  return this.optional(element) || /^[A-Za-z0-9-_]+$/i.test(value);
}, "Invalid Format."); 