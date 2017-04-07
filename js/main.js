if(typeof $ === 'undefined') {
    $ = {};
    
}

$(document).ready(function () {
        
    // Initialize the Bootstrap Tooltip API
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    
    // Actions to perform on edit click
    $('.edit').on('click', function () {
        
       var id = $(this).data('id'),
           container = $(this).parent().parent();
           $(container).parent().parent().wrap('<form id="editForm"></div>');
          
           
        $(container).find('.edit').hide();
        $(container).find('.save').show();
        $(container).find('.cancel').show();
           
        current = createInputs(container);
        
        $(container).find('input').first().focus();
        
        return false;
                
    });
    
    $('.cancel').on('click', function () {
        
        var id = $(this).data('id'),
            container = $(this).parent().parent();
        
        var r = confirm("Are you sure you want to cancel your edit? Changes will not be saved.");
        if (r === true) {
            cancelEdit(container);
        } else {
            return false;
        }
        
    })
    
    $('.save').on('click', function () {
        
        var id = $(this).data('id'),
            container = $(this).parent().parent();
        
        $('#editForm').validate({
            submitHandler: function (form) {
                // Disable the submit input to prevent double-submits and show
                // loader
                $('.save, .cancel').attr('disabled', 'disabled');
                $('.loading').css('visibility', 'visible');
                
                $.ajax({
                    url: '/index.php/people/',
                    data: {
                        id: id,
                        first_name: $('#editForm #first_name').val(),
                        last_name: $('#editForm #last_name').val(),
                        mobile: $('#editForm #mobile').val(),
                        email: $('#editForm #email').val(),
                        language_id: $('#editForm #language').val(),
                        dob: $('#editForm #dob').val()
                    },
                    dataType: 'json',
                    type: 'put',
                    success: function (response) {
                        // Buttons can be interacted with again and loader 
                        // is hidden
                        $('.save, .cancel').removeAttr('disabled');
                        $('.loading').css('visibility', 'hidden');

                        // Execute the "cancel" action, but with new data
                        cancelEdit(container, response.data);
                        
                        // Remove the form element from the table to prevent
                        // conflicts
                        $(container).parent().parent().unwrap();
                        
                        // Flash the row green to show it has been successfully 
                        // updated
                        $(container).addClass('success');
                        setTimeout(function () {
                            $(container).removeClass('success');
                        }, 1500);
                        
                    },
                    error: function () {
                        // TODO: Create error state
                        console.log('Edit Error');
                    }
                })                
            }
        })        
    });
    
    $('.delete').on('click', function () {
        var id = $(this).data('id'),
            container = $(this).parent().parent();
            
        // Highlight the affected row
        $(container).addClass('danger').delay(50);
            
        var r = confirm("Are you sure you want to delete this user?");
        if (r === true) {
            $('.delete').attr('disabled', 'disabled');
            $('.loading').css('visibility', 'visible');

            $.ajax({
                url: '/index.php/people/',
                data: {
                    id: id,
                    deleted: 1
                },
                dataType: 'json',
                type: 'delete',
                success: function (response) {
                    // Buttons can be interacted with again and loader 
                    // is hidden
                    $('.delete').removeAttr('disabled');
                    $('.loading').css('visibility', 'hidden');
                    
                    $(container).fadeOut(function () {
                       $(this).remove(); 
                    });

                },
                error: function () {
                    // TODO: Create error state
                    console.log('Delete Person Error');
                }
            })   
        } else {
            $(container).removeClass('danger');
            return false;
        }
    });
    
    $('.close-modal, .close').on('click', function () {
        // When the modal is closed, reset the form
        $('#addPerson input, #addPerson select').val('');
        document.getElementById("addPersonForm").reset();
        var validator = $( "#addPersonForm" ).validate();
        validator.resetForm();
    });
    
    $('#addPersonForm').validate({
        submitHandler: function (form) {
            
            $('#addPersonForm .modal-footer .btn').attr('disabled', 'disabled');
            $('.addLoading').css('visibility', 'visible');
            
            $.ajax({
                url: '/index.php/people/',
                data: {
                    first_name: $('#addPersonForm #first_name').val(),
                    last_name: $('#addPersonForm #last_name').val(),
                    mobile: $('#addPersonForm #mobile').val(),
                    email: $('#addPersonForm #email').val(),
                    language_id: $('#addPersonForm #language').val(),
                    dob: $('#addPersonForm #dob').val()
                },
                type: 'post',
                dataType: 'json',
                success: function (response) {
                    
                    $('#addPersonForm .modal-footer .btn').removeAttr('disabled');
                    $('#createModal').modal('hide');
                    $('.addLoading').css('visibility', 'hidden');
                    document.getElementById("addPersonForm").reset();
                    
                    location.reload();
                }, 
                error: function () {
                    $('.addLoading').css('visibility', 'hidden');
                    $('#addPersonForm .modal-footer .btn').removeAttr('disabled');
                }
            })
            
        }
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
function cancelEdit(container, data) {
    // If no data is passed in, use the original values
    // otherwise replace existing data with new data
    if(typeof data == 'undefined') {
        $(container).find('input').each(function (index, value) {
            var val = $(value).data('current');
            $(value).parent().html(val);
        });
    } else {
        $(container).find('input').each(function (index, value) {
            var val = data[$(value).attr('id')];
            $(value).parent().html(val);
        });
        
        $(container).find('select').each(function (index, value) {
            var val = data[$(value).attr('id')];
            $(value).parent().html(val);
        });
    }
    
    $(container).find('.edit').show();
    $(container).find('.save').hide();
    $(container).find('.cancel').hide();
    var validator = $( "#editForm" ).validate();
        validator.resetForm();
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
        
        if($(value).hasClass('select')) {
            generateSelectField(value);
        }
    });
    
}

function generateSelectField(target) {
    
    var id = $(target).data('field'),
        value = $(target).html(),
        languageDropdown = $('#addPersonForm').find('#language').clone();

    $(languageDropdown).find('option').each(function () {
        // Look for the selected field
        if($(this).html() == value) {
            $(this).attr('selected', 'selected');
        }
    });
    
    // place the entire div in the space
    fieldHtml = languageDropdown[0].outerHTML;
    
    $(target).html(fieldHtml);
    
}

function generateNumberField(target) {
    
    var id = $(target).data('field')
        fieldHtml = '',
        size = '',
        value = $(target).html(),
        // Converts the number to a human friendly view
        mobile = '0' + $(target).html().substring($(target).html().length - 9);
                
    fieldHtml = '<input type="number" data-current="' + value + '" class="form-control" name="' + id + '" id="' + id + '" value="' + mobile + '" size="10" required />';
    
    $(target).html(fieldHtml);
            
}

function generateEmailField(target) {
    
    var id = $(target).data('field'),
        value = $(target).html(),
        fieldHtml = '<input type="email" data-current="' + value + '" class="form-control" name="' + id + '" id="' + id + '" value="' + $(target).html() + '" size="10" required />';    
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
        
    fieldHtml = '<input type="text" data-current="' + value + '" class="form-control" name="' + id + '" id="' + id + '" value="' + $(target).html() + '"' + size + ' required   />';
    
    $(target).html(fieldHtml);
    
    return {input: id, value: value}
    
}
