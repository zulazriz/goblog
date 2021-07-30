<?php

  include './header.php';

  $currentdate = date('d-m-Y');
  $postid = $_GET['post_id'];

?>

<link rel="stylesheet" href="../assets/css/poststyle.css">

<header class="py-5 bg-light border-bottom mb-4">
  <div class="container">
    <div class="text-center my-1">
      <h1 class="fw-bolder">Update post</h1>
    </div>
  </div>
</header>

<div class="container">
  <div class="btnback">
    <div class="icon back">
      <a href="../users/blog.php">
        <button class="glow-on-hover" type="button">
          <span><i class="fas fa-chevron-left"></i></span>
        </button>
      </a>
    </div>
  </div>

  <?php

  $selectquery = "SELECT * FROM posts WHERE userid = $userid AND post_id = $postid";
  $queryresult = mysqli_query($conn, $selectquery);
  while ($row = mysqli_fetch_array($queryresult)) {

  ?>
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="form-group">
          <div class="card-body">
            <form method="POST" action="../include/update_post.php?post_id=<?php echo $postid; ?>" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-6">
                  <h5 class="fw-bold text-center">Image title</h5>
                  <div class="wrapper">
                    <img src="<?php echo $row['post_image']; ?>" id="image">
                    <input type="file" class="my_file" name="imgtitle" id="imgtitle">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="position-absolute top-40 start-50">
                    <h5 class="fw-bold text-center">Title</h5>
                    <input class="form-control" type="text" placeholder="Enter title" name="title" value="<?php echo $row['post_title']; ?>"/><br>

                    <h5 class="fw-bold text-center">Date</h5>
                    <input class="form-control" type="text" value="<?php echo $currentdate?>" disabled/>
                  </div>
                </div>
              </div>
              <h5 class="fw-bold text-center">Content</h5>
              <div>
                <textarea name="desc" id="desc"><?php echo $row['post_text']; ?></textarea>
              </div>
              <div class="mt-5">
                <button type="submit" name="publish" class="btn btn-primary">Publish</button>
                <button type="button" class="btn btn-secondary"><a href="../users/blog.php" style="text-decoration: none; color: white;">Back</a></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
</div>

  <script src="../assets/js/imagetitle.js"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'link image advcode casechange export linkchecker autolink lists checklist media mediaembed pageembed powerpaste table advtable tinymcespellchecker',
      toolbar: 'export insertfile link undo redo | bold italic alignleft aligncenter alignright alignjustify casechange bullist numlist outdent indent table image',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mediaembed_max_width: 200,
      image_title: true,
      automatic_uploads: true,
      file_picker_types: 'image',
      height: 500,

      file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        input.onchange = function () {
          var file = this.files[0];

          var reader = new FileReader();
          reader.onload = function () {

            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            cb(blobInfo.blobUri(), { title: file.name });
          };
          reader.readAsDataURL(file);
        };

        input.click();
      },
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
  </script>

<?php include './footer.php'; ?>
