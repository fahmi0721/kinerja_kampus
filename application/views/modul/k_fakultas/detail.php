
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
