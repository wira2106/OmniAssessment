currency = (value=null) =>{
    if(value){
        var string = value.toString();
        var n = parseInt(string.replace(/\D/g,''),10),
        data = n.toLocaleString();
        return data;
    }else{
        $(".rupiah").on('keyup', function(){
            if(parseInt($(this).val())){
                var n = parseInt($(this).val().replace(/\D/g,''),10),
                    value = n.toLocaleString();
                    value !== NaN ?value = value: value = 0;
                    $(this).val(value);
            }else{
                $(this).val(0);
            }
    
        });
    }
}


back_to_integer = (input) =>{
    let results = input.replace(/\,/g,'');
    return parseInt(results);
}