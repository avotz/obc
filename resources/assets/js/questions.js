$(function () {
    
    var modalForm = $('#modal-questions')
    
    modalForm.on('shown.bs.modal', function (event) {

            var button = $(event.relatedTarget) // Button that triggered the modal
            var subject = button.attr('data-transaction');
            var partner = button.attr('data-partner');
            var user = button.attr('data-user');
            $('.fa-spin').hide();
        
            var modal = $(this);

                modal.find('#modal-questions-subject').val(subject)
                modal.find('#modal-questions-partner').val(partner)
                modal.find('#modal-questions-user').val(user)

    });



    modalForm.find('.modal-question-btn-send').on('click', function (e) {
        e.preventDefault();
        var button = $(this);
        var form = modalForm.find('#modal-questions-form');
        var formData = form.serializeArray();
        
        formData.push({ name: '_token', value:$('meta[name="csrf-token"]').attr('content')});
        
        $('.fa-spin').show();

        button.attr('disabled','disabled')
        $.ajax({
            type: 'POST',
            url: '/questions',
            data: formData,
            success: function (resp) {

                $('.fa-spin').hide();
                button.attr('disabled',false)

                if(resp == 'ok'){
                    modalForm.find('#modal-questions-msg').val('');

                    alert('Message sent');
                }
            },
            error: function (resp) {
                
                $('.fa-spin').hide();
                button.attr('disabled',false)
               
                let errors = resp.responseJSON.errors;
                let fields = '';

                if(errors.modal_questions_subject)
                    fields += errors.modal_questions_subject[0] + ' | '

                if(errors.modal_questions_msg)
                    fields += errors.modal_questions_msg[0]
                
               

                alert(`Errors: ${fields}`)
                

            }
        });
    
    });
         
});