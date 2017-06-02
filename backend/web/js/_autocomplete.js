$('#employee_username').autocomplete({
    source: function (request, response) {
        var result = [];
        //var limit = 10;
        var term = request.term.toLowerCase();
        $.each(_opts.employee, function () {
            var employee = this;
            if (term == '' || employee.username.toLowerCase().indexOf(term) >= 0) {
                result.push(employee);
                //limit--;
                //if (limit <= 0) {
                //    return false;
                    //}
            }
        });
        response(result);
    },
    focus: function (event, ui) {
        //$('#employee_username').val(ui.item.username);
        return false;
    },
    select: function (event, ui) {
        $('#employee_username').val(ui.item.username);
        return false;
    },
    search: function () {
        //$('#employee_username').val('');
    }
}).autocomplete("instance")._renderItem = function (ul, item) {
    return $("<li>")
        .append($('<a>').append($('<i>').text(item.tla_code +' - '+ item.english_name + ' ( ' + item.username + ')')))
        .appendTo(ul);
};