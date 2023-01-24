$('.multi-field-wrapper').each(function() {
    var $wrapper = $('.multi-fields', this);
    $(".add-field", $(this)).click(function(e) {
        $("#dynamic-container").append($("<po><select class='form-control select2' name='product_id[]' style='width: 350px;'><option value='0'>Please select one</option><?php if(isset($user) && is_array($user)){?><?php foreach($user as $user){?><?php if(isset($produks) && is_array($produks)){?><?php foreach($produks as $item){?><?php if ($user['code_resto'] == $item->code_resto) { ?><option value='<?php echo $item->id;?>'><?php echo $item->product_name.' - '.$item->name_satuan;?></option><?php }?><?php }?><?php }?><?php }?><?php }?></select><input type='number' class='form-control' name='jumlah[]' min='1' value='0' style='margin-left: 90px;'/><button type='button' class='remove-field btn btn-danger' id='button' style='float: right; margin-right: 150px;'>Delete Barang</button><br><br></po>"));
    });
});