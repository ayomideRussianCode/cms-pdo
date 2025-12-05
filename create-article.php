<?php
include 'partials/admin/admin_header.php';
include 'partials/admin/admin_navbar.php';

if (isPostRequest()) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_SESSION['user_id'];
    $created_at = $_POST['date'];


    $image = '';
    $targetDir = 'uploads/';
    $error = '';

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    if (isset($_FILES['featured-image']) && $_FILES['featured-image']['error'] === 0) {

        $targetFile = $targetDir . basename($_FILES['featured-image']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];

        if (in_array($imageFileType, $allowedTypes)) {

            $uniqueFileName = uniqid() . "_" . time() . "." . $imageFileType;
            $targetFile = $targetFile . "_" . $uniqueFileName;

            if (move_uploaded_file($_FILES['featured-image']['tmp_name'], $targetFile)) {

                $imagePath = $targetFile;
            } else {
                $error = "There was an error uploading the file";
            }
        } else {
            $error = 'Only JPG, JPEG, GIF and PNG files are allowed';
        }
    }


    $article = new Article();

    if($article->create($title, $content, $author_id, $created_at, $imagePath)) {

        redirect('admin.php');
        exit;
    } else {
        echo 'FAILED TO CREATE ARTICLE';
    }
}
?>


<!-- Main Content -->
<main class="container my-5">
    <h2>Create New Article</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Article Title *</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Enter article title" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Published Date *</label>
            <input name="date" type="date" class="form-control" id="date" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content *</label>
            <textarea name="content" class="form-control" id="content" rows="10" placeholder="Enter article content" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Featured Image URL</label>
            <input name="featured-image" type="file" class="form-control" id="image" placeholder="Enter image URL">
        </div>
        <button type="submit" class="btn btn-success">Publish Article</button>
        <a href="admin.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</main>

<?php
include 'partials/admin/admin_footer.php';
?>