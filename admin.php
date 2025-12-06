<?php
include 'partials/admin/admin_header.php';
include 'partials/admin/admin_navbar.php';


$article = new Article();

$userId = $_SESSION['user_id'];

$userArticles  = $article->getArticlesByUser($userId);

?>


<!-- Main Content -->
<main class="container my-5">
    <h2 class="mb-4"> Welcome <?php echo $_SESSION['username'] ?> , to your Admin Dashboard</h2>

    <div class="d-flex justify-content-between align-items-center mb-4">

        <form class="d-flex align-items-center" method="POST" action="<?php echo base_url('create-dummy-article.php') ?>">
            <label class="form-label me-2" for="articleCount"> Number of Articles </label>
            <input id="articleCount" min="1" style="width: 100px;" class="form-control" name="article_count" type="number">
            <button id="articleCount" class="btn btn-primary " type="submit">Generate Article</button>
        </form>

        <form action="<?php echo base_url('reorder-articles.php') ?>" method="POST">
            <button name="reorder_articles" class="btn btn-warning " type="submit">Reorder Article IDs</button>
        </form>

        <button id="deleteSelectedBtn" class="btn btn-danger">Delete Selected Articles </button>
    </div>


    <!-- Articles Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published Date</th>
                    <th>Excerpt</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                <?php if (!empty($userArticles)): ?>
                    <?php foreach ($userArticles as $articleItem): ?>
                        <!-- Example Article Row -->
                        <tr>
                            <td><?php echo $articleItem->id; ?></td>
                            <td><?php echo $articleItem->title; ?></td>
                            <td><?php echo $_SESSION['username']; ?></td>
                            <td><?php echo $article->formatCreatedAt($articleItem->created_at); ?></td>
                            <td><?php echo $article->getExcerpt($articleItem->content); ?></td>
                            <td>
                                <a href="edit-article.php?id=<?php echo $articleItem->id; ?>" class="btn btn-sm btn-primary me-1">Edit</a>
                            <td>
                                <form onsubmit="return confirmDelete( <?php echo $articleItem->id; ?> )" action="<?php echo base_url("delete_article.php") ?>" method="POST">
                                    <input value="<?php echo $articleItem->id; ?>" type="hidden" name="id">
                                    <button class="btn btn-sm btn-danger" ">Delete</button>
                                    <!-- <button class=" btn btn-sm btn-danger" onclick="confirmDelete(1)">Delete</button> -->

                                </form>
                            </td>
                            </td>
                        </tr>
                        <!-- You can add more articles here -->
                    <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
</main>

<?php
include 'partials/admin/admin_footer.php';


?>