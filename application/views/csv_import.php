<!DOCTYPE html>
<html>
<head>
    <title>How to Import CSV Data into MySQL using CodeIgniter</title>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container box">
    <h3 align="center">How to Import CSV Data into MySQL using Codeigniter</h3>
  
    <form method="post" id="import_csv" enctype="multipart/form-data">
        <div class="form-group">
            <label>Select CSV File</label>
            <input type="file" name="csv_file" id="csv_file" required accept=".csv" />
        </div>
        <br />
        <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
    </form>
    <br />
    <div id="imported_csv_data">
        <!-- Table to display imported data will go here -->
    </div>
</div>

<script>
    $(document).ready(function(){
        load_data();

        function load_data()
        {
            $.ajax({
                url: "<?php echo base_url(); ?>csv_import/display_data",
                method: "POST",
                success: function(data)
                {
                    $('#imported_csv_data').html(data);
                }
            })
        }

        $('#import_csv').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(){
                    $('#import_csv_btn').html('Importing...');
                },
                success: function(data)
                {
                    $('#import_csv')[0].reset();
                    $('#import_csv_btn').attr('disabled', false);
                    $('#import_csv_btn').html('Import Done');
                    load_data();
                }
            })
        });
    });
</script>

<!-- Table to display imported data -->
<div class="container">
    <h3>Imported Data</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <!-- Define your table headers here -->
                <th>#S.No</th>
                <th>Nmae</th>
                <th>Email</th>
                <th>Mobile</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            <!-- The imported data rows will be displayed here dynamically -->
            <?php if(!empty($tbl_user)){ foreach($tbl_user as $row){ ?>
<tr>
<td><?php echo $row['sr.no']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['mobile']; ?></td>
</tr>
<?php } }else{ ?>
<tr><td colspan="5">No member(s) found...</td></tr>
<?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>




       
 