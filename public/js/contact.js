let Contacts = {
    list: function () {
    },

    validate: function (contact) {
        //alert('func Validate()')
        return false;
    },

    save: function (contact) {

        let form = $('#form-contacts')
        let btn_save = $('#btn_save')
        
        btn_save.addClass('loading')

        $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            method: 'post'
        })
        .done(function(response) {
            if (response.success) {
                form[0].reset()
                UI.message('message', {
                    'header': 'Saved',
                    'body': response.message
                }, 'success')

                let line = `<tr data-id="${response.contact_id}"> 
                        <td>${contact.name}</td>
                        <td>${contact.email}</td>
                        <td>${contact.cellphone}</td>
                    </tr>`

                $('table#table-contacts tbody').append(line)
            } else {
                UI.message('message', {
                    'header': 'Fail',
                    'body': response.message
                }, 'error')
            }
        })
        .fail(function(xhr, textStatus, responseText) {
            let errorMessage = xhr.status + ': ' + xhr.statusText
            //console.error('>> SYSTEM:', errorMessage, responseText)
            UI.message('message', {
                'header': 'Fail',
                'body': errorMessage + '<br>' + responseText
            }, 'error')
        })
        .complete(function() {
            btn_save.removeClass('loading')
        })
    },

    viewer: function() {

        let url = UI.base_url() + '/contacts/edit/' + _contact_id
        let btn_view = $('#btn_view')
        
        btn_view.addClass('loading')

        $.ajax({
            url: url,
            //data: { contact_id: _contact_id },
            dataType: 'json',
            method: 'post'
        })
        .done(function(response) {
            
            $('#name-m').empty().append( response.name )
            $('#address-m').empty().append(response.address )
            $('#cell-phone-m').empty().append( response.cellphone )
            $('#email-m').empty().append(response.email )
            $('#create-at-m').empty().append(response.create_at )
                   
        })
        .fail(function(xhr, textStatus, responseText) {
            let errorMessage = xhr.status + ': ' + xhr.statusText + ' | ' + responseText
            console.error('>> SYSTEM VIEWER', errorMessage)
            UI.message('message-m', {
                header: 'Error',
                body: errorMessage
            }, 'error')
        })
        .complete(function() {
            btn_view.removeClass('loading')
        })
    },

    edit: function() {

        let url = UI.base_url() + '/contacts/edit/' + _contact_id
        let btn_edit = $('#btn_edit')

        btn_edit.addClass('loading')

        $.ajax({
            url: url,
            //data: { contact_id: _contact_id },
            dataType: 'json',
            method: 'post'
        })
        .done(function(response) {

            $('#code').val( response.contact_id )
            $('#name').val( response.name )
            $('#address').val( response.address )
            $('#cellphone').val( response.cellphone )
            $('#email').val( response.email )
                   
        })
        .fail(function(xhr, textStatus, responseText) {
            let errorMessage = xhr.status + ': ' + xhr.statusText + ' | ' + responseText
            console.error('>> SYSTEM VIEWER', errorMessage)
        })
        .complete(function() {
            btn_edit.removeClass('loading')
        })
    },

    update: function () {
        let form = $('#form-contacts')
        let btn_save = $('#btn_save')
        
        btn_save.addClass('loading')

        $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            method: 'post'
        })
        .done(function(response) {
            if (response.success) {
                UI.message('message', {
                    'header': 'Update',
                    'body': response.message
                }, 'success')

                let contact = {
                    contact_id: $('#code').val(),
                    name: $('#name').val(),
                    address: $('#address').val(),
                    email: $('#email').val(),
                    cellphone: $('#cellphone').val()
                }

                let line = `
                        <td>${contact.name}</td>
                        <td>${contact.email}</td>
                        <td>${contact.cellphone}</td>`

                $('table#table-contacts tbody tr.row-selected').empty().append(line)

                form[0].reset()
            } else {
                UI.message('message', {
                    'header': 'Fail',
                    'body': response.message
                }, 'error')
            }
        })
        .fail(function(xhr, textStatus, responseText) {
            let errorMessage = xhr.status + ': ' + xhr.statusText
            //console.error('>> SYSTEM:', errorMessage, responseText)
            UI.message('message', {
                'header': 'Fail',
                'body': errorMessage + '<br>' + responseText
            }, 'error')
        })
        .complete(function() {
            btn_save.removeClass('loading')
        })
    },

    delete: function() {

        if ( ! confirm('Are you sure?') )
            return false
        $.ajax({
            url: UI.base_url() + '/contacts/delete',
            data: {code: _contact_id},
            dataType: 'json',
            method: 'post'
        })
        .done(function(response) {
            if (response.success) {
                _contact_id = 0
                let table = $('table#table-contacts tbody tr.row-selected')
                table
                    .removeClass('row-selected')
                    .fadeOut('slow', function(){
                        table.remove();
                    })
                btn_actions.disabled();
                alert('Deleted success')
            } else {
                alert('Wrong deleted')
            }
        })
        .fail(function(xhr, textStatus, responseText) {
            let errorMessage = xhr.status + ': ' + xhr.statusText
            //console.error('>> SYSTEM:', errorMessage, responseText)
            alert('Wrong deleted : ' + errorMessage + '<br>' + responseText)
        })
    }
}

/*--- Contacts --------------------------------------------------------------------------*/

const form_contacts = document.getElementById('form-contacts')
form_contacts.addEventListener('submit', function(event) {
    event.preventDefault()

    const contact_id = parseInt( $('#code').val() )

    let contact = {
        contact_id: contact_id,
        name: $('#name').val(),
        address: $('#address').val(),
        email: $('#email').val(),
        cellphone: $('#cellphone').val()
    }

    if (Contacts.validate(contact))
        return;

    if (contact_id === 0) {
        Contacts.save(contact)
    } else {
        Contacts.update()
    }
})

$('.message')
    .delegate('.close','click', function() {
        $(this)
            .closest('.message')
            .fadeOut('slow')
})

$('#table-contacts tbody').on('click', 'tr', function(event) {
    let lines = $('#table-contacts tbody tr');
    let elem = $(this);

    if ( elem.hasClass('row-selected') ) {
        btn_actions.actived()
        elem.removeClass('row-selected')
        _contact_id = 0
    } else {
        if ( lines.hasClass('row-selected') )
            lines.removeClass('row-selected')
        btn_actions.disabled()
        elem.addClass('row-selected')
        _contact_id = elem.attr('data-id')
    }
})

$('#btn_new').click(function(event) {
    UI.message('message', {
        header: 'none',
        body: 'none'
    }, 'info', false)

    $('#form-contacts')[0].reset()
    $('#form-contacts').attr( 'action', UI.base_url() + '/contacts/save' )
    $('#form-contact-m .header').html('New Contact')
    $('#form-contact-m').modal('show')
})

$('#btn_view').click(function(event) {
    if ( UI.checkSelectedLine() ) {
        $('#viewer-contact').modal('show')
        Contacts.viewer()
    }
})

$('#btn_edit').click(function(event) {
    if ( UI.checkSelectedLine() ) {
        $('#form-contacts')[0].reset()
        $('#form-contacts').attr( 'action', UI.base_url() + '/contacts/update/' + _contact_id )
        Contacts.edit()
        $('#form-contact-m .header').html('Edit Contact')
        $('#form-contact-m').modal('show')
    }
})

$('#btn_del').click(function(event) {
    if ( UI.checkSelectedLine() ) {
        Contacts.delete()
    }
})
