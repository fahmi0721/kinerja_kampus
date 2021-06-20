<script>


function StopLoad(){
    $(".LoadingState").hide();
}

function StartLoad(){
    $(".LoadingState").show();
}

function Validasi(){
    var iForm = ["Nama","Bobot"];
    var iKet = ["Nama Belum Lengkap","Bobot Belum Lengkap"];
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
    var iData = $("#FormData").serialize();
    $.ajax({
        type : "POST",
        url : "<?= base_url('ip/save') ?>",
        data : iData,
        beforeSend : function(){
            StartLoad();
        },
        success : function(res){
            var result = JSON.parse(res);
            if(result['status'] === true){
                Customsukses("IP", 1, result['pesan'], "proses");
                $(".FormInput").val("");
                StopLoad();
            }else{
                error("IP", 7, result['pesan']);
                StopLoad();
            }
        },
        error : function(er){
            console.log(er);
        }

    })
}

</script>