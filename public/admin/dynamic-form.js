function DynamicForm(action, method) {
    this.method = method;
    this.form = document.createElement("form");
    this.form.setAttribute("method", method == 'GET' ? method : "POST");
    this.form.setAttribute("action", action);
}

DynamicForm.create = function(action, method) {
    return new DynamicForm(action, method);
}

DynamicForm.prototype.addField = function(name, value) {
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", name);
    hiddenField.setAttribute("value", value);
    this.form.appendChild(hiddenField);
    return this;
};

DynamicForm.prototype.addCsrf = function() {
    this.addField("_token", $('meta[name=csrf-token]').attr('content'));
    return this;
};

DynamicForm.prototype.submit = function() {
    this.addField("_method", this.method);
    document.body.appendChild(this.form);
    this.form.submit();
};
