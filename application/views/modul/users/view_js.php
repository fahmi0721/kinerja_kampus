<script>
$(document).ready(function(){
        LoadData();
});

function LoadData(){
    $('#tbl_users').DataTable({ 
        "processing": true, 
        "serverSide": true, 
        "order": [], 
        
        "ajax": {
            "url": "<?php echo site_url('users/show_data')?>",
            "type": "POST",
            async: true,
            error: function (xhr, error, code)
            {
                $("#proses").html(xhr.responseText);
                console.log(xhr);
            }
        },
        "fnDrawCallback": function (oSettings) {
            $("[data-toggle='tooltip']").tooltip();
        },
        
        "columnDefs": [
        { 
            "targets": [ 0,3,4], 
            "orderable": false, 
        },
        ],
    });
    StopLoad();
}

function HapusData(Id){
    ClearModal();
    jQuery("#modal").modal('show', {backdrop: 'static'});
    $(".modal-title").html("Konfirmasi Delete");
    $("#ModalDetail").html("<form id='FormDelete'><input type='hidden' name='Id' value='"+Id+"'></form><div class='alert alert-danger'>Apakah anda yakin ingin menghapus data ini ?</div>");
    $(".modal-footer").show()
}

// /** BASIC JS */
// //$("#Tanggal,#tgl_lahir,#tgl_bayar,#tglawal,#tglakhir,#Tanggal1").datepicker({ "format": "yyyy-mm-dd", "autoclose": true });
function StopLoad(){
    $(".LoadingState").hide();
}

function StartLoad(){
    $(".LoadingState").show();
}



// // function sprintf(format) {
// //   var args = Array.prototype.slice.call(arguments, 1);
// //   var i = 0;
// //   return format.replace(/%s/g, function () {
// //     return args[i++];
// //   });
// // }

// function Customerror(kode_modul, no, catatan,id) {
//   $("#"+id).html("<div class='alert alert-warning'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> ER-"+kode_modul+"."+no+" : "+catatan+"</div>");
// }

// function Customsukses(kode_modul, no, catatan, id) {
//   $("#" + id).html("<div class='alert alert-success'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button> SCS-" + kode_modul + "." + no + " : " + catatan + "</div>");
// }

// function scrolltop(){
//   $("html, body").animate({
//           scrollTop: 0
//       }, 600);
//       return false;
// }


function ClearModal(){
    $("#close_modal").trigger("click");
    $(".modal-title").html("");
    $("#ModalDetail").html("");
    $(".modal-footer").hide()
}

function SubmitDelete(){
    var iData = $("#FormDelete").serialize();
    $.ajax({
        type : "POST",
        url : "<?= base_url('users/delete/') ?>",
        data : iData,
        success: function(res){
            var r = JSON.parse(res);
            console.log(r);
            if(r['status'] == "sukses"){
                var table = $('#tbl_users').DataTable();
                Customsukses("USR", "001", r['pesan'], "proses");
                table.ajax.reload();
                scrolltop();
                ClearModal();
            }else{
                Customerror("USR", "001", r['pesan'], "proses");
                scrolltop();
                ClearModal();
            }
        },
        error : function(er){
            console.log(er);
        }
    })
}

</script>