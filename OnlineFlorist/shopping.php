<?php 
    include "config.php";
    session_start();
      
    include "cart.class.php";
    $cart = new Cart();

    $data = [];

    // Check if a search query is set
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        // Modify your SQL query to filter based on the search term
        $sql = "SELECT * FROM products WHERE PRODUCT LIKE '%$search%'";
    } else {
        // If there's no search query, fetch all products
        $sql = "SELECT * FROM products";
    }

    $res = $con->query($sql);
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }
    }
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Micson Florist and Balloon</title>
    <link rel="stylesheet" href="css/shopping.css">
    <script src="https://kit.fontawesome.com/66aa7c98b3.js" crossorigin="anonymous"></script>
    <style>
        /* Custom styles for search bar and button */
        input.form-control {
            border-radius: 20px;
            border-color: #CCCCCC;
        }

        button.btn {
            border-radius: 80px;
            background-color: #FF6347;
            color: white;
        }

        button.btn:hover {
            background-color: #F8B26C;
        }
	
		.input-group {
			display: flex;
			justify-content: right;
		}
        h1 {
			display: flex;
			justify-content: center;
		}
        .card-text1 {
            display: flex;
            justify-content: flex-end; /* Align text to the right */
            font-weight: bold; /* Make the text bold */
            font-size: 14px; /* Set the font size */
            margin-top: 5px; /* Add some top margin for spacing */
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class='container mt-5 pb-5'>
        <div>
            <div class="col-lg-6">
                <form class="form-inline" method="GET" action="">
                    <h1>Shop</h1>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products..." name="search">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class='row'>
            <?php foreach($data as $row): ?>
                <div class='col-md-3 mt-2'>
                    <div class="card">  
                        <p class="card-text1" style="color: <?php echo ($row["STATUS"] == 'In Stock') ? 'green' : 'red'; ?>">
                            <?php echo $row["STATUS"]; ?>
                        </p>
                        <img class="card-img-top" src="images/<?php echo $row["IMAGE"]; ?>" >
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["PRODUCT"]; ?></h5>
                            <p class="card-text">
                                Price RM <?php echo $row["PRICE"]; ?> 
                            </p>
                            <a href="view_details.php?id=<?php echo $row["PID"]; ?>" class='btn btn-primary float-right' >View Details</a>
                        </div>
                    </div>
                </div>    
            <?php endforeach; ?>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>


