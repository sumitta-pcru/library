$(function(){
    var provinceObject = $('#province');
    var amphureObject = $('#amphure');


    // on change province
    provinceObject.on('change', function(){
        var provinceId = $(this).val();

        amphureObject.html('<option value="">เลือกอำเภอ</option>');


        $.get('get_amphure.php?ut_id=' + provinceId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                amphureObject.append(
                    $('<option></option>').val(item.id).html(item.ut_name)
                );
            });
        });
    });

});