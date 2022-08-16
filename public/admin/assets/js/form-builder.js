var FormBuilder = (function (){

    function _titleCase(str) {
        return str.replace(/_/g, ' ').replace(/(^|\s)\S/g, function(t) { return t.toUpperCase() });
    }

    function _getOptionsForSelect(field) {
        if (field.type != 'select') return '';
        var m = '';
        field.options.map(function (i){
            m += `<option value="${i[0]}">${i[1]}</option>`
        });
        return m;
    }

    function _getElementMarkup(field) {
        //TODO field obj validation
        var label = field.label ? field.label : _titleCase(field.name);
        var type = field.type ? field.type : 'text';
        var select_options = _getOptionsForSelect(field);
        var value = field.value ? field.value : '';

        var markup = '';
        switch (type) {
            case "text":
                markup = `<div class="form-group row">
                        <label for="input-id-${field.name}" class="col-sm-2 col-form-label">${label}</label>
                        <div class="col-sm-10">
                          <input type="text" name="${field.name}" class="form-control" id="input-id-${field.name}">
                        </div>
                      </div>`
                break;
            case "checkbox":
                markup = `<div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" name="${field.name}" type="checkbox" id="input-id-${field.name}">
                        <label class="form-check-label" for="input-id-${field.name}">
                          ${label}
                        </label>
                      </div>
                    </div>
                  </div>`;
                break;
            case "select":
                markup = `<div class="form-group row">
                        <label for="input-id-${field.name}" class="col-sm-2 col-form-label">${label}</label>
                        <div class="col-sm-10">
                           <select class="form-control" id="input-id-${field.name}" name="${field.name}">
                              ${select_options}
                            </select>
                        </div>
                      </div>`
                break;

            case "hidden":
                markup = `<input type="hidden" name="${field.name}" value="${value ? value : ''}">`;
                break;
            default:
        }

        return markup;
    }

    function getFormMarkup(schema) {
        //TODO schema validation
        var method = schema.method ? schema.method : 'post';
        var fields_markup = '';
        schema.fields.map(function (element) {
            fields_markup += _getElementMarkup(element);
        });

        return `
<form action="${schema.action}" method="${method}">
${fields_markup}
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </div>
</form>
`
    }

    return {
        formMarkup: getFormMarkup
    }
})();
