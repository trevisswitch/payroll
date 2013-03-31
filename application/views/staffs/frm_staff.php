<?php get_header(); ?>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency-1.4.0.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.formatCurrency.all.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
      $("#staff_birthdate" ).datepicker({
        dateFormat: "yy-mm-dd"
      });
      
      var relation = ["Suami", "Anak Ke-1", "Anak Ke-2", "Anak Ke-3", "Anak Ke-4", "Anak Ke-5", "Lainnya (tls sendiri)"];
      $("#family_table").handsontable({
        colHeaders: ["Order", "Name", "Birthdate", "Birthplace", "Sex", "Relation"],
        startCols: 6,
        startRows: 3,
        colWidths: [60, 120, 80, 80, 60, 120],
        onChange : function(changes, source){
          console.log(source+" "+changes);
          if(source == "edit" && changes[0][1]==4){
            console.log(changes);
            if(changes[0][3] == "Male"){
              relation[0] = "Istri";
            }else{
              relation[0] = "Suami";
            }
          }
        },
        columns: [
          {},
          {},
          {type:'date'},
          {},
          {
            type: "autocomplete",
            source: ["Male", "Female"],
            strict: true
          },
          {
            type: "autocomplete",
            source: relation
          }
        ]
      });
      $("#add_families").on("click", function(e){
        e.preventDefault();
        var $instance = $("#family_table");
        var data = $instance.handsontable('getData'); // data di simpan dalam bentuk array multidimensi, indexnya sesuai dengan posisi column. ex. column order, maka index 0
        var row_length = data.length;
        var families = "";
        for(i=0; i<row_length; i++){
          if(data[i][0]!=null && 
          data[i][1]!=null && 
          data[i][2]!=null && 
          data[i][3]!=null && 
          data[i][4]!=null && 
          data[i][5]!=null){
            families += '<input type="hidden" name="families[]" value="'+data[i][0]+';'+data[i][1]+';'+data[i][2]+';'+data[i][3]+';'+data[i][4]+';'+data[i][5]+'">'; 
          }
        }
        $("#families_hidden").html(families);
      });
      
      /*Medic table*/
      $("#medic_table").handsontable({
        colHeaders: ["Date", "Description"],
        startCols: 2,
        startRows: 3,
        colWidths: [50, 500],
        columns: [
          {type:'date'},
          {}
        ]
      });
      $("#add_medics").on("click", function(e){
        e.preventDefault();
        var $instance = $("#medic_table");
        var data = $instance.handsontable('getData');
        var row_length = data.length;
        var medics = "";
        for(i=0; i<row_length; i++){
          if(data[i][0] != null && data[i][1] != null){
            medics += '<input type="hidden" name="medics[]" value="'+data[i][0]+';'+data[i][1]+'">';
          }
        }
        $("#medics_hidden").html(medics);
      });
    });
    
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>
<div class="body">
  <div class="content">
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo form_open_multipart($form_action) . form_hidden('id', $id); ?>
    <div class="page-header">
      <div class="icon">
        <span class="ico-coins"></span>
      </div>
      <h1>Salaries
      <small>Manage salaries</small>
      </h1>
    </div>
    <br class="cl" />
    <div class="one_third">
      <h3>Photo</h3>
      <div class="form-signin">
        <img src="<?php echo isset($staff_photo['value']) ? assets_url('upload/' . $staff_photo['value']) : assets_url('images/User-icon.png'); ?>" alt="" id="preview" />
      </div>
      <div class="input-append file">
        <input type="file" name="photo" onchange="readURL(this)" style="display:none;" />
        <input type="text" style="width:243px"/>
        <a href="#" class="btn">Browse</a>
      </div>
    </div>
    <div class="one_third">
      <h3>Basic information</h3>
      <table width="100%">
        <tr>
          <td width="20%">NIK</td>
          <td><div class="span1"><?php echo form_input($staff_nik); ?></div></td>
        </tr>
        <tr>
          <td>Kode Absen</td>
          <td><div class="span1"><?php echo form_input($staff_kode_absen); ?></div></td>
        </tr>
        <tr>
          <td>Name</td>
          <td><div class="span2"><?php echo form_input($staff_name); ?></div></td>
        </tr>
        <tr>
          <td>Birthdate</td>
          <td><div class="span2"><?php echo form_input($staff_birthdate); ?></div></td>
        </tr>
        <tr>
          <td>Birthplace</td>
          <td><div class="span2"><?php echo form_input($staff_birthplace); ?></div></td>
        </tr>

        <tr>
          <td valign="top">Address</td>
          <td><?php echo form_textarea($staff_address); ?></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><div class="span2"><?php echo form_input($staff_email); ?></div></td>
        </tr>
        <tr>
          <td>Email Alternatif</td>
          <td><div class="span2"><?php echo form_input($staff_email_alternatif); ?></div></td>
        </tr>
        <tr>
          <td>Phone</td>
          <td><div class="span2"><?php echo form_input($staff_phone_home); ?></div></td>
        </tr>
        <tr>
          <td>Mobile</td>
          <td><div class="span2"><?php echo form_input($staff_phone_hp); ?></div></td>
        </tr>
        <tr>
          <td>Gender</td>
          <td><div class="span2"><?php echo $staff_sex; ?></div></td>
        </tr>
      </table>
    </div>
    <div class="one_third lastcolumn">
      <h3>Status</h3>
      <table>
        <tr>
          <td width="40%">Status Pajak</td>
          <td><?php echo $staff_status_pajak; ?></td>
        </tr>
        <tr>
          <td>Status Nikah</td>
          <td><?php echo $staff_status_nikah; ?></td>
        </tr>
        <tr>
          <td>Status Karyawan</td>
          <td><?php echo $staff_status_karyawan; ?></td>
        </tr>
        <tr>
          <td>Status Cabang</td>
          <td><?php echo $staff_cabang; ?></td>
        </tr>
        <tr>
          <td>Status Departement</td>
          <td><?php echo $staff_departement; ?></td>
        </tr>
        <tr>
          <td>Status Jabatan</td>
          <td><?php echo $staff_jabatan; ?></td>
        </tr>
      </table>
    </div>
    <div class="spacer2"></div>
    <!-- tabs -->
    <h3>Histories & Families</h3>
    <ul class="nav nav-tabs">
      <li class="active"><a href="#family" data-toggle="tab">Family</a></li>
      <li><a href="#health" data-toggle="tab">Health</a></li>
      <li><a href="#date" data-toggle="tab">Work</a></li>
      <li><a href="#salary" data-toggle="tab">Salary</a></li>
    </ul>
    <div class="tab-content" style="overflow: visible">
      <div class="tab-pane active" id="family">
        <div class="ta_right"><a href="#" class="btn" id="add_families">Add Family</a></div>
        <div id="family_table"></div>
        <div id="families_hidden"></div>
      </div>
      <div class="tab-pane" id="health">
        <div class="ta_right"><a href="#" class="btn" id="add_medics">Add medic history</a></div>
        <div id="medic_table"></div>
        <div id="medics_hidden"></div>
      </div>
      <div class="tab-pane"></div>
      <div class="tab-pane"></div>
    </div>
    <div class="spacer2"></div>
    <?php echo form_submit($btn_save); ?> <?php echo $link_back; ?>
    <?php echo form_close() ?>
  </div>
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
</div>
<?php get_footer(); ?>
