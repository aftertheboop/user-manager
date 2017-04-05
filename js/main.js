$(document).ready(function () {
    
    // Initialize the Bootstrap Tooltip API
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    
    // Actions to perform on edit click
    $('.edit').on('click', function () {
        
       var id = $(this).data('id'),
           container = $(this).parent().parent();
          
           
        $(container).find('.edit').hide();
        $(container).find('.save').show();
        $(container).find('.cancel').show();
           
        current = createInputs(container);
        
        $(container).find('input').first().focus();
                
    });
    
    $('.cancel').on('click', function () {
        
        var id = $(this).data('id'),
            container = $(this).parent().parent();
        
        var r = confirm("Are you sure you want to cancel your edit? Changes will not be saved.");
        if (r == true) {
            cancelEdit(container);
        } else {
            return false;
        }
        
    })
    
    $('.save').on('click', function () {
        
        var id = $(this).data('id'),
           container = $(this).parent().parent();
        
        $(container).find('.edit').show();
        $(container).find('.save').hide();
        $(container).find('.cancel').hide();
    })
    
});

/**
 * Cancel Edit
 * 
 * Cancels the current edit to a user. Changes are not saved and all original
 * data remains intact.
 * @param object container
 * @returns void
 */
function cancelEdit(container) {
    
    $(container).find('input').each(function (index, value) {
        
        var val = $(value).data('current');
        
        $(value).parent().html(val);
        
    });
    
    $(container).find('.edit').show();
    $(container).find('.save').hide();
    $(container).find('.cancel').hide();
    
}

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
                
    fieldHtml = '<input type="number" data-current="' + value + '" class="form-control" name="' + id + '" id="' + id + '" value="' + mobile + '" size="10" />';
    
    $(target).html(fieldHtml);
            
}

function generateEmailField(target) {
    
    var id = $(target).data('field'),
        value = $(target).html(),
        fieldHtml = '<input type="email" data-current="' + value + '" class="form-control" name="' + id + '" id="' + id + '" value="' + $(target).html() + '" size="10" />';
    
    $(target).html(fieldHtml);
}


function generateTextField(target) {
    
    var id = $(target).data('field'),
        value = $(target).html(),
        fieldHtml = '',
        size = ' size="10"';
        
    if(id == 'dob') {
        size = ' size="6"';
    }
        
    fieldHtml = '<input type="text" data-current="' + value + '" class="form-control" name="' + id + '" id="' + id + '" value="' + $(target).html() + '"' + size + ' />';
    
    $(target).html(fieldHtml);
    
    return {input: id, value: value}
    
}
