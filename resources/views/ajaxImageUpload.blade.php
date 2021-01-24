<!DOCTYPE html>
<html>
<head>
	<title>Laravel 5 - Ajax Image Uploading Tutorial</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>
</head>
<body>
    <div class="container">
    <h1>Laravel 5 - Ajax Image Uploading Tutorial</h1>
    <form id="mainForm" action="{{ url('ajax-uploadfile') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="alert" id="message" style="display:none"></div>
        <div class="form-group">
            <label>Alt Title:</label>
            <input type="text" name="title" id="image-title" class="form-control" placeholder="Add Title">
        </div>
        <div class="form-group">
            <label>Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-success upload-image" id="upload-image" type="submit">Upload Image</button>
        </div>
        <span id="uploaded_image"></span>
    </form>
    </div>
    <script type="text/javascript">
        $("#mainForm").on("submit", function(e){
            e.preventDefault();
            var title = $("#image-title").val();
            console.log(title);
            var image = $("#image").val();
            console.log(image);
            var formData = new FormData(this);
            formData.append('title', title);
            $.ajax({
                url:"{{ url('ajax-uploadfile') }}",
                method:"POST",
                data: formData,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    $("#message").css("display", "block");
                    $("#message").html(data.message);
                    $("#message").addClass(data.class_name);
                    $("#uploaded_image").html(data.uploaded_image);
                }
            });

        });
    </script>
</body>
</html>