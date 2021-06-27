
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modul K-Fakultas
        <small>Detail K-Fakultas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail K-Fakultas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Detail K-Fakultas</h3>

          <div class="box-tools pull-right">
            <div class='btn-group' id='BtnControl'>
            <a href="<?= base_url('k_fakultas/index/'); ?>" class='btn btn-sm btn-danger' title='Kembali' data-toggle='tooltip'><i class='fa fa-mail-reply'></i> Kembali</a>
                <button class='btn btn-sm btn-warning btn-flat' onclick="location.reload();" title='Reload' data-toggle='tooltip'><i class='fa fa-refresh'></i></button>
            </div>
          </div>
        </div>
        <div class="box-body">
            <div class="col-sm-12"><div class="row"><div id="proses"></div></div></div>
            </form>
            <div class='row'><div class='col-sm-12'>
            <div class='table-responsive'>
                <table id="tbl_users" class='table table-striped table-bordered ' >
                    <thead>
                        <tr>
                            <th width='10px' class='text-center'>No</th>
                            <th width="15%">Periode</th>
                            <th>Indikator Kompetensi</th>
                            <th width="10%">Bobot</th>
                            <th width="10%">Nilai</th>
                            <?php if($this->session->userdata('KodeLevel') != "2"): ?>
                              <th width="10%">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($data) > 0){
                                $No=1;
                                foreach($data as $item){
                                    $Kopetensi = json_decode($item['Kompetensi'],true);
                                    echo "<tr>";
                                    echo "<td class='center'>{$No}</td>";
                                    echo "<td>{$item['Periode']}</td>";
                                    echo "<td>{$Kopetensi['Nama']}</td>";
                                    echo "<td>{$Kopetensi['Bobot']}</td>";
                                    echo "<td>{$item['Nilai']}</td>";
                                    if($this->session->userdata('KodeLevel') != "2"):
                                      echo "<td><a href='javascript:void(0)' onclick=\"UpdateNilai('".$item['Id']."')\" class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> Update Nilai</a></td>";
                                    endif;
                                    echo "</tr>";
                                }
                            }else{
                               redirect("k_fakultas/");
                            }
                        ?>
                    </tbody>
                </table> 
            </div>
            </div></div>
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
<div class='modal fade in' id='modal' data-keyboard="false" data-backdrop="static" tabindex='0' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class="modal-header">
    <button type="button" class="close" id="close_modal" data-dismiss="modal">&times;</button>
    <h5 class="modal-title"></h5>
</div>
<div class='modal-body'>
        <form action="javascript:void(0)" id="FormData">
            <input type="hidden" name="Id" id="Id" class="FormInput">
            <div class='form-group'>
                <label for="Nilai" class='control-label'>Nilai</label>
                <input type="text" class="form-control FormInput" name="Nilai" id="Nilai" placeholder="Input Nilai">
            </div>
        </form>
    
    
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" onclick="SubmitData()"><i class="fa fa-check-square"></i> &nbsp;Update Niilai</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="ClearModal()"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
        </div>

</div>
</div>
</div>
</div>

  <?php $this->load->view('modul/k_fakultas/detail_js'); ?>
