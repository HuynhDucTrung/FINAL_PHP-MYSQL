<?php
include 'db.php';
include 'utils.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$limit = 10;  // Number of entries to show in a page.
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$searchName = isset($_GET['searchName']) ? trim(strtolower($_GET['searchName'])) : '';
$searchPriceMin = isset($_GET['searchPriceMin']) && is_numeric($_GET['searchPriceMin']) ? intval($_GET['searchPriceMin']) : '';
$searchPriceMax = isset($_GET['searchPriceMax']) && is_numeric($_GET['searchPriceMax']) ? intval($_GET['searchPriceMax']) : '';
$searchType = isset($_GET['searchType']) ? trim(strtolower($_GET['searchType'])) : '';

// Total count query
$sql = 'SELECT COUNT(id) FROM products 
        WHERE LOWER(REPLACE(name, " ", "")) LIKE :searchName 
        AND (:searchPriceMin = "" OR price >= :searchPriceMin)
        AND (:searchPriceMax = "" OR price <= :searchPriceMax)
        AND LOWER(REPLACE(type, " ", "")) LIKE :searchType';
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':searchName' => '%' . str_replace(' ', '', $searchName) . '%',
    ':searchPriceMin' => $searchPriceMin,
    ':searchPriceMax' => $searchPriceMax,
    ':searchType' => '%' . str_replace(' ', '', $searchType) . '%'
]);
$total_results = $stmt->fetchColumn();
$total_pages = ceil($total_results / $limit);

// Product retrieval query with LIMIT
$sql = 'SELECT * FROM products 
        WHERE LOWER(REPLACE(name, " ", "")) LIKE :searchName 
        AND (:searchPriceMin = "" OR price >= :searchPriceMin)
        AND (:searchPriceMax = "" OR price <= :searchPriceMax)
        AND LOWER(REPLACE(type, " ", "")) LIKE :searchType 
        LIMIT :start, :limit';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':searchName', '%' . str_replace(' ', '', $searchName) . '%', PDO::PARAM_STR);
$stmt->bindValue(':searchPriceMin', $searchPriceMin, PDO::PARAM_INT);
$stmt->bindValue(':searchPriceMax', $searchPriceMax, PDO::PARAM_INT);
$stmt->bindValue(':searchType', '%' . str_replace(' ', '', $searchType) . '%', PDO::PARAM_STR);
$stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
$stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Product Management Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .pagination {
            justify-content: center;
        }

        .table img {
            max-width: 100px;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .search-form input,
        .search-form button {
            margin-right: 10px;
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .btn-group {
            display: flex;
            align-items: center;
        }

        .table-actions .btn-group {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- <a class="navbar-brand" href="#">Product Management Page</a> -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            <h1 class="mt-4 mb-4">Product Management</h1>
            <div class="btn-group">
                <a href="add.php" class="btn btn-success ml-auto">Add New Product</a>
            </div>
        </div>
        <div class="search-bar">
            <form method="GET" class="form-inline search-form">
                <input type="text" name="searchName" class="form-control" placeholder="Search by name" value="<?php echo htmlspecialchars($_GET['searchName'] ?? '', ENT_QUOTES); ?>">
                <input type="number" step="1" name="searchPriceMin" class="form-control" placeholder="Min price (VND)" value="<?php echo htmlspecialchars($_GET['searchPriceMin'] ?? '', ENT_QUOTES); ?>">
                <input type="number" step="1" name="searchPriceMax" class="form-control" placeholder="Max price (VND)" value="<?php echo htmlspecialchars($_GET['searchPriceMax'] ?? '', ENT_QUOTES); ?>">
                <input type="text" name="searchType" class="form-control" placeholder="Search by type" value="<?php echo htmlspecialchars($_GET['searchType'] ?? '', ENT_QUOTES); ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['id']); ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['description']); ?></td>
                        <td><?php echo formatPrice($product['price']); ?></td>
                        <td><?php echo htmlspecialchars($product['type']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"></td>
                        <td class="table-actions">
                            <div class="btn-group">
                                <a href="edit.php?id=<?php echo $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <button onclick="confirmDelete(<?php echo $product['id']; ?>)" class="btn btn-danger btn-sm ml-2">Delete</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <?php if ($page > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo $page - 1; ?>&searchName=<?php echo urlencode($searchName); ?>&searchPriceMin=<?php echo $searchPriceMin; ?>&searchPriceMax=<?php echo $searchPriceMax; ?>&searchType=<?php echo urlencode($searchType); ?>">Previous</a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="index.php?page=<?php echo $i; ?>&searchName=<?php echo urlencode($searchName); ?>&searchPriceMin=<?php echo $searchPriceMin; ?>&searchPriceMax=<?php echo $searchPriceMax; ?>&searchType=<?php echo urlencode($searchType); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo $page + 1; ?>&searchName=<?php echo urlencode($searchName); ?>&searchPriceMin=<?php echo $searchPriceMin; ?>&searchPriceMax=<?php echo $searchPriceMax; ?>&searchType=<?php echo urlencode($searchType); ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>
</body>

</html>