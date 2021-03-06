<script>


function StopLoad(){
    $(".LoadingState").hide();
}

function StartLoad(){
    $(".LoadingState").show();
}

function Validasi(){
    var iForm = ["Nama"];
    var iKet = ["Nama Belum Lengkap"];
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
        url : "<?= base_url('fakultas/update') ?>",
        data : iData,
        beforeSend : function(){
            StartLoad();
        },
        success : function(res){
            var result = JSON.parse(res);
            if(result['status'] === true){
                Customsukses("FAKULTAS", 1, result['pesan'], "proses");
                $(".FormInput").val("");
                setTimeout(() => {
                    window.location="<?= base_url('fakultas/') ?>"
                }, 3000);
                StopLoad();
            }else{
                error("FAKULTAS", 7, result['pesan']);
                StopLoad();
            }
        },
        error : function(er){
            console.log(er);
        }

    })
}

</script>