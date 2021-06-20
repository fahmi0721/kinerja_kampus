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
            "url": "<?php echo site_url('fakultas/show_data')?>",
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
            "targets": [ 0,3], 
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

function StopLoad(){
    $(".LoadingState").hide();
}

function StartLoad(){
    $(".LoadingState").show();
}



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
        url : "<?= base_url('fakultas/delete/') ?>",
        data : iData,
        success: function(res){
            var r = JSON.parse(res);
            console.log(r);
            if(r['status'] == "sukses"){
                var table = $('#tbl_users').DataTable();
                Customsukses("FAKULTAS", "001", r['pesan'], "proses");
                table.ajax.reload();
                scrolltop();
                ClearModal();
            }else{
                Customerror("FAKULTAS", "001", r['pesan'], "proses");
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