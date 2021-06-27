<script>
function ClearModal(){
    $("#close_modal").trigger("click");
    $(".modal-title").html("");
    $(".modal-footer").hide()
}

function UpdateNilai(Id) {
    $(".FormInput").val("");
    ClearModal();
    LoadNilaiLama(Id);
    $("#Id").val(Id);
    jQuery("#modal").modal('show', {backdrop: 'static'});
    $(".modal-title").html("Update Nilai");
    $(".modal-footer").show()  ;
}

function LoadNilaiLama(Id) {
    $.ajax({
        type : "POST",
        url : "<?= base_url('k_fakultas/load_nilai') ?>",
        data : "Id="+Id,
        beforeSend : function(){
            StartLoad();
        },
        success : function(res){
            var result = JSON.parse(res);
            console.log(result);
            if(result['status'] == true){
                $("#Nilai").val(result['Nilai']);
            }
        },
        error : function(er){
            console.log(er);
        }

    })
}

function SubmitData() {
    var iData = $("#FormData").serialize();
    $.ajax({
        type : "POST",
        url : "<?= base_url('k_fakultas/save_nilai') ?>",
        data : iData ,
        beforeSend : function(){
            StartLoad();
        },
        success : function(res){
            var result = JSON.parse(res);
            if(result['status'] === true){
                location.reload();
            }else{
                error("K-Faklutas", 7, result['pesan']);
                StopLoad();
            }
        },
        error : function(er){
            console.log(er);
        }

    })
}

</script>