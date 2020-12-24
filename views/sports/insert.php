<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="views/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add Sports</h2>
                    </div>
                    <p>Please fill this form and submit to add sports record in the database.</p>
                    <form action="index.php?controller=sports&action=insert" method="POST" >
                        <div class="form-group <?php echo (!empty($sport->category_msg)) ? 'has-error' : ''; ?>">
                            <label>Sport Category</label>
                            <input type="text" name="category" class="form-control" >
                            
                        </div>
                        <div class="form-group <?php echo (!empty($sport->name_msg)) ? 'has-error' : ''; ?>">
                            <label>Sports Name</label>
                            <input type="text" name="name" class="form-control" >
                        </div>
                        <input type="hidden" name="id"/>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>