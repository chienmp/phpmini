<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="views/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
<script type="text/javascript" src="views/bootstrapjs.js"></script>
<script type="text/javascript" src="views/jquery-3.3.1.slim.min.js"></script>
<script>
function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete this record?');
   if(conf)
      window.location=anchor.attr("href");
}
</script>
</head>
<body><center>
    <header>
        <h1>Sport CRUD</h1>
    </header>

    <section>
        <div class="col-md-5">
            <a href="index.php?controller=sports&action=insert" class="btn btn-success">Add New Value</a>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php
$count = 1;
foreach ($sports as $item) {
    echo "<tr>";

    echo "<td>" . $count . "</td>";

    echo "<td>" . $item->category . "</td>";

    echo "<td>" . $item->name . "</td>";
    echo "<td>";

    echo "<a href='index.php?controller=sports&action=edit&id=" . $item->id . "' class='btn btn-primary'>Edit</a>";

    echo "<a onclick='confirmationDelete($(this));return false;' href='index.php?controller=sports&action=delete&id=" . $item->id . "' class='btn btn-danger'>Delete</a>";

    echo "</td>";

    echo "</tr>";
    $count++;
}
?>
            </table>
        </div>
    </section>
</center>

</body>
</html>
