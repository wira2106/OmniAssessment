var pageTotal = 0;
var pageAktif = 0;
var jumlahSeluruh = 0;
var indexContent = 0;



$(document).ready(function () {
    
    $(document).keypress(function(e) {
        if(e.which == 13) {
          // $('#buttonSearchnya').focus();
          pageCount = 0;
          pageAktif = 0;
          cari = $('#search').val();
          view();
        }
    });
    view();
});

function setPaging(show, between) {
    // show : itu buat nampilin di awal atau akhirnya mau view berapa
    // contoh : show = 5 ( 1,2,3,4,5,...,20 ) atau (1,...,16,17,18,19,20)
    // between : untuk ngasik tiap kiri dan kanan berapa index kalau ditengah
    // contoh : between = 2 (1,...,6,7,[8],9,10,...,20)
    between = parseInt(between + 1);
    var txt = "";
    txt += `<div class="btn-group">`;
    txt = txt + "<button type='button' class='btn btn-secondary btn-sm' onclick='pervPage();'><i class='fa fa-chevron-left'></i></button>";
    if (pageAktif < (parseInt(show) - 1) || pageAktif == (parseInt(show) - 1) && pageTotal <= pageAktif) {
        for (var i = 0; i < (pageTotal); i++) {
            if (i < parseInt(show)) {
                txt = txt + "<button type='button' class='btn ";
                if (i == pageAktif) {
                    txt = txt + "btn-info ";
                } else {
                    txt = txt + "btn-secondary ";
                }
                txt = txt + "btn-sm' onclick='pageGanti(" + i + ")'>" + (i + 1) + "</button>";
            }
        }
        if (pageTotal > parseInt(show)) {
            txt = txt + "<button type='button' class='btn btn-secondary btn-sm'>...</button>";
            txt = txt + "<button type='button' class='btn btn-secondary btn-sm' onclick='pageGanti(" + (pageTotal - 1) + ")'>" + (pageTotal) + "</button>";
        }
    } else if (pageAktif - ((pageTotal) - parseInt(show)) > 0) {
        txt = txt + "<button type='button' class='btn btn-secondary btn-sm' onclick='pageGanti(0)'>1</button>";
        txt = txt + "<button type='button' class='btn btn-secondary btn-sm'>...</button>";
        for (var i = 0; i < (pageTotal); i++) {
            if (i > ((pageTotal - 1) - parseInt(show))) {
                txt = txt + "<button type='button' class='btn ";
                if (i == pageAktif) {
                    txt = txt + "btn-info ";
                } else {
                    txt = txt + "btn-secondary ";
                }
                txt = txt + "btn-sm' onclick='pageGanti(" + i + ")'>" + (i + 1) + "</button>";
            }
        }
    } else {
        txt = txt + "<button type='button' class='btn btn-secondary btn-sm' onclick='pageGanti(0)'>1</button>";
        txt = txt + "<button type='button' class='btn btn-secondary btn-sm'>...</button>";
        for (var i = 0; i < (pageTotal); i++) {
            if (i > (pageAktif - between) && i < (pageAktif + between)) {
                txt = txt + "<button type='button' class='btn ";
                if (i == pageAktif) {
                    txt = txt + "btn-info ";
                } else {
                    txt = txt + "btn-secondary ";
                }
                txt = txt + "btn-sm' onclick='pageGanti(" + i + ")'>" + (i + 1) + "</button>";
            }
        }
        txt = txt + "<button type='button' class='btn btn-secondary btn-sm'>...</button>";
        txt = txt + "<button type='button' class='btn btn-secondary btn-sm' onclick='pageGanti(" + (pageTotal - 1) + ")'>" + (pageTotal) + "</button>";
    }

    txt = txt + "<button type='button' class='btn btn-secondary btn-sm' onclick='nextPage();'><i class='fa fa-chevron-right'></i></button>";
    txt += `</div>`;
    txt = txt + "<select class='select2 jumpPage form-control form-control-sm' onchange='changePage(this)' style='width:60px;'>";
    for (var j = 0; j < pageTotal; j++) {
        var selectedPage = '';
        if (j == pageAktif) {
            selectedPage = 'selected';
        }
        txt = txt + "<option value='" + j + "' " + selectedPage + ">" + (j + 1) + "</option>";
    }
    txt = txt + "</select>";
    $('#btnPaging1').html(txt);
    $('#btnPaging2').html(txt);
}

function pageGanti(index) {
    pageAktif = index;
    view(index);
}

function changePage(e) {
    pageGanti(parseInt($(e).val()));
}


function pervPage() {
    if (pageAktif != 0) {
        pageAktif--;
        view();
    }
}

function nextPage() {
    if (indexContent != jumlahSeluruh) {
        pageAktif++;
        view();
    }
}

function pageIndex(index) {
    pageAktif = index;
    view();
}

function cariData() {
    pageAktif = 0;
    view();
}

function pageShow(index) {
    pageAktif = index;
    view();
}
$('#dateYear').change(() => {
    view();
})
// MENAMPILKAN DATA PERMINTAAN CLIENT
view = () => {
    // $('#table').loading('toggle');
    $('.action').hide()
    let a = "";
    let no = (parseInt(pageAktif) * 10) + 1;
    let awal = no;
    let cari = $('#search').val(),
        user_login = $('meta[name="user_login_id"]').attr('content');
      
    
    $('#table').loading('toggle');
    
    
    $.getJSON(link + "/api/users?cari=" + cari +"&page=" + pageAktif, function (data) {

        jumlahSeluruh = data.jumlah;
        pageTotal = parseInt(Math.ceil(jumlahSeluruh / 10));

        $.each(data.data, function (key, value) {

            a += `
            <tr>
                    <td style="width: 10%;" class="pointer" >${no}</td>
                    <td style="min-width: 30px;" class="pointer" >
                        <img src="${link}/image/${value.foto}" alt="${value.foto}" class="avatar-img rounded-circle" style="width:30px; height:30px;">
                    </td>
                    <td style="min-width: 185px;" class="pointer" >
                        <div>
                            <p style="margin: 0px;">
                                <h5style="margin: 0px;">
                                    <b>${value.nama}</b>
                                </h5>
                            </p>
                            <p style="margin: 0px;">
                                ${value.email}
                            </p>
                        </div>
                    </td>
                    <td style="min-width: 250px;"  class="pointer" >${value.alamat?value.alamat:'-'}</td>
                    <td style="min-width: 100px; padding: 0 4px!important" >
                        <button onclick="edit(${value.id})" class=" btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_user"><i class=" fas fa-pencil-alt" data-toggle="tooltip" data-placement="top" title="Edit"></i></button>
                        `;
                        if (parseInt(user_login) !== value.id) {
                            a += `<button class="btn btn-sm btn-danger" onclick="hapus(${value.id},'api/user/delete')" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>`;
                        }
            a +=`</td>`;
            
            a += `    </tr>`;
            indexContent = no;
            no++;
        });
    }).done(function () {
        $('#displayPage').html((awal) + '-' + indexContent + '/' + jumlahSeluruh);
        $('#displayPage2').html((awal) + '-' + indexContent + '/' + jumlahSeluruh);
        $('#table').html(a);
        $('#table').loading('toggle');
        setPaging(5, 2);
    });
}

edit = (id) =>{
    $('.modal_title_user').html('Edit User');
    $.getJSON(link+'/api/user/edit/'+id,function(data){
        console.log(data);
        $('#blah').attr('src', link+'/image/'+data.data.foto);
        $('input[name="foto_lama"]').val(data.data.foto);
        $('input[name="name"]').val(data.data.nama);
        $('input[name="jabatan"]').val(data.data.jabatan);
        $('input[name="email"]').val(data.data.email);
        data.data.jenis_kelamin? $('#laki').prop("checked", true):$('#perempuan').prop("checked", true);
        $('textarea[name="alamat"]').html(data.data.alamat);
        $('#form_data').attr('action',link+'/api/user/update/'+id);
        // $('#row_pass').hide();
    });
}

tambah = (id) =>{
    peview_image();
    set_image_default();
    $('.modal_title_user').html('Tambah User');
    $('#form_data').attr('action',link+'/api/user/create');
    // $('#row_pass').show();
    // check_conf_pass ();
}

peview_image = (image = null) =>{
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
          blah.src = URL.createObjectURL(file)
        }
      }
}


set_image_default = () =>{
    var default_image = $('input[name="default_foto"]').val();
    $('input[name="foto"]').val("");
    $('#blah').attr('src', default_image);
}




