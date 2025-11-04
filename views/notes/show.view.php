<?php require base_path("views/partials/head.php"); ?>
<?php require base_path("views/partials/nav.php"); ?>

<?php require base_path("views/partials/banner.php"); ?>
<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        <p class="mb-6">
            <?= $note1['body']; ?>
        </p>
        <a href="/notes" class="text-blue-500 hover:underline ">goback</a>
        <footer class="mt-6">
        <a href="/note/edit?id=<?= $note1['id'] ?>" class="text-gray-500 border border-current px-4  py-1 rounded">Edit</a>
        </footer>
        <form method="post" class="mt-6">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" value="<?= $note1['id']?>" name="id">
        <button type="submit" class="text-red-500">Delete</submit>
    </form>
    </div>
    
</main>
<?php require base_path("views/partials/footer.php"); ?>