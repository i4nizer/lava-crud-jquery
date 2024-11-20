<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>LavaCrud</title>
</head>

<body class="h-auto">

    <main class="d-flex flex-column justify-content-center align-items-center h-100">

        <h3 class="py-5">Users Table</h3>

        <form class="m-3 d-flex gap-2" id="search-form">
            <input class="p-2 border rounded" type="text" name="search" placeholder="Search">
            <button class="btn btn-primary">Search</button>
        </form>

        <table class="table table-striped table-bordered w-75">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">

                <!-- Table rows will be inserted dynamically -->
                

            </tbody>
            <tbody>
                <form id="user-form">
                    <tr>
                        <td class="align-content-center">#</td>
                        <td><input class="border rounded p-2" type="text" name="firstname" placeholder="Enter Firstname" required></td>
                        <td><input class="border rounded p-2" type="text" name="lastname" placeholder="Enter Lastname" required></td>
                        <td><input class="border rounded p-2" type="email" name="email" placeholder="Enter Email" required></td>
                        <td><input class="border rounded p-2" type="text" name="gender" placeholder="Enter Gender" required></td>
                        <td><input class="border rounded p-2" type="text" name="address" placeholder="Enter Address" required></td>
                        <td><button class="btn btn-success" type="submit">Add</button></td>
                    </tr>
                </form>
            </tbody>
        </table>

        <nav>
            <ul class="pagination">

                <li class="page-item prev disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <li class="page-item active"><a class="page-link">1</a></li>
                <li class="page-item"><a class="page-link">2</a></li>
                <li class="page-item"><a class="page-link">3</a></li>

                <li class="page-item next disabled">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>

            </ul>
        </nav>

    </main>

    <script defer src="<?= base_url() ?>public/js/user.js"></script>
</body>

</html>