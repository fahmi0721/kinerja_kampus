<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    SelectForm();
})

function StopLoad(){
    $(".LoadingState").hide();
}

function StartLoad(){
    $(".LoadingState").show();
}

function SelectForm() {
        $('.select-ip').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Indikator KInerja',
        });
    }


function Validasi(){
    var iForm = ["IdIp","Nama","format"];
    var iKet = ["Indikator Kinerja Belum dipilih","Nama Belum Lengkap","Format Belum Lengkap"];
    for(var i=0; i < iForm.length; i++){
        if($("#"+iForm[i]).val() == ""){
            StopLoad();
            error("001", i+1, iKet[i]); $("#"+iForm[i]).focus();  return false; 
        }
    }
   
}


$("#FormData").submit(function(e){
    e.preventDefault();
    if(Validasi() != false){
       SubmitData();
    }
    
});

function SubmitData(){
    var iData = new FormData($("#FormData")[0]);
    $.ajax({
        type : "POST",
        url : "<?= base_url('subip/save') ?>",
        contentType : false,
        processData : false,
        chace: false,
        data : iData,
        beforeSend : function(){
            StartLoad();
        },
        success : function(res){
            var result = JSON.parse(res);
            if(result['status'] === true){
                Customsukses("SUBIP", 1, result['pesan'], "proses");
                $(".FormInput").val("");
                $(".select-ip").trigger("change");
                StopLoad();
            }else{
                error("SUBIP", 7, result['pesan']);
                StopLoad();
            }
        },
        error : function(er){
            console.log(er);
            $("#proses").html(er['responseText']);
        }

    })
}

</script>