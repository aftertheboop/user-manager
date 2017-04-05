$(document).ready(function () {
    
    // Initialize the Bootstrap Tooltip API
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    
    // Actions to perform on edit click
    $('.edit').on('click', function () {
        
       var id = $(this).data('id'),
           container = $(this).parent().parent(),
           current = [];
          
           
        $(container).find('.edit').hide();
        $(container).find('.save').show();
        $(container).find('.cancel').show();
           
        $(container).find('input').first().focus();
        
        
        
    });
    
    $('.save').on('click', function () {
        
        var id = $(this).data('id'),
           container = $(this).parent().parent();
        
        $(container).find('.edit').show();
        $(container).find('.save').hide();
        $(container).find('.cancel').hide();
    })
    
});

function createInputs(container) {
        
    $(container).find('.editable').each(function (index, value) {
        
        if($(value).hasClass('text')) {
            generateTextField(value);
        }
        
        if($(value).hasClass('number')) {
            generateNumberField(value);
        }
        
        if($(value).hasClass('email')) {
            generateEmailField(value);
        }
    });
    
}

function generateNumberField(target) {
    
    var id = $(target).data('field')
        fieldHtml = '',
        size = '',
        value = $(target).html(),
        // Converts the number to a human friendly view
        mobile = '0' + $(target).html().substring(2);
                
    fieldHtml = '<input type="number" class="form-control" name="' + id + '" id="' + id + '" value="' + mobile + '" size="10" />';
    
    $(target).html(fieldHtml);
    
    return {input: id, value: value}
            
}

function generateEmailField(target) {
    
    var id = $(target).data('field'),
        value = $(target).html(),
        fieldHtml = '<input type="email" class="form-control" name="' + id + '" id="' + id + '" value="' + $(target).html() + '" size="10" />',
        size = '';
    
    $(target).html(fieldHtml);
    
    return {input: id, value: value}
}


function generateTextField(target) {
    
    var id = $(target).data('field'),
        value = $(target).html(),
        fieldHtml = '',
        size = ' size="10"';
        
    if(id == 'dob') {
        size = ' size="6"';
    }
        
    fieldHtml = '<input type="text" class="form-control" name="' + id + '" id="' + id + '" value="' + $(target).html() + '"' + size + ' />';
    
    $(target).html(fieldHtml);
    
    return {input: id, value: value}
    
}
