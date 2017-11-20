$(function () {
    
    
    jQuery('.js-select2').select2();
    $('#suppliers').select2({
        ajax: {
            delay: 300,
            url: '/credits/companies',
            dataType: 'json',
            data: function (params) {
                var query = {
                    q: params.term,

                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                // Tranforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data
                };
            }
        },
        minimumInputLength: 1,
    });

    jQuery('.suppliersSelectContainer').hide();

    jQuery('select[name=public]').change(function (e) {
        if (jQuery(this).val() == '1') {
            jQuery('.suppliersSelectContainer').hide();
        } else {
            jQuery('.suppliersSelectContainer').show();
        }
    });
    

    jQuery('.js-datepicker').datepicker({
            
    });

    $("#UploadPhoto").ajaxUpload({
      url : $("#UploadPhoto").data('url'),
      name: "photo",
      data: {},
      onSubmit: function() {
          $('#infoBox').html('Uploading ... ');

      },
      onComplete: function(result) {

          if(result ==='error'){

            $('#infoBox').addClass('alert-danger').html('Error al subir archivo. Tipo no permitido!!').show();
              setTimeout(function()
              { 
                $('#infoBox').removeClass('alert-danger').hide();
              },3000);

         return

          }

          $('#infoBox').addClass('alert-success').html('La foto se ha guardado con exito!!').show();
            setTimeout(function()
            { 
              $('#infoBox').removeClass('alert-success').hide();
            },3000);
        d = new Date();
        
            $('#user-avatar').attr('src','/storage/'+ result+'?'+d.getTime());
      
      }
  });
  

});