// Global ID contact
let _contact_id = 0

// Buttons Actions
let btn_actions = {
    actived: function() {
        //$('#btn_new').removeClass('disabled');
        $('#btn_view').addClass('disabled');
        $('#btn_edit').addClass('disabled');
        $('#btn_del').addClass('disabled');
    },
    disabled: function() {
        //$('#btn_new').addClass('disabled');
        $('#btn_view').removeClass('disabled');
        $('#btn_edit').removeClass('disabled');
        $('#btn_del').removeClass('disabled');
    },
}

let UI = {
    base_url: function() {
        return 'http://localhost/projects/agenda'
    },

    checkSelectedLine: function() {
        let lines = $('#table-contacts tbody tr');
        if ( lines.hasClass('row-selected') && _contact_id > 0 )
            return true

        alert('Select the line the right way')
        return false
    },

    message: function(elem_id, message_text, type_message = 'info', show = true) {
        let elem = document.getElementById(elem_id)
        let div_container = document.createElement('div')
        let div_header = document.createElement('div')
        let p = document.createElement('p')
        let disable = (show == false) ? 'hidden' : 'visible'
        
        div_container.classList.add('ui', disable, type_message, 'message')
        div_header.className = 'header'
        
        div_header.innerHTML = message_text.header
        p.innerHTML = message_text.body

        div_container.innerHTML = '<i class="close icon"></i>'
        div_container.appendChild(div_header)
        div_container.appendChild(p)
        elem.innerHTML = ''
        elem.appendChild(div_container)
    }
}

/*--- Set init config --------------------------------------------------------------------------*/

$('input#search').quicksearch('table tbody tr')
btn_actions.actived()
UI.message('message', {
    header: 'none',
    body: 'none'
}, 'info', false)