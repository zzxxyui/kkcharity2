jQuery.validator.addMethod("urlrewrite", function(value, element) {
  return this.optional(element) || /^[A-Za-z0-9-_]+$/i.test(value);
}, "Invalid Format."); 

jQuery.validator.addMethod("app", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
}, "格式错误，只允许A-Z, a-z, 0-9"); 