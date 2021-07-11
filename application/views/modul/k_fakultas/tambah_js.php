<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    SelectForm();
    LoadDataSementara();
    $("#ttl").prop("title","Pilih Indikator Kinerja dan dapatkan format bukti disini!");
    $("#ttl").attr('title', 'Pilih Indikator Kinerja dan dapatkan format bukti disini!')
          .tooltip('fixTitle')
          .tooltip('show');
})

function StopLoad(){
    $(".LoadingState").hide();
}

function StartLoad(){
    $(".LoadingState").show();
}

$('#IdSub').on('select2:select', function (e) {
    var data = e.params.data;
    var iData = "IdSub="+data.id;
    $.ajax({
        type : "POST",
        url : "<?= base_url('k_fakultas/get_file') ?>",
        data : iData,
        beforeSend : function(){
            StartLoad();
        },
        success : function(res){
            $("#proses").html("");
            var result = JSON.parse(res);
            if(result['status'] === true){
                var href = "<?= base_url('k_fakultas/download_format/') ?>"+result['file'];
                $("#ttl").find("a").prop("href",href);
                $("#ttl").prop("title","Download File Format Disni!");
                $("#ttl").attr('title', 'Download File Format Disni!')
                    .tooltip('fixTitle')
                    .tooltip('show');
            }else{
              
            }
        },
        error : function(er){
            $("#proses").html(er.responseText);
        }

    })
});

function ValidasiForm(){
    var iForm = ["Periode","Tahun","IdSub","Nilai","Bukti"];
    var iKet = ["Periode Belum Lengkap","Periode Belum Lengkap","Indikator Kinerja belum lengkap","Nilai belum lengkap","Bukti belum lengkap"];
    for(var i=0; i < iForm.length; i++){
        if($("#"+iForm[i]).val() == ""){
            StopLoad();
            error("001", i+1, iKet[i]); $("#"+iForm[i]).focus();  return false; 
        }
    }
}

function SelectForm() {
        $('.select-kompetensi').select2({
            allowClear: true,
            ballowClear: true,
            theme: "bootstrap",
            placeholder: 'Pilih Kompetensi',
        });
    }

$("#btnTambah").click(function(){
    if(ValidasiForm() != false){
       SubmitDataSementara();
    }
});

function SubmitDataSementara(){
    var iData = new FormData($("#FormData")[0]);
    $.ajax({
        type : "POST",
        url : "<?= base_url('k_fakultas/save_temp') ?>",
        data : iData,
        contentType: false,
        processData : false,
        chace: false,
        beforeSend : function(){
            StartLoad();
        },
        success : function(res){
            var result = JSON.parse(res);
            if(result['status'] === true){
                $(".FormInput").val("");
                $(".select-kompetensi").trigger("change");
                Customsukses("K-FAKULTAS", 1, result['pesan'], "proses");
                LoadDataSementara();
            }else{
                error("K-FAKULTAS", 7, result['pesan']);
                StopLoad();
            }
        },
        error : function(er){
            console.log(er);
            $("#proses").html(er['responseText']);
        }

    })
}

function ConfirmHapus(Id){
    var iConf = confirm("Anda yakin menghapus data ini?");
    if(iConf){
        HapusSementara(Id);
    }else{
        return false;
    }
}

function HapusSementara(Id){
    $.ajax({
        type : "POST",
        url : "<?= base_url('k_fakultas/hapus_data_temp') ?>",
        data : "Id="+Id,
        beforeSend : function(){
            StartLoad();
        },
        success : function(res){
            LoadDataSementara();
        },
        error : function(er){
            console.log(er);
        }

    })
}

function LoadDataSementara(){
    var html = "";
    $("#tData").html("<tr><th class='text-center' colspan='5'>belum ada data</th></tr>");
    $.ajax({
        type : "GET",
        url : "<?= base_url('k_fakultas/load_data_temp') ?>",
        beforeSend : function(){
            StartLoad();
        },
        success : function(res){
           var resul = JSON.parse(res);
           var no=1;
           if(resul.length > 0){
                for(var i=0; i < resul.length; i++){
                    var iData = resul[i];
                    html += "<tr class='tData'>";
                    html += "<td class='text-center'>"+no+"</td>";
                    html += "<td>"+iData['Nama']+"</td>";
                    html += "<td>"+iData['Periode']+"</td>";
                    html += "<td class='text-center'><a class='btn btn-xs btn-success' href='<?= base_url('k_fakultas/download_bukti_sem/') ?>"+btoa(iData['Bukti'])+"'><i class='fa fa-file'></i></a></td>";
                    html += "<td class='text-center'><a href='javascript:void(0)' onclick=\"ConfirmHapus('"+iData['Id']+"')\" data-toggle='tooltip' title='Hapus Data' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a></td>";
                    html += "</tr>";
                    no++
                }
                $("#tData").html(html);
                $("[data-toggle='tooltip']");
           }else{
                $("#tData").html("<tr><th class='text-center' colspan='5'>belum ada data</th></tr>");
           }

        },
        error : function(er){
            console.log(er);
        }

    })
}



$("#FormData").submit(function(e){
    e.preventDefault();
    if($(".tData").length > 0){
       SubmitData();
    }else{
        error("001", 1,"Data Belum Di isi"); $("#Periode").focus();  return false; 
    }
    
});

function SubmitData(){
    $.ajax({
        type : "GET",
        url : "<?= base_url('k_fakultas/save') ?>",
        beforeSend : function(){
            StartLoad();
        },
        success : function(res){
            var result = JSON.parse(res);
            console.log(result);
            if(result['status'] === true){
                Customsukses("K-Faklutas", 1, result['pesan'], "proses");
                $(".FormInput").val("");
                StopLoad();
                LoadDataSementara();
            }else{
                error("K-Faklutas", 7, result['pesan']);
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